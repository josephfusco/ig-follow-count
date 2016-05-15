<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit ( "Direct access not permitted." );

?>
<html>
<head>

     <meta charset="utf-8">
     <title>IG Follow Count</title>
     <meta name="robots" content="noarchive">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
     <link rel="icon" type="image/png" sizes="150x150" href="<?php echo get_data( 'profile_picture' ); ?>">
     <link rel="apple-touch-icon" sizes="150x150" href="<?php echo get_data( 'profile_picture' ); ?>">

     <?php load_theme_styles(); ?>

     <script type="text/javascript" src="js/jquery.min.js"></script>

</head>
<body>

    <nav class="navbar">

        <a href="/" class="logo">
            <img src="<?php echo get_data( 'profile_picture' ); ?>" alt="<?php echo get_data( 'username' ); ?>">
        </a>

        <button type="button" class="btn-toggle-menu">☰</button>

        <div id="fullscreen-menu">
            <div class="account">
                <a href="/recent.php">Recent</a>
            <?php if( defined( 'IG_HASGTAG' ) ){ ?>
                <a href="https://www.instagram.com/explore/tags/<?php echo IG_HASGTAG; ?>/" target="_blank">#<?php echo IG_HASGTAG; ?></a>
            <?php } ?>
                <a href="https://www.instagram.com/<?php echo get_data( 'username' ); ?>/" target="_blank">@<?php echo get_data( 'username' ); ?></a>
            </div>

            <a class="btn" href="<?php echo get_log_file(); ?>" download>Download CSV</a>
        </div>

    </nav>

    <main class="content">
