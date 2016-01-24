<?php
/**
 * Shoppette Updater
 */

// Includes the files needed for the theme updater
if ( !class_exists( 'Shoppette_Updater_Admin' ) ) {
	include( dirname( __FILE__ ) . '/theme-updater-admin.php' );
}

// Loads the updater classes
$updater = new Shoppette_Updater_Admin(

	// Config settings
	$config = array(
		'remote_api_url' => 'https://easydigitaldownloads.com', // Site where EDD is hosted
		'item_name' => SHOPPETTE_NAME,
		'theme_slug' => 'shoppette',
		'version' => SHOPPETTE_VERSION,
		'author' => SHOPPETTE_AUTHOR,
		'download_id' => '',
		'renew_url' => ''
	),

	// Strings
	$strings = array(
		'theme-license' => __( SHOPPETTE_NAME, 'shoppette' ),
		'enter-key' => __( 'Enter your theme license key.', 'shoppette' ),
		'license-key' => __( 'License Key', 'shoppette' ),
		'license-action' => __( 'License Action', 'shoppette' ),
		'deactivate-license' => __( 'Deactivate License', 'shoppette' ),
		'activate-license' => __( 'Activate License', 'shoppette' ),
		'status-unknown' => __( 'License status is unknown.', 'shoppette' ),
		'renew' => __( 'Renew?', 'shoppette' ),
		'unlimited' => __( 'unlimited', 'shoppette' ),
		'license-key-is-active' => __( 'License key is active.', 'shoppette' ),
		'expires%s' => __( 'Expires %s.', 'shoppette' ),
		'%1$s/%2$-sites' => __( 'You have %1$s / %2$s sites activated.', 'shoppette' ),
		'license-key-expired-%s' => __( 'License key expired %s.', 'shoppette' ),
		'license-key-expired' => __( 'License key has expired.', 'shoppette' ),
		'license-keys-do-not-match' => __( 'License keys do not match.', 'shoppette' ),
		'license-is-inactive' => __( 'License is inactive.', 'shoppette' ),
		'license-key-is-disabled' => __( 'License key is disabled.', 'shoppette' ),
		'site-is-inactive' => __( 'Site is inactive.', 'shoppette' ),
		'license-status-unknown' => __( 'License status is unknown.', 'shoppette' ),
		'update-notice' => __( "Updating this theme will lose any customizations you have made. 'Cancel' to stop, 'OK' to update.", 'shoppette' ),
		'update-available' => __('<strong>%1$s %2$s</strong> is available. <a href="%3$s" class="thickbox" title="%4s">Check out what\'s new</a> or <a href="%5$s"%6$s>update now</a>.', 'shoppette' )
	)

);