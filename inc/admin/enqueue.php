<?php
defined( 'ABSPATH' ) or die( 'Cheatin\' uh?' );

/**
 * Load admin scripts
 *
 * @since 1.2
 */
function test_2_load_admin_script() {

  $translation_array = array(
  	'license_deactivate' => __( 'License deactivate', 'test2' ),
  );

  wp_enqueue_script( 'test2-script', TEST_2_ASSETS_JS_URL . 'test2-script.js', array( 'jquery' ), '1.0.0', false );

  wp_localize_script( 'test2-script', 'Test2Ajax', array (
      'ajaxurl' => admin_url( 'admin-ajax.php' ),
      'license_deactivate'=> $translation_array,
      'test_2_nonce' => wp_create_nonce( 'test-2-nonce' ),
  ) );

}
add_action( 'admin_enqueue_scripts', 'test_2_load_admin_script' );
