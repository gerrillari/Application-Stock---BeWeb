<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="../vendor/ejdamm/chart.js-php/js/Chart.min.js"></script>
<script src="../vendor/ejdamm/chart.js-php/js/driver.js"></script>

<?
use BWB\Framework\mvc\dao\DAOProduct;
/**
 * Require ChartJs
 */
require 'vendor/autoload.php';
use ChartJs\ChartJS;

#données du graph
$data = [
    'labels' => [],
    'datasets' => [[
        'data' =>[],
        'label' => 'Stock',
        'borderColor' => 'rgb(0,191,255)',
        'backgroundColor' => 'rgb(0,191,255)',
        'fill' => 'none'
    ]]
];


#stock actuel du produit courrant

/**
 * Remplissage des avec le flux correspondant a la date donnée
 */
foreach(array_reverse($psd) as $date => $value){
    array_push($data['labels'], $date);
}

foreach($psd as $date => $value){
    array_push($data['datasets'][0]['data'], $value);
}

$stock_current_product = $data['datasets'][0]['data'][4];

#Création du chart
$options = ['responsive' => true];
$Line = new ChartJS('line', $data, $options);
?>



<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <!-- nav -->
        </div>

        <div class="col-lg-6">
            <?= $Line ?>
        </div>
        <div class="col-lg-3 form" id="form">
            <h3>Set Products Threshold</h3>
            <form method="post">
                <label>Current stock</label><br>
                <input type="text" value="<?= $stock_current_product ?>" disabled="disabled"><br><br>

                <label>Set threshold</label><br>
                <input type="text" name="threshold" ><br><br>

                <input class="btn btn-primary" type="submit" value="Update">
            </form> 
        </div>
    </div>
</div>
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <!-- nav -->
            </div>
            <div class="col-lg-9">
            <div class="main-box clearfix">
                <div class="table-responsive">
                    <table class="table user-list">
                        <thead>
                            <tr>
                                <th><span>Infos</span></th>
                                <th><span>Quantity</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <? foreach ($storages as $store): ?>
                            <tr>
                                <td>
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                                    <a href="#" class="user-link"><?= $store['name'] ?></a>
                                    <span class="user-subhead"><?= "City: ".$store['city']." ZipCode: ".$store['zipcode']." Street: ".$store['street']." Number: ".$store['number'] ?></span>
                                </td>
                                <td class="text-center">
                                    <span class="label label-default"><?= $store['quantity'] ?></span>
                                </td>
                            </tr>
                            <? endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->

<script>
    window.onload = ((function() {
        loadChartJsPhp();
    })());
</script>

<style>
    /* overwrite canvas size */
    .form {
        background-color: #E4E3DF;
        border-radius: 6px;
        text-align: center;
        /* align-items: center; */
    }
    h3 {
        padding-top: 10px
    }
    
    body{margin-top:20px;}

    /* USER LIST TABLE */
    .user-list tbody td > img {
        position: relative;
        max-width: 50px;
        float: left;
        margin-right: 15px;
    }
    .user-list tbody td .user-link {
        display: block;
        font-size: 1.25em;
        padding-top: 3px;
        margin-left: 60px;
    }
    .user-list tbody td .user-subhead {
        font-size: 0.875em;
        font-style: italic;
    }

    /* TABLES */
    .table {
        border-collapse: separate;
    }
    .table-hover > tbody > tr:hover > td,
    .table-hover > tbody > tr:hover > th {
        background-color: #eee;
    }
    .table thead > tr > th {
        border-bottom: 1px solid #C2C2C2;
        padding-bottom: 0;
    }
    .table tbody > tr > td {
        font-size: 0.875em;
        background: #f5f5f5;
        border-top: 10px solid #fff;
        vertical-align: middle;
        padding: 12px 8px;
    }
    .table tbody > tr > td:first-child,
    .table thead > tr > th:first-child {
        padding-left: 20px;
    }
    .table thead > tr > th span {
        border-bottom: 2px solid #C2C2C2;
        display: inline-block;
        padding: 0 5px;
        padding-bottom: 5px;
        font-weight: normal;
    }
    .table thead > tr > th > a span {
        color: #344644;
    }
    .table thead > tr > th > a span:after {
        content: "\f0dc";
        font-family: FontAwesome;
        font-style: normal;
        font-weight: normal;
        text-decoration: inherit;
        margin-left: 5px;
        font-size: 0.75em;
    }
    .table thead > tr > th > a.asc span:after {
        content: "\f0dd";
    }
    .table thead > tr > th > a.desc span:after {
        content: "\f0de";
    }
    .table thead > tr > th > a:hover span {
        text-decoration: none;
        color: #2bb6a3;
        border-color: #2bb6a3;
    }
    .table.table-hover tbody > tr > td {
        -webkit-transition: background-color 0.15s ease-in-out 0s;
        transition: background-color 0.15s ease-in-out 0s;
    }
    .table tbody tr td .call-type {
        display: block;
        font-size: 0.75em;
        text-align: center;
    }
    .table tbody tr td .first-line {
        line-height: 1.5;
        font-weight: 400;
        font-size: 1.125em;
    }
    .table tbody tr td .first-line span {
        font-size: 0.875em;
        color: #969696;
        font-weight: 300;
    }
    .table tbody tr td .second-line {
        font-size: 0.875em;
        line-height: 1.2;
    }
    .table a.table-link {
        margin: 0 5px;
        font-size: 1.125em;
    }
    .table a.table-link:hover {
        text-decoration: none;
        color: #2aa493;
    }
    .table a.table-link.danger {
        color: #fe635f;
    }
    .table a.table-link.danger:hover {
        color: #dd504c;
    }

    .table-products tbody > tr > td {
        background: none;
        border: none;
        border-bottom: 1px solid #ebebeb;
        -webkit-transition: background-color 0.15s ease-in-out 0s;
        transition: background-color 0.15s ease-in-out 0s;
        position: relative;
    }
    .table-products tbody > tr:hover > td {
        text-decoration: none;
        background-color: #f6f6f6;
    }
    .table-products .name {
        display: block;
        font-weight: 600;
        padding-bottom: 7px;
    }
    .table-products .price {
        display: block;
        text-decoration: none;
        width: 50%;
        float: left;
        font-size: 0.875em;
    }
    .table-products .price > i {
        color: #8dc859;
    }
    .table-products .warranty {
        display: block;
        text-decoration: none;
        width: 50%;
        float: left;
        font-size: 0.875em;
    }
    .table-products .warranty > i {
        color: #f1c40f;
    }
    .table tbody > tr.table-line-fb > td {
        background-color: #9daccb;
        color: #262525;
    }
    .table tbody > tr.table-line-twitter > td {
        background-color: #9fccff;
        color: #262525;
    }
    .table tbody > tr.table-line-plus > td {
        background-color: #eea59c;
        color: #262525;
    }
    .table-stats .status-social-icon {
        font-size: 1.9em;
        vertical-align: bottom;
    }
    .table-stats .table-line-fb .status-social-icon {
        color: #556484;
    }
    .table-stats .table-line-twitter .status-social-icon {
        color: #5885b8;
    }
    .table-stats .table-line-plus .status-social-icon {
        color: #a75d54;
    }
</style>
