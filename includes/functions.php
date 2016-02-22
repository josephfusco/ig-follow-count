<?php

if( count( get_included_files() ) == 1 ) exit( "Direct access not permitted." );

$api_url = "https://api.instagram.com/v1/users/". IG_USER_ID . "/?access_token=" . IG_ACCESS_TOKEN;
$api_response = file_get_contents( $api_url );

function get_current_time() {
    if( defined( 'TIME_ZONE' ){
        date_default_timezone_set( TIME_ZONE );
    }
    return date( 'm/d/Y h:i:s a', time() );
}

function get_data( $name ) {
    global $api_response;
    $record = json_decode( $api_response );
    return $record->data->$name;
}

function get_count( $name ) {
    global $api_response;
    $record = json_decode( $api_response );
    return $record->data->counts->$name;
}

function write_data( $file ) {
    $data = array();
    // Add top descriptive row in csv on first call
    if( !file_exists( $file ) ) {
        array_push( $data,
            "Time",
            "Grams",
            "Followers",
            "Following"
        );
    } else {
        array_push( $data,
            get_current_time(),
            get_count( 'media' ),
            get_count( 'followed_by' ),
            get_count( 'follows' )
        );
    }
    $fh = fopen( $file, 'a' );
    fputcsv( $fh, $data );
    fclose( $fh );
}

function get_plotly() {
    // Show sample csv if nothing has been logged yet
    $log_file = 'logs/log.csv';
    $log_sample_file = 'logs/log-sample.csv';
    if( file_exists( $log_file ) ) {
        $file = $log_file;
    } else {
        $file = $log_sample_file;
    }
    ?>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script>

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
<?php
}
