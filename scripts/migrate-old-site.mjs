import { mkdir, writeFile } from 'node:fs/promises';
import path from 'node:path';

const SOURCE = 'https://books.code-force.online';
const ROOT = process.cwd();
const DATA_DIR = path.join(ROOT, 'data');
const DATA_IMAGE_DIR = path.join(DATA_DIR, 'images');
const ASSET_DIR = path.join(ROOT, 'doralashab-store', 'wp-content', 'themes', 'doralashab', 'assets', 'images');

const htmlEntities = new Map([
  ['amp', '&'], ['lt', '<'], ['gt', '>'], ['quot', '"'], ['apos', "'"],
  ['nbsp', ' '], ['ndash', '–'], ['mdash', '—'], ['hellip', '…'],
  ['8211', '–'], ['8212', '—'], ['8216', '‘'], ['8217', '’'],
  ['8220', '“'], ['8221', '”'], ['8230', '…'],
]);

function decodeEntities(value = '') {
  return String(value).replace(/&(#x[0-9a-f]+|#[0-9]+|[a-z]+);/gi, (match, entity) => {
    const key = entity.toLowerCase();
    if (key.startsWith('#x')) return String.fromCodePoint(Number.parseInt(key.slice(2), 16));
    if (key.startsWith('#')) return String.fromCodePoint(Number.parseInt(key.slice(1), 10));
    return htmlEntities.get(key) ?? match;
  });
}

function stripHtml(value = '') {
  return decodeEntities(
    String(value)
      .replace(/<script[\s\S]*?<\/script>/gi, '')
      .replace(/<style[\s\S]*?<\/style>/gi, '')
      .replace(/<[^>]+>/g, ' ')
      .replace(/\s+/g, ' ')
      .trim(),
  );
}

function decodeSlug(value = '') {
  try { return decodeURIComponent(value); } catch { return value; }
}

function csv(value) {
  const text = value == null ? '' : String(value);
  return `"${text.replaceAll('"', '""')}"`;
}

function minorPrice(prices, key) {
  const raw = prices?.[key];
  if (raw == null || raw === '' || Number(raw) === 0) return '';
  const unit = Number(prices.currency_minor_unit ?? 2);
  return (Number(raw) / (10 ** unit)).toFixed(unit);
}

async function fetchJson(url) {
  const response = await fetch(url, { headers: { 'User-Agent': 'DoralashabMigration/1.0' } });
  if (!response.ok) throw new Error(`${response.status} ${response.statusText}: ${url}`);
  return response.json();
}

async function download(url, destination) {
  const response = await fetch(url, { headers: { 'User-Agent': 'DoralashabMigration/1.0' } });
  if (!response.ok) throw new Error(`${response.status} ${response.statusText}: ${url}`);
  await writeFile(destination, Buffer.from(await response.arrayBuffer()));
}

function authorNames(product) {
  const candidates = product.attributes?.filter((attribute) => /مؤلف/.test(attribute.name)) ?? [];
  return [...new Set(candidates.flatMap((attribute) => attribute.terms?.map((term) => decodeEntities(term.name)) ?? []))];
}

function productImages(product) {
  return product.images?.map((image) => image.src).filter(Boolean) ?? [];
}

function exportRow(product) {
  const categories = product.categories?.map((category) => decodeEntities(category.name)).join(', ') ?? '';
  const authors = authorNames(product).join(', ');
  const stock = Number.isFinite(Number(product.add_to_cart?.maximum)) ? product.add_to_cart.maximum : '';
  const regular = minorPrice(product.prices, 'regular_price');
  const sale = minorPrice(product.prices, 'sale_price');
  const published = product.is_in_stock || regular ? 1 : 1;

  return {
    Type: product.type || 'simple',
    SKU: product.sku || '',
    Name: decodeEntities(product.name),
    Published: published,
    'Is featured?': 0,
    'Visibility in catalog': 'visible',
    'Short description': product.short_description || '',
    Description: product.description || '',
    'Tax status': 'taxable',
    'In stock?': product.is_in_stock ? 1 : 0,
    Stock: stock,
    'Backorders allowed?': product.is_on_backorder ? 1 : 0,
    'Sold individually?': product.sold_individually ? 1 : 0,
    'Allow customer reviews?': 1,
    'Sale price': sale && sale !== regular ? sale : '',
    'Regular price': regular,
    Categories: categories,
    Tags: product.tags?.map((tag) => decodeEntities(tag.name)).join(', ') ?? '',
    Images: productImages(product).join(', '),
    Position: 0,
    'Attribute 1 name': authors ? 'المؤلف' : '',
    'Attribute 1 value(s)': authors,
    'Attribute 1 visible': authors ? 1 : '',
    'Attribute 1 global': 0,
    'Meta: _doralashab_source_id': product.id,
    'Meta: _doralashab_source_url': product.permalink,
  };
}

