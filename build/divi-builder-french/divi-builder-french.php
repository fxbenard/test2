<?php
/**
 * Plugin Name:      Divi Builder French
 * Plugin URI:      http://fxbenard.com/traductions/divi-builder-french
 * Description:     French Translations for Divi Builder
 * Version: 1.1.0
 * Author:          FX Bénard
 * Author URI:      https://fxbenard.com
 * Text Domain:     divi-builder-french
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @package         Divi-Builder-French
 * @author          FX Bénard <fx@fxbenard.com>
 * @copyright       Copyright (c) 2015 FX Bénard
 * @license         http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 */

// SECURITY : Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	die( 'Direct acces not allowed!' );
}

// Define constants
if ( ! defined( 'DIVI_BUILDER_FRENCH_STORE_URL' ) ) {
	define( 'DIVI_BUILDER_FRENCH_STORE_URL', 'https://fxbenard.com' );
}
if ( ! defined( 'DIVI_BUILDER_FRENCH_ITEM_NAME' ) ) {
	define( 'DIVI_BUILDER_FRENCH_ITEM_NAME', 'Divi Builder French' );
}
// Plugin version
if ( ! defined( 'DIVI_BUILDER_FRENCH_VER' ) ) {
	define( 'DIVI_BUILDER_FRENCH_VER' , '1.1.0' );
}
// Plugin path
if ( ! defined( 'DIVI_BUILDER_FRENCH_DIR' ) ) {
	define( 'DIVI_BUILDER_FRENCH_DIR', plugin_dir_path( __FILE__ ) );
}
// Plugin URL
if ( ! defined( 'DIVI_BUILDER_FRENCH_URL' ) ) {
	define( 'DIVI_BUILDER_FRENCH_URL', plugin_dir_url( __FILE__ ) );
}
if ( ! class_exists( 'DIVI_BUILDER_FRENCH_Plugin_Updater' ) ) {
		// load our custom updater
		include( dirname( __FILE__ ) . '/includes/DIVI_BUILDER_FRENCH_Plugin_Updater.php' );
}

add_action( 'plugins_loaded', 'divi_builder_french_load_textdomain' );
function divi_builder_french_load_textdomain() {
	// Set filter for language directory
	$lang_dir = DIVI_BUILDER_FRENCH_DIR . '/languages/';
	$lang_dir = apply_filters( 'divi_builder_french_languages_directory', $lang_dir );

	// Traditional WordPress plugin locale filter
	$locale = apply_filters( 'plugin_locale', get_locale(), 'divi-builder-french' );
	$mofile = sprintf( '%1$s-%2$s.mo', 'divi-builder-french', $locale );

	// Setup paths to current locale file
	$mofile_local   = $lang_dir . $mofile;
	$mofile_global  = WP_LANG_DIR . '/divi-builder-french/' . $mofile;

	if ( file_exists( $mofile_global ) ) {
		// Look in global /wp-content/languages/divi-builder-french/ folder
		load_textdomain( 'divi-builder-french', $mofile_global );
	} elseif ( file_exists( $mofile_local ) ) {
		// Look in local /wp-content/plugins/divi-builder-french/languages/ folder
		load_textdomain( 'divi-builder-french', $mofile_local );
	} else {
		// Load the default language files
		load_plugin_textdomain( 'divi-builder-french', false, $lang_dir );
	}
}

add_action( 'init', 'fxb_divi_builder_init' );
function fxb_divi_builder_init() {

	/* Language */
	// Set filter for language directory
	$lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$lang_dir = apply_filters( 'divi_builder_source_translations_languages_directory', $lang_dir );

	// Traditional WordPress plugin locale filter
	$locale = apply_filters( 'plugin_locale', get_locale(), 'et_builder_plugin' );
	$mofile = sprintf( '%1$s-%2$s.mo', 'et_builder_plugin', $locale );

	// Setup paths to current locale file
	$mofile_local   = $lang_dir . $mofile;
	$mofile_global  = WP_LANG_DIR . '/divi-builder/' . $mofile;

	if ( file_exists( $mofile_global ) ) {
		// Look in global /wp-content/languages/divi-builder-french/ folder
		load_textdomain( 'et_builder_plugin', $mofile_global );
	} elseif ( file_exists( $mofile_local ) ) {
			// Look in local /wp-content/plugins/divi-builder-french/languages/ folder
			load_textdomain( 'et_builder_plugin', $mofile_local );
	} else {
		// Load the default language files
		load_plugin_textdomain( 'et_builder_plugin', false, $lang_dir );
	}
}

