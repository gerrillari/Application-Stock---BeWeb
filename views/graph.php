<?php
require 'vendor/autoload.php';
use ChartJs\ChartJS;

$data = [
    'labels' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
    'datasets' => [[
        'data' =>[8, 7, 8, 9, 6],
        'backgroundColor' => '#f2b21a',
        'borderColor' => '#e5801d',
        'label' => 'Legend'
    ]]
];
$options = ['responsive' => true];
$Line = new ChartJS('line', $data, $options);
?>

    <div class="overwrite">
        <?php
        echo $Line;
        ?>
    </div>
    <script src="vendor/ejdamm/chart.js-php/js/Chart.min.js"></script>
    <script src="vendor/ejdamm/chart.js-php/js/driver.js"></script>
    <script>
        window.onload = ((function() {
            loadChartJsPhp();
        })());
    </script>


