<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="theme-color" content="#006c35">
	<?php wp_head(); ?>
	<link rel="icon" href="<?php echo esc_url( get_template_directory_uri() . '/assets/images/favicon.svg' ); ?>" type="image/svg+xml">
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main-content">تجاوز إلى المحتوى</a>
<div class="da-seasonal-bar">
	<div class="da-container">
		<p><span aria-hidden="true">🇸🇦</span> موسم الوطن والعودة إلى المدارس</p>
		<nav aria-label="عروض الموسم">
			<a href="<?php echo esc_url( home_url( '/#school-library-offer' ) ); ?>">تجهيز مكتبات المدارس</a>
			<a href="<?php echo esc_url( home_url( '/#story-subscription' ) ); ?>">اشتراك القصص للأطفال</a>
		</nav>
	</div>
</div>
<header class="site-header">
	<div class="da-container site-branding-row">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php elseif ( file_exists( get_template_directory() . '/assets/images/logo.png' ) ) : ?>
				<a class="da-fallback-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/logo.png' ); ?>" alt="شركة دور الأصحاب للنشر والتوزيع"></a>
			<?php else : ?>
				<a class="da-site-name" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
			<?php endif; ?>
		</div>
		<form class="da-product-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<label class="screen-reader-text" for="da-search">ابحث عن كتاب أو مؤلف أو ISBN</label>
			<input id="da-search" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="ابحث عن كتاب أو مؤلف أو ISBN…">
			<input type="hidden" name="post_type" value="product">
			<button type="submit"><?php doralashab_icon( 'search' ); ?><span>بحث</span></button>
		</form>
		<div class="da-header-actions">
			<?php if ( function_exists( 'wc_get_page_permalink' ) ) : ?>
				<a class="da-icon-link da-account-link" href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>"><?php doralashab_icon( 'user' ); ?><span class="da-icon-link-label">حسابي</span></a>
				<a class="da-icon-link da-cart-link" href="<?php echo esc_url( wc_get_cart_url() ); ?>"><?php doralashab_icon( 'cart' ); ?><span class="da-icon-link-label">السلة</span><span class="da-cart-count"><?php echo esc_html( WC()->cart ? WC()->cart->get_cart_contents_count() : 0 ); ?></span></a>
			<?php endif; ?>
		</div>
	</div>
</header>
<nav class="main-navigation" aria-label="القائمة الرئيسية">
	<div class="da-container">
		<button class="da-menu-toggle" type="button" aria-expanded="false" aria-controls="primary-menu"><span aria-hidden="true">☰</span> القائمة</button>
		<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container' => false, 'menu_id' => 'primary-menu', 'fallback_cb' => 'doralashab_menu_fallback' ) ); ?>
		<a class="da-header-cta" href="<?php echo esc_url( home_url( '/#seasonal-offers' ) ); ?>">عروض الموسم</a>
	</div>
</nav>
<main id="main-content" class="site-main">
