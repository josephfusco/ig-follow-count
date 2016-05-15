<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit ( "Direct access not permitted." );
}

$api_url      = "https://api.instagram.com/v1/users/" . IG_USER_ID . "/?access_token=" . IG_ACCESS_TOKEN;
$api_response = file_get_contents( $api_url );

/**
 * Get header include
 */
function get_header() {
	require_once( ABSPATH . 'includes/header.php' );
}

/**
 * Get footer include
 */
function get_footer() {
	require_once( ABSPATH . 'includes/footer.php' );
}

/**
 * Get current server time
 *
 * @return bool|string
 */
function get_current_time() {
	if ( defined( 'TIME_ZONE' ) ) {
		date_default_timezone_set( TIME_ZONE );
	}

	return date( 'm/d/Y h:i:s a', time() );
}

/**
 * Get data
 *
 * @param $name Name of data object from json
 *
 * @return mixed
 */
function get_data( $name ) {
	global $api_response;

	$record = json_decode( $api_response );

	return $record->data->$name;
}

/**
 * Get count from json
 *
 * @param $name Name of count object from json
 *
 * @return mixed
 */
function get_count( $name ) {
	global $api_response;

	$record = json_decode( $api_response );

	return $record->data->counts->$name;
}

/**
 * Write data to log file
 *
 * @param $file
 */
function write_data( $file ) {
	$data = array();

	// Add top descriptive row in csv on first call
	if ( ! file_exists( $file ) ) {
		array_push( $data,
			"Time",
			"Grams",
			"Followers",
			"Following"
		);
	} else {
		array_push( $data,
			get_current_time(),
			get_count( 'media' ),
			get_count( 'followed_by' ),
			get_count( 'follows' )
		);
	}

	$fh = fopen( $file, 'a' );
	fputcsv( $fh, $data );
	fclose( $fh );
}

/**
 * Load theme styles
 */
function load_theme_styles() {
	if ( ! defined( 'THEME' ) ) {
		echo '<link href="styles/themes/default.css" rel="stylesheet" type="text/css">';
	} else {
		echo '<link href="styles/themes/' . THEME . '.css" rel="stylesheet" type="text/css">';
	}
}

/**
 * Get the log file
 *
 * @return string
 */
function get_log_file() {
	$log_file        = 'logs/log.csv';
	$log_file_sample = 'logs/log-sample.csv';

	if ( ! file_exists( $log_file ) ) {
		return $log_file_sample;
	}

	return $log_file;
}

/**
 * Get the current pagename
 *
 * @return string
 */
function get_active_page() {
    // Dynamically set current page title as body class to target pages with CSS
    $basename = basename( $_SERVER['PHP_SELF'], ".php" );
    if ( $basename == 'index') {
        $basename = 'dashboard';
    }
    return $basename;
}
