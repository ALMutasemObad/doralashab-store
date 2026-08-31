<?php
/**
 * One-time publication of the verified SQC titles that were previously held
 * as drafts while the catalog data was reviewed.
 */

defined( 'ABSPATH' ) || exit;

const DORALASHAB_CATALOG_PUBLICATION_VERSION = '2026-08-31-1';

function doralashab_publish_verified_catalog_titles(): void {
	if ( DORALASHAB_CATALOG_PUBLICATION_VERSION === get_option( 'doralashab_catalog_publication_version' ) ) {
		return;
	}
	if ( get_transient( 'doralashab_catalog_publication_lock' ) ) {
		return;
	}
	set_transient( 'doralashab_catalog_publication_lock', 1, 5 * MINUTE_IN_SECONDS );

	$skus = array(
		'SQC-661778100-P',
		'SQC-1824017480-P',
		'SQC-161403518-P',
		'SQC-639091500-P',
		'SQC-1365091920-P',
		'SQC-1201482192-P',
		'SQC-246033341-P',
		'SQC-576717039-P',
		'SQC-1629257401-P',
		'SQC-661615575-P',
		'SQC-1121827933-P',
		'SQC-171835359-P',
		'SQC-1484630056-P',
		'SQC-2061646917-P',
		'SQC-249295753-P',
		'SQC-666095328-P',
	);

	try {
		if ( ! function_exists( 'wc_get_product' ) ) {
			throw new RuntimeException( 'WooCommerce is not active.' );
		}
		foreach ( $skus as $sku ) {
			$product_id = wc_get_product_id_by_sku( $sku );
			$product    = $product_id ? wc_get_product( $product_id ) : false;
			if ( ! $product instanceof WC_Product ) {
				throw new RuntimeException( 'Verified catalog product was not found: ' . $sku );
			}
			$product->set_status( 'publish' );
			$product->set_catalog_visibility( 'visible' );
			$product->save();
		}

		update_option( 'doralashab_catalog_publication_version', DORALASHAB_CATALOG_PUBLICATION_VERSION, false );
		delete_option( 'doralashab_catalog_publication_error' );
	} catch ( Throwable $error ) {
		update_option( 'doralashab_catalog_publication_error', $error->getMessage(), false );
		error_log( 'Doralashab catalog publication failed: ' . $error->getMessage() ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
	} finally {
		delete_transient( 'doralashab_catalog_publication_lock' );
	}
}
add_action( 'init', 'doralashab_publish_verified_catalog_titles', 99 );
