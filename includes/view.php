<?php

if( count( get_included_files() ) == 1 ) exit( "Direct access not permitted." );

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>IG Follow Count</title>
    <meta name="robots" content="noarchive">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php load_theme_styles(); ?>
</head>
<body>

    <div id="plotlyA">
        <!-- plotly chart renders here -->
    </div>

    <footer>
        <div class="account">
        <?php if( defined( 'IG_HASGTAG' ) ){ ?>
            <a href="https://www.instagram.com/explore/tags/<?php echo IG_HASGTAG; ?>/" target="_blank">#<?php echo IG_HASGTAG; ?></a>
        <?php } ?>
            <a href="https://www.instagram.com/<?php echo get_data( 'username' ); ?>/" target="_blank">@<?php echo get_data( 'username' ); ?></a>
        </div>
        <a class="btn" href="logs/log.csv" download>Download CSV</a>
    </footer>

    <?php get_plotly(); ?>

</body>
</html>
