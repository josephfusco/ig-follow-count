<?php

// Exit if accessed directly.
if( count( get_included_files() ) == 1 ) exit( "Direct access not permitted." );

define( 'ABSPATH', dirname(__FILE__) . '/' );

if ( file_exists( ABSPATH . 'config.php' ) ) {
	require_once( ABSPATH . 'config.php' );
} else {
    exit( "Configuration file not found." );
}

if( !defined( 'IG_USER_ID' ) ) {
    exit('IG_USER_ID not defined.');
}

if( !defined( 'IG_ACCESS_TOKEN' ) ) {
    exit('IG_ACCESS_TOKEN not defined.');
}

if( IG_USER_ID == '' || IG_ACCESS_TOKEN == '' ){
    exit('Instagram authenticaion not set in configuration.');
}

require_once( ABSPATH . 'includes/functions.php');
