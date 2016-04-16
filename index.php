<?php

define( 'ABSPATH', dirname(__FILE__) . '/' );

require_once( ABSPATH . 'setup.php' );

get_header();

?>

<div id="plotlyA">
    <!-- plotly chart renders here -->
</div>

<script type="text/javascript" src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<script>
    <?php

        $log_file = 'logs/log.csv';
        $log_sample_file = 'logs/log-sample.csv';
        if( file_exists( $log_file ) ) {
            $file = $log_file;
        } else {
            $file = $log_sample_file;
        }

    ?>
    function makeplotA() {
        Plotly.d3.csv("<?php echo $file; ?>", function (data) {
            processData(data)
        });
    };

    function processData(allRows) {

        var x = [],
            y = [],
            standard_deviation = [];

        for (var i = 0; i < allRows.length; i++) {
            row = allRows[i];
            x.push(row['Time']);
            y.push(row['Followers']);
        }
        makePlotly(x, y, standard_deviation);
    }

    function makePlotly(x, y, standard_deviation) {
        var plotDiv = document.getElementById("plot");
        var traces = [{
            x: x,
            y: y
        }];

        Plotly.newPlot('plotlyA', traces, {
            title: 'IG Follow Count'
        });
    };

    makeplotA();

</script>

<?php get_footer(); ?>
