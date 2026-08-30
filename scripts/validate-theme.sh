#!/usr/bin/env bash
set -euo pipefail

repo_root="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
theme_dir="$repo_root/doralashab-store/wp-content/themes/doralashab"

required_files=(
  ".doralashab-theme-root"
  "style.css"
  "functions.php"
  "header.php"
  "footer.php"
  "front-page.php"
  "assets/css/v2.css"
  "assets/css/v3.css"
  "assets/css/national-day.css"
  "assets/css/woocommerce.css"
  "assets/js/theme.js"
  "assets/images/favicon.svg"
  "assets/images/og-doralashab.png"
  "assets/images/national-day-campaign.jpg"
  "assets/images/national-day-backpack.jpg"
  "assets/images/national-day-pens.jpg"
  "assets/images/national-day-colors.jpg"
  "assets/images/national-day-stationery.jpg"
  "assets/images/vision-2030.png"
  "assets/images/founder-abdulrahman-alowain.png"
  "assets/images/partners/misk.svg"
  "assets/images/partners/pnu.png"
  "assets/images/partners/imamu.png"
  "assets/images/partners/hail.png"
  "assets/images/partners/sqc.png"
  "page-about-us.php"
  "page-contact.php"
)

for file in "${required_files[@]}"; do
  if [[ ! -s "$theme_dir/$file" ]]; then
    echo "Required theme file is missing or empty: $file" >&2
    exit 1
  fi
done

grep -Fq "Theme Name: دور الأصحاب" "$theme_dir/style.css"
grep -Fxq "DORALASHAB_THEME_DEPLOY_ROOT_V1" "$theme_dir/.doralashab-theme-root"
grep -Fq "const DORALASHAB_THEME_VERSION" "$theme_dir/functions.php"
grep -Fq "شركة دور الأصحاب للنشر والتوزيع" "$theme_dir/front-page.php"
grep -Fq "نشر وتوزيع وحلول" "$theme_dir/front-page.php"
grep -Fq "هِمّة تتعلّم" "$theme_dir/front-page.php"
grep -Fq "alas3hab@gmail.com" "$theme_dir/footer.php"

if grep -Fq "مكتبة الملك عبد" "$theme_dir/front-page.php"; then
  echo "An unverified institution remains in the public homepage." >&2
  exit 1
fi

if grep -Eq 'max\([[:space:]]*23|عنوانًا متاحًا الآن' "$theme_dir/front-page.php"; then
  echo "An unsupported numeric storefront claim remains in the homepage." >&2
  exit 1
fi

while IFS= read -r -d '' php_file; do
  php -l "$php_file" >/dev/null
done < <(find "$theme_dir" -type f -name '*.php' -print0)

if find "$theme_dir" -type f \( -name '.env*' -o -name '*.pem' -o -name '*.key' -o -name '*.p12' \) -print -quit | grep -q .; then
  echo "A credential-like file exists inside the deployable theme." >&2
  exit 1
fi

if grep -RIEq --exclude='*.svg' --exclude='*.map' '(BEGIN (RSA |EC |OPENSSH )?PRIVATE KEY|AKIA[0-9A-Z]{16}|ghp_[A-Za-z0-9]{30,})' "$theme_dir"; then
  echo "A possible secret was detected inside the deployable theme." >&2
  exit 1
fi

large_file="$(find "$theme_dir" -type f -size +5M -print -quit)"
if [[ -n "$large_file" ]]; then
  echo "Theme contains a file larger than 5 MB: $large_file" >&2
  exit 1
fi

echo "Theme validation passed."
