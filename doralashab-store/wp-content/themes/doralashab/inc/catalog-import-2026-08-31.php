<?php
/**
 * One-time, versioned catalog refresh for the verified SQC book data.
 *
 * This file is temporary deployment infrastructure. It only reads the
 * version-controlled CSV files in this theme and is removed once the import
 * completes and has been verified.
 */

defined( 'ABSPATH' ) || exit;

const DORALASHAB_CATALOG_IMPORT_VERSION = '2026-08-31-1';

/**
 * @return array<int, array<string, string>>
 */
function doralashab_catalog_import_csv( string $filename ): array {
	$path = get_template_directory() . '/assets/private-import/' . $filename;
	if ( ! is_readable( $path ) ) {
		throw new RuntimeException( 'Catalog import file is unavailable: ' . $filename );
	}

	$handle = fopen( $path, 'r' ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fopen
	if ( false === $handle ) {
		throw new RuntimeException( 'Catalog import file cannot be opened: ' . $filename );
	}

	$utf8_bom = fread( $handle, 3 );
	if ( "\xEF\xBB\xBF" !== $utf8_bom ) {
		rewind( $handle );
	}

	$headers = fgetcsv( $handle );
	if ( false === $headers ) {
		fclose( $handle ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fclose
		throw new RuntimeException( 'Catalog import file has no headers: ' . $filename );
	}

	$headers = array_map( static fn( $header ) => trim( (string) $header ), $headers );
	$rows    = array();
	while ( false !== ( $values = fgetcsv( $handle ) ) ) {
		if ( count( $values ) < count( $headers ) ) {
			$values = array_pad( $values, count( $headers ), '' );
		}
		$row = array_combine( $headers, array_slice( $values, 0, count( $headers ) ) );
		if ( is_array( $row ) ) {
			$rows[] = array_map( static fn( $value ) => trim( (string) $value ), $row );
		}
	}
	fclose( $handle ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_fclose

	return $rows;
}

function doralashab_catalog_import_product( array $row, bool $new_product = false ): WC_Product {
	if ( $new_product ) {
		$sku        = $row['SKU'] ?? '';
		$product_id = $sku ? wc_get_product_id_by_sku( $sku ) : 0;
		$product    = $product_id ? wc_get_product( $product_id ) : new WC_Product_Simple();
		if ( ! $product instanceof WC_Product ) {
			throw new RuntimeException( 'Unable to create or retrieve a draft product.' );
		}
		$product->set_sku( $sku );
		$product->set_status( 'draft' );
		$product->set_catalog_visibility( 'hidden' );
		$product->set_manage_stock( true );
		$product->set_stock_quantity( 0 );
		$product->set_stock_status( 'outofstock' );
		$product->set_backorders( 'no' );
	} else {
		$product = wc_get_product( absint( $row['ID'] ?? 0 ) );
		if ( ! $product instanceof WC_Product ) {
			throw new RuntimeException( 'Verified existing product was not found: ' . ( $row['ID'] ?? 'unknown' ) );
		}
	}

	return $product;
}

function doralashab_catalog_import_cover( WC_Product $product, string $source_url ): void {
	$source_url = esc_url_raw( $source_url );
	$host       = (string) wp_parse_url( $source_url, PHP_URL_HOST );
	if ( ! $source_url || ! str_ends_with( $host, 'cdn.salla.sa' ) ) {
		throw new RuntimeException( 'A non-SQC cover URL was rejected.' );
	}

	$current_attachment = (int) $product->get_image_id();
	if ( $current_attachment && $source_url === get_post_meta( $current_attachment, '_doralashab_source_cover_url', true ) ) {
		return;
	}

	if ( ! function_exists( 'media_sideload_image' ) ) {
		require_once ABSPATH . 'wp-admin/includes/file.php';
		require_once ABSPATH . 'wp-admin/includes/media.php';
		require_once ABSPATH . 'wp-admin/includes/image.php';
	}

	$attachment_id = media_sideload_image( $source_url, $product->get_id(), $product->get_name(), 'id' );
	if ( is_wp_error( $attachment_id ) ) {
		throw new RuntimeException( 'Official cover could not be imported for product ' . $product->get_id() . ': ' . $attachment_id->get_error_message() );
	}

	update_post_meta( (int) $attachment_id, '_doralashab_source_cover_url', $source_url );
	$product->set_image_id( (int) $attachment_id );
}

function doralashab_catalog_import_author( WC_Product $product, string $author ): void {
	$author = trim( $author );
	if ( '' === $author ) {
		return;
	}

	if ( taxonomy_exists( 'book_author' ) ) {
		$terms = array_filter( array_map( 'trim', preg_split( '/[،,]/u', $author ) ) );
		wp_set_object_terms( $product->get_id(), $terms, 'book_author', false );
	}

	$attributes          = $product->get_attributes();
	$author_attribute    = new WC_Product_Attribute();
	$author_attribute->set_id( 0 );
	$author_attribute->set_name( 'المؤلف' );
	$author_attribute->set_options( array( $author ) );
	$author_attribute->set_position( 0 );
	$author_attribute->set_visible( true );
	$author_attribute->set_variation( false );
	$attributes['المؤلف'] = $author_attribute;
	$product->set_attributes( $attributes );
}

function doralashab_catalog_import_apply_row( array $row, bool $new_product = false ): int {
	$product = doralashab_catalog_import_product( $row, $new_product );

	if ( isset( $row['Name'] ) ) {
		$product->set_name( wp_strip_all_tags( $row['Name'] ) );
	}
	if ( isset( $row['Short description'] ) ) {
		$product->set_short_description( wp_kses_post( $row['Short description'] ) );
	}
	if ( isset( $row['Description'] ) ) {
		$product->set_description( wp_kses_post( $row['Description'] ) );
	}

	$product->save();

	if ( ! empty( $row['Images'] ) ) {
		doralashab_catalog_import_cover( $product, $row['Images'] );
	}
	if ( ! empty( $row['Attribute 1 value(s)'] ) ) {
		doralashab_catalog_import_author( $product, $row['Attribute 1 value(s)'] );
	}
	if ( $new_product && ! empty( $row['Categories'] ) ) {
		$categories = array_filter( array_map( 'trim', explode( ',', $row['Categories'] ) ) );
		$term_ids   = array();
		foreach ( $categories as $category ) {
			$term = term_exists( $category, 'product_cat' );
			if ( ! $term ) {
				$term = wp_insert_term( $category, 'product_cat' );
			}
			if ( is_array( $term ) && ! empty( $term['term_id'] ) ) {
				$term_ids[] = (int) $term['term_id'];
			} elseif ( is_numeric( $term ) ) {
				$term_ids[] = (int) $term;
			}
		}
		if ( $term_ids ) {
			$product->set_category_ids( $term_ids );
		}
	}

	foreach ( $row as $column => $value ) {
		if ( str_starts_with( $column, 'Meta: ' ) ) {
			$product->update_meta_data( substr( $column, 6 ), $value );
		}
	}
	$product->save();

	return $product->get_id();
}

function doralashab_apply_verified_catalog_refresh(): void {
	if ( DORALASHAB_CATALOG_IMPORT_VERSION === get_option( 'doralashab_catalog_import_version' ) ) {
		return;
	}
	if ( get_transient( 'doralashab_catalog_import_lock' ) ) {
		return;
	}
	set_transient( 'doralashab_catalog_import_lock', 1, 15 * MINUTE_IN_SECONDS );

	try {
		if ( ! function_exists( 'wc_get_product' ) ) {
			throw new RuntimeException( 'WooCommerce is not active.' );
		}
		$existing_rows = doralashab_catalog_import_csv( 'existing-books-update.csv' );
		$page_rows     = doralashab_catalog_import_csv( 'verified-page-counts.csv' );
		$new_rows      = doralashab_catalog_import_csv( 'new-books-DRAFT.csv' );

		foreach ( $existing_rows as $row ) {
			doralashab_catalog_import_apply_row( $row );
		}
		foreach ( $page_rows as $row ) {
			$product = doralashab_catalog_import_product( $row );
			$product->update_meta_data( '_doralashab_pages', $row['Meta: _doralashab_pages'] ?? '' );
			$product->save();
		}
		foreach ( $new_rows as $row ) {
			doralashab_catalog_import_apply_row( $row, true );
		}

		update_option( 'doralashab_catalog_import_version', DORALASHAB_CATALOG_IMPORT_VERSION, false );
		delete_option( 'doralashab_catalog_import_error' );
	} catch ( Throwable $error ) {
		update_option( 'doralashab_catalog_import_error', $error->getMessage(), false );
		error_log( 'Doralashab catalog import failed: ' . $error->getMessage() ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
	} finally {
		delete_transient( 'doralashab_catalog_import_lock' );
	}
}
add_action( 'init', 'doralashab_apply_verified_catalog_refresh', 99 );

/**
 * Temporary read-only diagnostic used to verify the one-time import. Removed
 * with this file once the catalog has been checked publicly.
 */
function doralashab_catalog_import_diagnostic(): void {
	register_rest_route(
		'doralashab/v1',
		'/catalog-import-status',
		array(
			'methods'             => 'GET',
			'permission_callback' => '__return_true',
			'callback'            => static function (): WP_REST_Response {
				return new WP_REST_Response(
					array(
						'completed' => DORALASHAB_CATALOG_IMPORT_VERSION === get_option( 'doralashab_catalog_import_version' ),
						'error'     => (string) get_option( 'doralashab_catalog_import_error', '' ),
					)
				);
			},
		)
	);
}
add_action( 'rest_api_init', 'doralashab_catalog_import_diagnostic' );