add_action( 'init', 'fxb_et_builder_init' );
function fxb_et_builder_init() {

	/* Language */
	// Set filter for language directory
	$lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
	$lang_dir = apply_filters( 'divi_builder_source_translations_languages_directory', $lang_dir );

	// Traditional WordPress plugin locale filter
	$locale = apply_filters( 'plugin_locale', get_locale(), 'et_builder' );
	$mofile = sprintf( '%1$s-%2$s.mo', 'et_builder', $locale );

	// Setup paths to current locale file
	$mofile_local   = $lang_dir . $mofile;
	$mofile_global  = WP_LANG_DIR . '/divi-builder/' . $mofile;

	if ( file_exists( $mofile_global ) ) {
		// Look in global /wp-content/languages/divi-builder-french/ folder
		load_textdomain( 'et_builder', $mofile_global );
	} elseif ( file_exists( $mofile_local ) ) {
		// Look in local /wp-content/plugins/divi-builder-french/languages/ folder
		load_textdomain( 'et_builder', $mofile_local );
	} else {
		// Load the default language files
		load_plugin_textdomain( 'et_builder', false, $lang_dir );
	}
}

// OFF during testing
// function builder_exist_init() {
// 	if ( ! class_exists( 'ET_Builder_Plugin' ) ) {

// 		add_action( 'admin_init', 'divi_builder_deactivate' );
// 		add_action( 'admin_notices', 'divi_builder_admin_notice' );

// 		function divi_builder_deactivate() {
// 			deactivate_plugins( plugin_basename( __FILE__ ) );
// 		}

// 		function divi_builder_admin_notice() {
// 			$url  = esc_url( 'https://www.fxbenard.com/recommande/divi-builder' );
// 			$link = '<a href="' . $url . '">' . 'Divi Builder' . '</a>';

// 			echo '<div class="error"><p>' . 'Divi Builder French' . sprintf( __( ' requires %s! Please active it  or install it to continue!', 'divi-builder-french' ), $link ) . '</p></div>';
// 		}
// 		if ( isset( $_GET['activate'] ) ) {
// 			 unset( $_GET['activate'] ); }
// 	}
// }
// add_action( 'plugins_loaded', 'builder_exist_init' );

function divi_builder_french_plugin_updater() {

	// retrieve our license key from the DB
		$license_key = trim( get_option( 'divi_builder_french_license_key' ) );

		// setup the updater
		$edd_updater = new DIVI_BUILDER_FRENCH_Plugin_Updater( DIVI_BUILDER_FRENCH_STORE_URL, __FILE__, array(
			'version' 	=> DIVI_BUILDER_FRENCH_VER,
			'license' 	=> $license_key, 		// license key (used get_option above to retrieve from DB)
			'item_name' => DIVI_BUILDER_FRENCH_ITEM_NAME,
			'author' 	=> 'fxbenard',
			)
		);
}
add_action( 'admin_init', 'divi_builder_french_plugin_updater', 0 );

// function divi_builder_french_license_menu() {
// 	add_plugins_page( __( 'Divi Builder French License', 'divi-builder-french' ), __( 'Divi Builder French License', 'divi-builder-french' ), 'manage_options', 'fxbenard-license', 'divi_builder_french_license_page' );
// }
// add_action( 'admin_menu', 'divi_builder_french_license_menu' );

add_action( 'admin_menu', 'fxtrads_add_admin_menu' );

if ( ! function_exists( 'fxtrads_add_admin_menu' ) ) {
function fxtrads_add_admin_menu(  ) {
	add_plugins_page( 'FX Trads', 'FX Trads', 'manage_options', 'fx_trads', 'fx_trads_licences_page' );
}
}

function fx_trads_licences_page() {
	$license  = get_option( 'divi_builder_french_license_key' );
	$status 	= get_option( 'divi_builder_french_license_status' );
	?>
	<div class="wrap">
		<h2><?php _e( 'Divi Builder French License Options', 'divi-builder-french' ); ?></h2>
        <form method="post" action="options.php">

	<?php settings_fields( 'divi_builder_french_license' ); ?>


 <?php do_action( 'fxb' ); ?>



	<table class="form-table">
			<tbody>
					<tr valign="top">
							<th scope="row" valign="top">
							<?php _e( 'License Key', 'divi-builder-french' ); ?>
							</th>
								<td>
									<input id="divi_builder_french_license_key" name="divi_builder_french_license_key" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" />
									<label class="description" for="divi_builder_french_license_key"><?php _e( 'Enter your license key', 'divi-builder-french' ); ?></label>
								</td>
					 </tr>
                    <?php if ( false !== $license ) { ?>
                    <tr valign="top">
                            <th scope="row" valign="top">
					<?php _e( 'Activate License', 'divi-builder-french' ); ?>
                            </th>
                            <td>
								<?php if ( false !== $status  && 'valid' == $status ) { ?>
									<span style="color:green;"><?php _e( 'active', 'divi-builder-french' ); ?></span>
									<?php wp_nonce_field( 'divi_builder_french_nonce', 'divi_builder_french_nonce' ); ?>
									<input type="submit" class="button-secondary" name="fxb_license_deactivate" value="<?php _e( 'Deactivate License', 'divi-builder-french' ); ?>"/>
								<?php } else {
									wp_nonce_field( 'divi_builder_french_nonce', 'divi_builder_french_nonce' ); ?>
									<input type="submit" class="button-secondary" name="fxb_license_activate" value="<?php _e( 'Activate License', 'divi-builder-french' ); ?>"/>
								<?php } ?>
                            </td>
                        </tr>
					<?php } ?>
						</tbody>
					</table>
					<?php submit_button(); ?>

				</form>
			<?php
}

