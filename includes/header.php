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
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
     <?php load_theme_styles(); ?>

     <script type="text/javascript" src="js/jquery.min.js"></script>

</head>
<body>

    <nav class="navbar">
        <div class="account">
            <a href="/recent.php">Recent</a>
        <?php if( defined( 'IG_HASGTAG' ) ){ ?>
            <a href="https://www.instagram.com/explore/tags/<?php echo IG_HASGTAG; ?>/" target="_blank">#<?php echo IG_HASGTAG; ?></a>
        <?php } ?>
            <a href="https://www.instagram.com/<?php echo get_data( 'username' ); ?>/" target="_blank">@<?php echo get_data( 'username' ); ?></a>
        </div>

        <a class="btn" href="<?php echo get_log_file(); ?>" download>Download CSV</a>
    </nav>
