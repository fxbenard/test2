<?php
defined( 'ABSPATH' ) or die( 'Cheatin&#8217; uh?' );

/**
 * Ouput Activate license button
 *
 * @since 1.2
 */
function test_2_action_add_license() { ?>

	<div style="display:table-cell; vertical-align:middle; width:20%;"><button type="button" id="test_2_license_activate" class="button-secondary"> <?php _e( 'Activate License', 'test2' ); ?></button><span id="spinner-test-2" class="spinner"></span></div>

<?php }

/**
 * Ouput Dectivate license button and license informations
 *
 * @since 1.2
 */
function test_2_action_remove_license( $expires ) {

			list( $date, $time ) = explode( " ", $expires );
			$day_before_expires = ceil(abs( strtotime($date) - time() ) / 86400);

		?>

			<div style="display:table-cell; vertical-align:middle; width:20%;"><span style="color: green;" class="dashicons dashicons-yes"></span> <?php _e( 'License active', 'test2' ); ?></div>
			<div style="display:table-cell; vertical-align:middle; width:20%; margin-left:2%;"><span class="dashicons dashicons-backup"></span> <?php _e('Expires in', 'test2'); ?> : <strong><?php echo $day_before_expires; ?></strong> <?php _e('days', 'test2'); ?></div>
			<div style="display:table-cell; vertical-align:middle; width:20%; margin-left:2%;"><button type="button" id="test_2_license_deactivate" class="button-secondary"><span style="vertical-align: middle;" class="dashicons dashicons-no"></span> <?php _e( 'Deactivate License', 'test2' ); ?></button><span id="spinner-test-2" class="spinner"></span></div>

<?php }
