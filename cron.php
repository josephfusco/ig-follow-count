<?php
/**
 *
 * This file performs the cron job
 *
 */
define( 'ABSPATH', dirname(__FILE__) . '/' );

require_once( ABSPATH . 'setup.php' );

write_data( 'logs/log.csv' );
