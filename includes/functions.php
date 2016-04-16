<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit ( "Direct access not permitted." );

$api_url = "https://api.instagram.com/v1/users/". IG_USER_ID . "/?access_token=" . IG_ACCESS_TOKEN;
$api_response = file_get_contents( $api_url );

function get_header() {
    require_once( ABSPATH . 'includes/header.php' );
}

function get_footer() {
    require_once( ABSPATH . 'includes/footer.php' );
}

function get_current_time() {
    if( defined( 'TIME_ZONE' ) ) {
        date_default_timezone_set( TIME_ZONE );
    }
    return date( 'm/d/Y h:i:s a', time() );
}

function get_data( $name ) {
    global $api_response;
    $record = json_decode( $api_response );
    return $record->data->$name;
}

function get_count( $name ) {
    global $api_response;
    $record = json_decode( $api_response );
    return $record->data->counts->$name;
}

function write_data( $file ) {
    $data = array();
    // Add top descriptive row in csv on first call
    if( !file_exists( $file ) ) {
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

function load_theme_styles() {
    if ( !defined( 'THEME' ) ){
        echo '<link href="css/themes/default.css" rel="stylesheet" type="text/css">';
    } else {
        echo '<link href="css/themes/' . THEME . '.css" rel="stylesheet" type="text/css">';
    }
}
