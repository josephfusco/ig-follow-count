<?php

require_once( 'startup.php' );

get_header();

?>

<div id="plotlyA">
    <!-- plotly chart renders here -->
</div>

<script type="text/javascript" src="https://cdn.plot.ly/plotly-latest.min.js"></script>
<script>

    function makeplotA() {
        Plotly.d3.csv("<?php echo get_log_file(); ?>", function (data) {
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