await mkdir(DATA_DIR, { recursive: true });
await mkdir(DATA_IMAGE_DIR, { recursive: true });
await mkdir(ASSET_DIR, { recursive: true });

const products = await fetchJson(`${SOURCE}/wp-json/wc/store/v1/products?per_page=100&page=1`);
const pages = await fetchJson(`${SOURCE}/wp-json/wp/v2/pages?per_page=100&_fields=id,slug,link,title,content,excerpt,featured_media`);
const posts = await fetchJson(`${SOURCE}/wp-json/wp/v2/posts?per_page=100&_fields=id,slug,link,date,title,content,excerpt,featured_media`);

const normalizedProducts = products.map((product) => ({
  ...product,
  name: decodeEntities(product.name),
  slug: decodeSlug(product.slug),
  authors: authorNames(product),
  categories: product.categories?.map((category) => ({ ...category, name: decodeEntities(category.name), slug: decodeSlug(category.slug) })) ?? [],
}));

const normalizedPages = pages.map((page) => ({
  id: page.id,
  slug: page.slug,
  link: page.link,
  title: decodeEntities(page.title?.rendered ?? ''),
  excerpt: stripHtml(page.excerpt?.rendered ?? ''),
  content: page.content?.rendered ?? '',
}));

const normalizedPosts = posts.map((post) => ({
  id: post.id,
  slug: post.slug,
  link: post.link,
  date: post.date,
  title: decodeEntities(post.title?.rendered ?? ''),
  excerpt: stripHtml(post.excerpt?.rendered ?? ''),
  content: post.content?.rendered ?? '',
}));

await writeFile(path.join(DATA_DIR, 'old-site-products.json'), JSON.stringify(normalizedProducts, null, 2), 'utf8');
await writeFile(path.join(DATA_DIR, 'old-site-pages.json'), JSON.stringify(normalizedPages, null, 2), 'utf8');
await writeFile(path.join(DATA_DIR, 'old-site-posts.json'), JSON.stringify(normalizedPosts, null, 2), 'utf8');

const rows = products.map(exportRow);
const headers = Object.keys(rows[0] ?? {});
const csvContent = ['\uFEFF' + headers.map(csv).join(','), ...rows.map((row) => headers.map((header) => csv(row[header])).join(','))].join('\r\n');
await writeFile(path.join(DATA_DIR, 'woocommerce-products.csv'), csvContent, 'utf8');

await download(`${SOURCE}/wp-content/uploads/2022/11/logo.png`, path.join(ASSET_DIR, 'logo.png'));
if (normalizedProducts[0]?.images?.[0]?.src) {
  await download(normalizedProducts[0].images[0].src, path.join(ASSET_DIR, 'hero-book.jpeg'));
}

const imageManifest = [];
for (const product of normalizedProducts) {
  for (let index = 0; index < (product.images?.length ?? 0); index += 1) {
    const image = product.images[index];
    const sourceUrl = image.src;
    const extension = path.extname(new URL(sourceUrl).pathname).toLowerCase().replace(/[^.a-z0-9]/g, '') || '.jpg';
    const fileName = `book-${product.id}-${index + 1}${extension}`;
    try {
      await download(sourceUrl, path.join(DATA_IMAGE_DIR, fileName));
      imageManifest.push({ productId: product.id, productName: product.name, sourceUrl, fileName, downloaded: true });
    } catch (error) {
      imageManifest.push({ productId: product.id, productName: product.name, sourceUrl, fileName, downloaded: false, error: error.message });
    }
  }
}
await writeFile(path.join(DATA_DIR, 'image-manifest.json'), JSON.stringify(imageManifest, null, 2), 'utf8');

const priced = normalizedProducts.filter((product) => Number(product.prices?.regular_price ?? 0) > 0).length;
const withImages = normalizedProducts.filter((product) => (product.images?.length ?? 0) > 0).length;
const summary = `# تقرير ترحيل موقع دور الأصحاب\n\n- المصدر: ${SOURCE}\n- عدد المنتجات: ${normalizedProducts.length}\n- منتجات لها سعر منشور: ${priced}\n- منتجات لها صور: ${withImages}\n- عدد الصفحات: ${normalizedPages.length}\n- عدد المقالات: ${normalizedPosts.length}\n- العملة: ${normalizedProducts[0]?.prices?.currency_code ?? 'SAR'}\n- الفئة الفعلية في المتجر القديم: الجودة (${normalizedProducts.filter((product) => product.categories.some((category) => category.name === 'الجودة')).length} منتج)\n\n> توجد منتجات بلا سعر أو وصف في المصدر القديم؛ تُنقل كما هي للمراجعة ولا تُخترع لها بيانات.\n`;
await writeFile(path.join(DATA_DIR, 'migration-summary.md'), summary, 'utf8');

console.log(JSON.stringify({ products: normalizedProducts.length, pages: normalizedPages.length, posts: normalizedPosts.length, images: imageManifest.filter((item) => item.downloaded).length }, null, 2));
