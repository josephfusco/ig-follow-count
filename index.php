<?php

define( 'ABSPATH', dirname(__FILE__) . '/' );

require_once( ABSPATH . 'setup.php' );

get_header();

?>

<div id="plotlyA">
    <!-- plotly chart renders here -->
</div>

<footer>
    <div class="account">
        <a href="/recent.php">Recent</a>
    <?php if( defined( 'IG_HASGTAG' ) ){ ?>
        <a href="https://www.instagram.com/explore/tags/<?php echo IG_HASGTAG; ?>/" target="_blank">#<?php echo IG_HASGTAG; ?></a>
    <?php } ?>
        <a href="https://www.instagram.com/<?php echo get_data( 'username' ); ?>/" target="_blank">@<?php echo get_data( 'username' ); ?></a>
    </div>
    <a class="btn" href="logs/log.csv" download>Download CSV</a>
</footer>

<?php get_plotly(); ?>

<?php get_footer(); ?>
