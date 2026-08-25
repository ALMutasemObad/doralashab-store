<?php
/**
 * Plugin Name: بيانات كتب دور الأصحاب
 * Description: حقول وتصنيفات الكتب الخاصة بمتجر دور الأصحاب مع دعم الاستيراد والعرض والبحث بواسطة ISBN.
 * Version: 1.0.0
 * Author: دور الأصحاب للنشر والتوزيع
 * Text Domain: doralashab-books
 * Requires Plugins: woocommerce
 * Requires PHP: 8.1
 */

defined( 'ABSPATH' ) || exit;

final class Doralashab_Books {
	private const VERSION = '1.0.0';
	private const META_FIELDS = array(
		'_doralashab_isbn_10'          => 'ISBN-10',
		'_doralashab_isbn_13'          => 'ISBN-13',
		'_doralashab_edition'          => 'رقم الطبعة',
		'_doralashab_publication_year' => 'سنة النشر',
		'_doralashab_pages'            => 'عدد الصفحات',
		'_doralashab_binding'          => 'نوع الغلاف',
		'_doralashab_dimensions'       => 'مقاس الكتاب',
		'_doralashab_preview_url'      => 'رابط المعاينة',
	);

	public static function boot(): void {
		add_action( 'init', array( __CLASS__, 'register_taxonomies' ) );
		add_filter( 'woocommerce_product_data_tabs', array( __CLASS__, 'add_product_tab' ) );
		add_action( 'woocommerce_product_data_panels', array( __CLASS__, 'render_product_panel' ) );
		add_action( 'woocommerce_process_product_meta', array( __CLASS__, 'save_product_fields' ) );
		add_action( 'woocommerce_single_product_summary', array( __CLASS__, 'render_book_details' ), 25 );
		add_filter( 'woocommerce_structured_data_product', array( __CLASS__, 'extend_product_schema' ), 10, 2 );
		add_filter( 'manage_edit-product_columns', array( __CLASS__, 'add_admin_columns' ) );
		add_action( 'manage_product_posts_custom_column', array( __CLASS__, 'render_admin_columns' ), 10, 2 );
		add_action( 'woocommerce_product_import_inserted_product_object', array( __CLASS__, 'map_imported_authors' ), 10, 2 );
		add_shortcode( 'doralashab_authors', array( __CLASS__, 'authors_shortcode' ) );
		add_shortcode( 'doralashab_contact', array( __CLASS__, 'contact_shortcode' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_assets' ) );
	}

	public static function activate(): void {
		self::register_taxonomies();
		flush_rewrite_rules();
	}

	public static function register_taxonomies(): void {
		self::register_people_taxonomy(
			'book_author',
			array(
				'name'          => 'المؤلفون',
				'singular_name' => 'المؤلف',
				'menu_name'     => 'المؤلفون',
				'search_items'  => 'البحث في المؤلفين',
				'all_items'     => 'كل المؤلفين',
				'edit_item'     => 'تعديل المؤلف',
				'add_new_item'  => 'إضافة مؤلف',
			),
			'author'
		);
		self::register_people_taxonomy(
			'book_translator',
			array(
				'name'          => 'المترجمون والمحققون',
				'singular_name' => 'المترجم أو المحقق',
				'menu_name'     => 'المترجمون',
				'search_items'  => 'البحث في المترجمين',
				'all_items'     => 'كل المترجمين',
				'edit_item'     => 'تعديل المترجم',
				'add_new_item'  => 'إضافة مترجم',
			),
			'translator'
		);

		register_taxonomy(
			'book_series',
			array( 'product' ),
			array(
				'labels'            => array(
					'name'          => 'السلاسل',
					'singular_name' => 'السلسلة',
					'menu_name'     => 'السلاسل',
					'all_items'     => 'كل السلاسل',
					'edit_item'     => 'تعديل السلسلة',
					'add_new_item'  => 'إضافة سلسلة',
				),
				'public'            => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_rest'      => true,
				'hierarchical'      => true,
				'rewrite'           => array( 'slug' => 'book-series' ),
			)
		);
	}

	private static function register_people_taxonomy( string $taxonomy, array $labels, string $slug ): void {
		register_taxonomy(
			$taxonomy,
			array( 'product' ),
			array(
				'labels'            => $labels,
				'public'            => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_rest'      => true,
				'hierarchical'      => false,
				'rewrite'           => array( 'slug' => $slug ),
			)
		);
	}

	public static function add_product_tab( array $tabs ): array {
		$tabs['doralashab_book'] = array(
			'label'    => 'بيانات الكتاب',
			'target'   => 'doralashab_book_data',
			'class'    => array( 'show_if_simple', 'show_if_variable' ),
			'priority' => 22,
		);
		return $tabs;
	}

	public static function render_product_panel(): void {
		?>
		<div id="doralashab_book_data" class="panel woocommerce_options_panel hidden">
			<div class="options_group">
				<?php
				woocommerce_wp_text_input( array( 'id' => '_doralashab_isbn_13', 'label' => 'ISBN-13', 'desc_tip' => true, 'description' => 'يُستخدم تلقائيًا كرمز SKU إذا كان الرمز فارغًا.' ) );
				woocommerce_wp_text_input( array( 'id' => '_doralashab_isbn_10', 'label' => 'ISBN-10' ) );
				woocommerce_wp_text_input( array( 'id' => '_doralashab_edition', 'label' => 'رقم الطبعة' ) );
				woocommerce_wp_text_input( array( 'id' => '_doralashab_publication_year', 'label' => 'سنة النشر', 'type' => 'number', 'custom_attributes' => array( 'min' => '1000', 'max' => '2100' ) ) );
				woocommerce_wp_text_input( array( 'id' => '_doralashab_pages', 'label' => 'عدد الصفحات', 'type' => 'number', 'custom_attributes' => array( 'min' => '1' ) ) );
				woocommerce_wp_select( array( 'id' => '_doralashab_binding', 'label' => 'نوع الغلاف', 'options' => array( '' => '— اختر —', 'paperback' => 'غلاف ورقي', 'hardcover' => 'غلاف مقوى', 'digital' => 'رقمي', 'other' => 'أخرى' ) ) );
				woocommerce_wp_text_input( array( 'id' => '_doralashab_dimensions', 'label' => 'مقاس الكتاب', 'placeholder' => 'مثال: 17 × 24 سم' ) );
				woocommerce_wp_text_input( array( 'id' => '_doralashab_preview_url', 'label' => 'رابط المعاينة', 'type' => 'url', 'description' => 'رابط فصل تجريبي أو فهرس متاح للعامة.' ) );
				?>
			</div>
		</div>
		<?php
	}

	public static function save_product_fields( int $post_id ): void {
		if ( ! isset( $_POST['woocommerce_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['woocommerce_meta_nonce'] ) ), 'woocommerce_save_data' ) ) {
			return;
		}

		foreach ( self::META_FIELDS as $key => $label ) {
			$value = isset( $_POST[ $key ] ) ? wp_unslash( $_POST[ $key ] ) : '';
			$value = '_doralashab_preview_url' === $key ? esc_url_raw( $value ) : sanitize_text_field( $value );
			if ( '' === $value ) {
				delete_post_meta( $post_id, $key );
			} else {
				update_post_meta( $post_id, $key, $value );
			}
		}

		$isbn_13 = get_post_meta( $post_id, '_doralashab_isbn_13', true );
		$product = wc_get_product( $post_id );
		if ( $isbn_13 && $product && ! $product->get_sku() && ! wc_get_product_id_by_sku( $isbn_13 ) ) {
			$product->set_sku( $isbn_13 );
			$product->save();
		}
	}

	public static function render_book_details(): void {
		global $product;
		if ( ! $product instanceof WC_Product ) {
			return;
		}

		$details = array();
		$authors = wc_get_product_term_ids( $product->get_id(), 'book_author' );
		if ( $authors ) {
			$details['المؤلف'] = get_the_term_list( $product->get_id(), 'book_author', '', '، ' );
		}
		$translators = wc_get_product_term_ids( $product->get_id(), 'book_translator' );
		if ( $translators ) {
			$details['المترجم أو المحقق'] = get_the_term_list( $product->get_id(), 'book_translator', '', '، ' );
		}

		foreach ( self::META_FIELDS as $key => $label ) {
			$value = get_post_meta( $product->get_id(), $key, true );
			if ( ! $value ) {
				continue;
			}
			if ( '_doralashab_binding' === $key ) {
				$value = array( 'paperback' => 'غلاف ورقي', 'hardcover' => 'غلاف مقوى', 'digital' => 'رقمي', 'other' => 'أخرى' )[ $value ] ?? $value;
			}
			if ( '_doralashab_preview_url' === $key ) {
				$value = sprintf( '<a href="%s" target="_blank" rel="noopener">قراءة المعاينة</a>', esc_url( $value ) );
			}
			$details[ $label ] = $value;
		}

		if ( ! $details ) {
			return;
		}
		?>
		<section class="doralashab-book-details" aria-labelledby="doralashab-book-details-title">
			<h2 id="doralashab-book-details-title">بيانات الكتاب</h2>
			<dl>
				<?php foreach ( $details as $label => $value ) : ?>
					<div><dt><?php echo esc_html( $label ); ?></dt><dd><?php echo wp_kses_post( $value ); ?></dd></div>
				<?php endforeach; ?>
			</dl>
		</section>
		<?php
	}

	public static function extend_product_schema( array $markup, WC_Product $product ): array {
		$isbn = get_post_meta( $product->get_id(), '_doralashab_isbn_13', true ) ?: get_post_meta( $product->get_id(), '_doralashab_isbn_10', true );
		if ( $isbn ) {
			$markup['isbn'] = $isbn;
		}
		return $markup;
	}

	public static function add_admin_columns( array $columns ): array {
		$columns['doralashab_isbn'] = 'ISBN';
		return $columns;
	}

	public static function render_admin_columns( string $column, int $post_id ): void {
		if ( 'doralashab_isbn' === $column ) {
			echo esc_html( get_post_meta( $post_id, '_doralashab_isbn_13', true ) ?: get_post_meta( $post_id, '_doralashab_isbn_10', true ) ?: '—' );
		}
	}

	public static function map_imported_authors( WC_Product $product, array $data ): void {
		$names = array();
		foreach ( $product->get_attributes() as $attribute ) {
			if ( preg_match( '/مؤلف/u', wc_attribute_label( $attribute->get_name() ) ) ) {
				$names = array_merge( $names, $attribute->get_options() );
			}
		}
		$names = array_filter( array_map( 'sanitize_text_field', $names ) );
		if ( $names ) {
			wp_set_object_terms( $product->get_id(), array_values( array_unique( $names ) ), 'book_author', false );
		}
	}

	public static function authors_shortcode(): string {
		$terms = get_terms( array( 'taxonomy' => 'book_author', 'hide_empty' => true, 'number' => 24, 'orderby' => 'name' ) );
		if ( is_wp_error( $terms ) || ! $terms ) {
			return '<p>سيتم إضافة المؤلفين قريبًا.</p>';
		}
		ob_start();
		?>
		<div class="doralashab-authors-grid">
			<?php foreach ( $terms as $term ) : ?>
				<a class="doralashab-author-card" href="<?php echo esc_url( get_term_link( $term ) ); ?>">
					<span><?php echo esc_html( mb_substr( $term->name, 0, 1 ) ); ?></span>
					<strong><?php echo esc_html( $term->name ); ?></strong>
					<small><?php echo esc_html( number_format_i18n( $term->count ) ); ?> كتاب</small>
				</a>
			<?php endforeach; ?>
		</div>
		<?php
		return (string) ob_get_clean();
	}

	public static function contact_shortcode(): string {
		$status = '';
		if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['doralashab_contact_nonce'] ) ) {
			$nonce = sanitize_text_field( wp_unslash( $_POST['doralashab_contact_nonce'] ) );
			if ( wp_verify_nonce( $nonce, 'doralashab_contact' ) ) {
				$name    = sanitize_text_field( wp_unslash( $_POST['doralashab_name'] ?? '' ) );
				$email   = sanitize_email( wp_unslash( $_POST['doralashab_email'] ?? '' ) );
				$message = sanitize_textarea_field( wp_unslash( $_POST['doralashab_message'] ?? '' ) );
				if ( $name && is_email( $email ) && $message ) {
					$sent = wp_mail( get_option( 'admin_email' ), 'رسالة من متجر دور الأصحاب', "الاسم: {$name}\nالبريد: {$email}\n\n{$message}", array( 'Reply-To: ' . $name . ' <' . $email . '>' ) );
					$status = $sent ? 'تم استلام رسالتك، وسنتواصل معك قريبًا.' : 'تعذر إرسال الرسالة الآن. فضلاً تواصل معنا عبر البريد.';
				} else {
					$status = 'يرجى إكمال البيانات المطلوبة بصورة صحيحة.';
				}
			}
		}
		ob_start();
		?>
		<?php if ( $status ) : ?><p class="doralashab-contact-status" role="status"><?php echo esc_html( $status ); ?></p><?php endif; ?>
		<form class="doralashab-contact-form" method="post">
			<?php wp_nonce_field( 'doralashab_contact', 'doralashab_contact_nonce' ); ?>
			<label>الاسم الكامل<input required name="doralashab_name" type="text" autocomplete="name"></label>
			<label>البريد الإلكتروني<input required name="doralashab_email" type="email" autocomplete="email"></label>
			<label>الرسالة<textarea required name="doralashab_message" rows="6"></textarea></label>
			<button type="submit">إرسال الرسالة</button>
		</form>
		<?php
		return (string) ob_get_clean();
	}

	public static function enqueue_assets(): void {
		wp_enqueue_style( 'doralashab-books', plugin_dir_url( __FILE__ ) . 'assets/books.css', array(), self::VERSION );
	}
}

register_activation_hook( __FILE__, array( 'Doralashab_Books', 'activate' ) );
Doralashab_Books::boot();
