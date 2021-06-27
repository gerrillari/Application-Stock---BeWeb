<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!--MAP HEAD -->
<link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css" type="text/css">

<!--GRAPHE SCRIPT DEBUT-->
<script src="../vendor/ejdamm/chart.js-php/js/Chart.min.js"></script>
<script src="../vendor/ejdamm/chart.js-php/js/driver.js"></script>
<?
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

/**
 * Remplissage des avec le flux correspondant a la date donnée
 */
foreach(array_reverse($psd) as $date => $value){
    array_push($data['labels'], $date);
    array_push($data['datasets'][0]['data'], $value);
}

#Création du chart
$options = ['responsive' => true];
$Line = new ChartJS('line', $data, $options);
?>
<!--AFFICHAGE NAVBAR + GRAPHE + MAP  -->
<div class="container">
 <div class="row">
    <div class="col-lg-3">
      <!--SI PAS BESOIN DE ESPACE EXTRA POUR LA NAVBAR, ENLEVER CETTE DIV ET MODIF LES AUTRES 2 "col-lg-5" et "col-lg-4" 
	  avec un autre nb si nécessaire pour bien afficher la carte et le graphe dans la view-->
    </div>
    <div id="map" style="width: 400px; height: 200px;" class="col-lg-5">
    </div>
    <div class="col-lg-4">
      	<div class="overwrite">
    		<?= $Line ?>
		</div>
    </div>
  </div>
</div>
<!--GRAPHE SCRIPT FIN BODY-->
<script>
    window.onload = ((function() {
        loadChartJsPhp();
    })());
</script>

<!--MAP SCRIPT FIN BODY-->
<script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
<script>
var attribution = new ol.control.Attribution({
     collapsible: false
 });



//Génération coordonnées aléatoires
var randlong = Math.random() * (4.35247 - 4.25478)  + 4.25478;
var randlat = Math.random() * (50.84673 - 50.55486)  + 50.55486;

//Génération map
 var map = new ol.Map({
     controls: ol.control.defaults({attribution: false}).extend([attribution]),
     layers: [
         new ol.layer.Tile({
             source: new ol.source.OSM({
                 url: 'https://tile.openstreetmap.be/osmbe/{z}/{x}/{y}.png',
                 attributions: [ ol.source.OSM.ATTRIBUTION, 'Tiles courtesy of <a href="https://geo6.be/">GEO-6</a>' ],
                 maxZoom: 18
             })
         })
     ],
     target: 'map',
     view: new ol.View({
         center: ol.proj.fromLonLat([randlong, randlat]),
         maxZoom: 18,
         zoom: 12
     })
 });
</script>



<!--TABLEAU COMPOSER -->
<div class="container">
<div class="row">
	<div class="col-lg-3">
	</div>
	<div class="col-lg-9">
		<div class="main-box clearfix">
			<div class="table-responsive">
				<table class="table user-list">
				<? foreach ($products as $index=>$product):?>
					<thead>
                        <tr>
                        <th class="text-center"><span>Products information</span></th>
                        <th class="text-center"><span>Quantity</span></th>
                        <th class="text-center"><span>Capacity</span></th>
						<th class="text-center"><span>Stock</span></th>
                        </tr>
                    </thead>
					<tbody>
						<tr>
							<td>
                				<a style="text-decoration:none; color:#0880bd"><?=$product["name"]?></a>
								</br>
                				<p><?=$product["description"]?></p>
							</td>
							<td class="text-center">
								<?=$product["quantity"]?> 
							</td>
							<td class="text-center">
								<?=$product["capacity"]?> m3
							</td>
							<td>
								<div class="progress progress-xs">
									<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=round((($bars[$index]["delivery"]*$bars[$index]["sizeproduct"])/$bars[$index]["sizestorage"])*100,2)?>%">
										<span class=""><?=round((($bars[$index]["delivery"]*$bars[$index]["sizeproduct"])/$bars[$index]["sizestorage"])*100,2)?>%</span>
									</div>
									<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: <?=round((($bars[$index]["stock"]*$bars[$index]["sizeproduct"])/$bars[$index]["sizestorage"])*100,2)?>%">
										<span class=""><?=round((($bars[$index]["stock"]*$bars[$index]["sizeproduct"])/$bars[$index]["sizestorage"])*100,2)?>%</span>
									</div>
									<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: <?=round((($bars[$index]["command"]*$bars[$index]["sizeproduct"])/$bars[$index]["sizestorage"])*100,2)?>%">
										<span class=""><?=round((($bars[$index]["command"]*$bars[$index]["sizeproduct"])/$bars[$index]["sizestorage"])*100,2)?>%</span>
									</div>
								</div>
							</td>
						</tr>
					<? endforeach ?>	
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>

<!--CSS-->
<style>
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

/*PERCETANGE BAR*/

.progress-bar {
  box-shadow: none;
  line-height: 15px;
  text-align: right;
  padding-right: 10px;
  font-size: 11px;
}

</style>