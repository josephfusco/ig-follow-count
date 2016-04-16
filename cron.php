<?php

define( 'ABSPATH', dirname(__FILE__) . '/' );

require_once( ABSPATH . 'startup.php' );

write_data( 'logs/log.csv' );
