<?php
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

/**
 * Add plugin page
 *
 * @since 1.0
 */
if ( ! function_exists( 'fx_trads_license_menu' ) ) {
	function fx_trads_license_menu() {
		add_plugins_page( __( 'FX Trads License Options', 'test2' ), __( 'FX Trads', 'test2' ), 'manage_options', 'fx-trads-license', 'fx_trads_license_page' );
	}

	add_action( 'admin_menu', 'fx_trads_license_menu' );
}

/**
 * Register section / field for plugin page
 *
 * @since 1.2
 */
add_action( 'admin_init', 'test_2_license_init_page' );
function test_2_license_init_page() {
		register_setting( 'test_2_license', 'test_2_license_key', 'test_2_sanitize_license' );
		add_settings_section( 'section-test2',   '', '',  'fx-trads-license' );
		add_settings_field( 'test_2_key',  esc_html__( 'Test-1',  'test2' ), 'test_2_key_callback', 'fx-trads-license', 'section-test2' );
}

/**
 * Callback function for test_2_key field
 *
 * @since 1.2
 */
function test_2_key_callback() {

	$license = get_option( 'test_2_license_key' );
	$status = get_option( 'test_2_license_status' );

	?>

  <label>
		<input type="text" id="test_2_license_key" class="regular-text" name="test_2_license_key" value="<?php echo esc_attr__( $license ); ?>"/>
		<span style="vertical-align: middle;" class="dashicons dashicons-admin-network"></span> <?php echo __( 'Enter your license key', 'test2' ); ?>
    </label>

        <div id="test2-reponse" style="width:600px; padding-top:1em;">

			<?php

			if ( false !== $license ) {

				if ( $status !== false && $status == 'valid' ) {

					$license_data = get_transient( '_test_2_license_data' );
					echo test_2_action_remove_license( $license_data->expires );

				} elseif ( $status === false OR $status != 'invalid' ) {

					echo test_2_action_add_license();

				}
			}

			?>

        </div>

<?php }

/**
 * Callback function for add_plugins_page
 *
 * @since 1.2
 */
if ( ! function_exists( 'fx_trads_license_page' ) ) {

	function fx_trads_license_page() {

		global $title;

		?>

        <div class="wrap">
			<h1><?php echo $title; ?></h1>

            <form action="options.php" method="POST">

					<?php settings_fields( 'test_2_license' ); ?>
					<?php do_settings_sections( 'fx-trads-license' ); ?>
					<?php submit_button(); ?>
            </form>

        </div>

		<?php
	}
}
