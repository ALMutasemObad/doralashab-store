<?php
defined( 'ABSPATH' ) || exit;

const DORALASHAB_THEME_VERSION = '2.4.0';

function doralashab_setup(): void {
	load_theme_textdomain( 'doralashab', get_template_directory() . '/languages' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array( 'height' => 184, 'width' => 435, 'flex-height' => true, 'flex-width' => true ) );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	register_nav_menus( array( 'primary' => 'القائمة الرئيسية', 'footer' => 'قائمة التذييل' ) );
	add_image_size( 'doralashab-book-card', 420, 560, false );
}
add_action( 'after_setup_theme', 'doralashab_setup' );

function doralashab_enqueue_assets(): void {
	wp_enqueue_style( 'doralashab-cairo', 'https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap', array(), null );
	wp_enqueue_style( 'doralashab-style', get_stylesheet_uri(), array(), DORALASHAB_THEME_VERSION );
	wp_enqueue_style( 'doralashab-v2', get_template_directory_uri() . '/assets/css/v2.css', array( 'doralashab-style' ), DORALASHAB_THEME_VERSION );
	wp_enqueue_script( 'doralashab-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), DORALASHAB_THEME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'doralashab_enqueue_assets' );

function doralashab_menu_fallback(): void {
	$items = array(
		array( 'الرئيسية', home_url( '/' ) ),
		array( 'المتجر', function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' ) ),
		array( 'كتب الأطفال', home_url( '/childrens-books/' ) ),
		array( 'كتب المدارس', home_url( '/school-books/' ) ),
		array( 'خدمات النشر', home_url( '/publishing-services/' ) ),
		array( 'حلول المكتبات', home_url( '/library-services/' ) ),
		array( 'من نحن', home_url( '/about-us/' ) ),
		array( 'اتصل بنا', home_url( '/contact/' ) ),
	);
	echo '<ul id="primary-menu">';
	foreach ( $items as $item ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $item[1] ), esc_html( $item[0] ) );
	}
	echo '</ul>';
}

function doralashab_icon( string $name, string $class = 'da-icon' ): void {
	$paths = array(
		'user'       => '<path d="M20 21a8 8 0 0 0-16 0"/><circle cx="12" cy="7" r="4"/>',
		'cart'       => '<circle cx="9" cy="20" r="1"/><circle cx="19" cy="20" r="1"/><path d="M3 4h2l2.4 10.2a2 2 0 0 0 2 1.6h7.9a2 2 0 0 0 2-1.6L21 7H6"/>',
		'search'     => '<circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/>',
		'book'       => '<path d="M4 5.5A3.5 3.5 0 0 1 7.5 2H20v17H7.5A3.5 3.5 0 0 0 4 22z"/><path d="M4 5.5V22M8 6h8M8 10h7"/>',
		'pen'        => '<path d="m15 5 4 4L8 20l-5 1 1-5z"/><path d="m13 7 4 4M4 16l4 4"/>',
		'boxes'      => '<path d="m4 8 8-4 8 4-8 4z"/><path d="m4 8 8 4v8l-8-4zM20 8l-8 4v8l8-4z"/>',
		'inventory'  => '<path d="M5 3h14a2 2 0 0 1 2 2v16H3V5a2 2 0 0 1 2-2z"/><path d="M7 8h10M7 12h4M7 16h6"/>',
		'catalog'    => '<path d="M4 4h6v16H4zM14 4h6v16h-6z"/><path d="M7 8h1M17 8h1M7 12h1M17 12h1"/>',
		'leaf'       => '<path d="M20 4C12 4 5 8 5 15c0 3 2 5 5 5 7 0 10-8 10-16z"/><path d="M4 21c2-5 6-9 12-12"/>',
		'barcode'    => '<path d="M4 5v14M7 5v14M11 5v14M14 5v14M16 5v14M20 5v14"/>',
		'library'    => '<path d="m3 9 9-5 9 5"/><path d="M5 10h14M6 18h12M4 21h16M8 10v8M12 10v8M16 10v8"/>',
		'check'      => '<path d="m5 12 4 4L19 6"/>',
		'arrow'      => '<path d="M5 12h14M13 6l6 6-6 6"/>',
	);
	$path = $paths[ $name ] ?? $paths['book'];
	printf( '<svg class="%s" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">%s</svg>', esc_attr( $class ), $path ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

function doralashab_cart_count_fragment( array $fragments ): array {
	if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
		return $fragments;
	}
	$fragments['.da-cart-count'] = '<span class="da-cart-count">' . esc_html( WC()->cart->get_cart_contents_count() ) . '</span>';
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'doralashab_cart_count_fragment' );

function doralashab_seed_page( string $title, string $slug, string $content = '' ): int {
	$existing = get_page_by_path( $slug );
	if ( $existing ) {
		return (int) $existing->ID;
	}
	return (int) wp_insert_post( array( 'post_title' => $title, 'post_name' => $slug, 'post_content' => $content, 'post_status' => 'publish', 'post_type' => 'page' ) );
}

function doralashab_seed_site(): void {
	if ( get_option( 'doralashab_theme_seeded' ) ) {
		return;
	}
	$home_id = doralashab_seed_page( 'الرئيسية', 'home' );
	doralashab_seed_page( 'من نحن', 'about-us', '<h2>شركة دور الأصحاب للنشر والتوزيع</h2><p>نؤمن بأن الكتاب الجيد يبدأ بفكرة صادقة ويصل إلى القارئ عبر نشر احترافي وتوزيع موثوق.</p>' );
	doralashab_seed_page( 'المؤلفون', 'authors', '[doralashab_authors]' );
	doralashab_seed_page( 'خدمات النشر', 'publishing-services', '<h2>خدمات متكاملة للمؤلفين</h2><p>نقدم خدمات التحرير والتدقيق والتصميم والطباعة والنشر والتوزيع.</p>' );
	doralashab_seed_page( 'اتصل بنا', 'contact', '<p>الرياض – حي الروابي<br>الهاتف: <a href="tel:+966555104300">+966 55 510 4300</a><br>البريد: <a href="mailto:ashab4488@gmail.com">ashab4488@gmail.com</a></p>[doralashab_contact]' );
	if ( $home_id ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
	}
	update_option( 'doralashab_theme_seeded', 1 );
}
add_action( 'after_switch_theme', 'doralashab_seed_site' );

function doralashab_seed_growth_content(): void {
	if ( '2.0.0' === get_option( 'doralashab_growth_content_version' ) ) {
		return;
	}

	doralashab_seed_page( 'كتب الأطفال', 'childrens-books', '<p>عوالم قراءة آمنة وثرية تراعي العمر، وتنمّي الخيال واللغة والقيم.</p>' );
	doralashab_seed_page( 'كتب المدارس', 'school-books', '<p>مصادر تعلم وقراءة إثرائية مختارة للمدارس والمعلمين والطلاب.</p>' );
	doralashab_seed_page( 'حلول المكتبات', 'library-services', '<p>خدمات توريد وجرد وتعشيب وفهرسة وتجهيز فني وإدارة تشغيلية للمكتبات.</p>' );

	if ( taxonomy_exists( 'product_cat' ) ) {
		$categories = array(
			'childrens-books' => array( 'name' => 'كتب الأطفال', 'description' => 'قصص وكتب معرفة وقراءة مبكرة للأطفال.' ),
			'school-books'    => array( 'name' => 'كتب المدارس', 'description' => 'كتب إثرائية ومصادر تعليمية للمكتبات المدرسية.' ),
		);
		foreach ( $categories as $slug => $category ) {
			if ( ! term_exists( $slug, 'product_cat' ) ) {
				wp_insert_term( $category['name'], 'product_cat', array( 'slug' => $slug, 'description' => $category['description'] ) );
			}
		}
	}

	update_option( 'doralashab_growth_content_version', '2.0.0' );
}
add_action( 'init', 'doralashab_seed_growth_content', 20 );

function doralashab_apply_brand_update(): void {
	if ( '2.1.0' === get_option( 'doralashab_brand_version' ) ) {
		return;
	}

	update_option( 'blogname', 'شركة دور الأصحاب للنشر والتوزيع' );
	update_option( 'blogdescription', 'متجر الكتب وخدمات النشر والتوزيع وحلول المكتبات' );

	$about = get_page_by_path( 'about-us' );
	if ( $about && false !== strpos( $about->post_content, 'دار الأصحاب' ) ) {
		wp_update_post(
			array(
				'ID'           => $about->ID,
				'post_content' => str_replace( 'دار الأصحاب', 'شركة دور الأصحاب', $about->post_content ),
			)
		);
	}

	update_option( 'doralashab_brand_version', '2.1.0' );
}
add_action( 'init', 'doralashab_apply_brand_update', 5 );

function doralashab_custom_logo_attributes( array $attributes ): array {
	$attributes['alt'] = 'شركة دور الأصحاب للنشر والتوزيع';
	return $attributes;
}
add_filter( 'get_custom_logo_image_attributes', 'doralashab_custom_logo_attributes' );

function doralashab_product_card( $product ): void {
	if ( ! $product instanceof WC_Product ) {
		return;
	}
	$authors = taxonomy_exists( 'book_author' ) ? get_the_term_list( $product->get_id(), 'book_author', '', '، ' ) : '';
	?>
	<article class="da-product-card">
		<a class="da-product-card-image" href="<?php echo esc_url( $product->get_permalink() ); ?>">
			<?php echo wp_kses_post( $product->get_image( 'medium_large', array( 'loading' => 'lazy', 'sizes' => '(max-width: 560px) 72vw, (max-width: 1020px) 38vw, 235px' ) ) ); ?>
		</a>
		<div class="da-product-card-body">
			<div class="da-product-meta"><?php echo $authors ? wp_kses_post( $authors ) : 'إصدارات دور الأصحاب'; ?></div>
			<h3><a href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php echo esc_html( $product->get_name() ); ?></a></h3>
			<div class="da-product-price"><?php echo $product->get_price_html() ? wp_kses_post( $product->get_price_html() ) : 'السعر عند الطلب'; ?></div>
			<a class="button" href="<?php echo esc_url( $product->get_permalink() ); ?>">عرض الكتاب</a>
		</div>
	</article>
	<?php
}

add_filter( 'loop_shop_columns', static fn() => 4 );
add_filter( 'woocommerce_output_related_products_args', static function ( array $args ): array { $args['posts_per_page'] = 4; $args['columns'] = 4; return $args; } );