function divi_builder_french_register_option() {
	// creates our settings in the options table
	register_setting( 'divi_builder_french_license', 'divi_builder_french_license_key', 'divi_builder_french_sanitize_license' );
}
add_action( 'admin_init', 'divi_builder_french_register_option' );


function divi_builder_french_sanitize_license( $new ) {
	$old = get_option( 'divi_builder_french_license_key' );
	if ( $old && $old != $new ) {
		delete_option( 'divi_builder_french_license_status' ); // new license has been entered, so must reactivate
	}
	return $new;
}

function divi_builder_french_activate_license() {

	// listen for our activate button to be clicked
	if ( isset( $_POST['edd_license_activate'] ) ) {

		// run a quick security check
		if ( ! check_admin_referer( 'divi_builder_french_nonce', 'divi_builder_french_nonce' ) ) {
			return; // get out if we didn't click the Activate button
		}
		// retrieve the license from the database
		$license = trim( get_option( 'divi_builder_french_license_key' ) );

		// data to send in our API request
		$api_params = array(
			'edd_action' => 'activate_license',
			'license' 	=> $license,
			'item_name' => urlencode( DIVI_BUILDER_FRENCH_ITEM_NAME ), // the name of our product in EDD
			'url'       => home_url()
		);

		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, DIVI_BUILDER_FRENCH_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) ) {
			return false; }

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "valid" or "invalid"

		update_option( 'divi_builder_french_license_status', $license_data->license );

	}
}
add_action( 'admin_init', 'divi_builder_french_activate_license' );

function divi_builder_french_deactivate_license() {

	// listen for our activate button to be clicked
	if ( isset( $_POST['edd_license_deactivate'] ) ) {

				// run a quick security check
		if ( ! check_admin_referer( 'divi_builder_french_nonce', 'divi_builder_french_nonce' ) ) {
			return; // get out if we didn't click the Activate button
		}
			// retrieve the license from the database
			$license = trim( get_option( 'divi_builder_french_license_key' ) );

			// data to send in our API request
			$api_params = array(
				'edd_action' => 'deactivate_license',
				'license' 	=> $license,
				'item_name' => urlencode( DIVI_BUILDER_FRENCH_ITEM_NAME ), // the name of our product in EDD
				'url'       => home_url()
			);

			// Call the custom API.
			$response = wp_remote_get( add_query_arg( $api_params, DIVI_BUILDER_FRENCH_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

			// make sure the response came back okay
			if ( is_wp_error( $response ) ) {
				return false; }

			// decode the license data
			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			// $license_data->license will be either "deactivated" or "failed"
			if ( 'deactivated' == $license_data->license  ) {
				delete_option( 'divi_builder_french_license_status' ); }
	}
}
add_action( 'admin_init', 'divi_builder_french_deactivate_license' );

function divi_builder_french_check_license() {

	global $wp_version;

		$license = trim( get_option( 'divi_builder_french_license_key' ) );

		$api_params = array(
			'edd_action' => 'check_license',
			'license' => $license,
			'item_name' => urlencode( DIVI_BUILDER_FRENCH_ITEM_NAME ),
			'url'       => home_url()
		);

		// Call the custom API.
		$response = wp_remote_get( add_query_arg( $api_params, DIVI_BUILDER_FRENCH_STORE_URL ), array( 'timeout' => 15, 'sslverify' => false ) );

		if ( is_wp_error( $response ) ) {
			return false; }

		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		if ( 'valid' == $license_data->license ) {
			echo 'valid'; exit;
			// this license is still valid
		} else {
			echo 'invalid'; exit;
			// this license is no longer valid
		}
}
