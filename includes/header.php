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
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="icon" type="image/png" sizes="150x150" href="<?php echo get_data( 'profile_picture' ); ?>">
     <link rel="apple-touch-icon" sizes="150x150" href="<?php echo get_data( 'profile_picture' ); ?>">

     <?php load_theme_styles(); ?>

     <script type="text/javascript" src="js/jquery.min.js"></script>

</head>
<body class="<?php echo get_active_page(); ?>">

    <nav class="navbar">

        <div class="account-meta">
            <img src="<?php echo get_data( 'profile_picture' ); ?>" alt="<?php echo get_data( 'username' ); ?>">
            <a href="https://www.instagram.com/<?php echo get_data( 'username' ); ?>/" target="_blank"><?php echo get_data( 'full_name' ); ?></a>
            <summary><span><?php echo get_count( 'media' ); ?></span> posts <span><?php echo get_count( 'followed_by' ); ?></span> followers <span><?php echo get_count( 'follows' ); ?></span> following</summary>
        </div>

        <ul class="nav">
            <li class="<?= (get_active_page() == 'dashboard') ? 'active':''; ?>"><a href="/">Dashboard</a></li>
        </ul>

    </nav>

    <main class="content">
