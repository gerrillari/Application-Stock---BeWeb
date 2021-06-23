
<body class="overflow-scroll flex flex-col items-center justify-evenly" style="background: #DEFBFA;">


<?php foreach($data as $del): ?>
<?php if(!empty($del)): ?>


<div class="flex m-8">
<div class="w-96 h-72 mx-auto sm:px-6 lg:px-8">
    <div class="overflow-hidden shadow-md">
        <!-- card header -->
        <div class="px-6 py-4 bg-white border-b border-gray-200 font-bold uppercase">
            <?= $del[0]["name"] ?>
        </div>

        <!-- card body -->
        <div class="p-6 bg-white border-b border-gray-200">
            <!-- content goes here -->
            <?= "{$del[0]["number"]} Rue {$del[0]["street"]} {$del[0]["zipcode"]} {$del[0]["city"]}"?>
        </div>

        <!-- card footer -->
        <div class="p-6 bg-white border-gray-200 text-right flex justify-around">
            <!-- button link -->
            <a class="bg-blue-500 shadow-md text-sm text-white font-bold py-3 md:px-8 px-4 hover:bg-blue-400 rounded uppercase" 
                href="http://<?="{$_SERVER['HTTP_HOST']}/storage/{$del[0]['origin']}"?>">Storage Info</a>
        </div>
    </div>
</div>


<div class="flex flex-col justify-around items-center">
<!-- High speed fast shipment -->
<img src="assets/svg/truck.svg" width="100px" height="100px">

<?php 

    $maxWeight = $del[0]["weightlimit"];

    $totalWeight = 0;

    for ($i=0; $i < count($del)/2; $i++) { 

        $totalWeight += ($del[$i]["weight"] * $del[$i]["quantity"]);
    }

    $weightPercent = round(($maxWeight/$totalWeight)*100);

?>

<div class="relative pt-1">
  <div class="flex mb-2 items-center justify-between">
    <div>
      <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-red-600 bg-red-200">
        Weight Capacity
      </span>
    </div>
    <div class="text-right">
      <span class="text-xs font-semibold inline-block text-red-600">
        <?= $weightPercent ?>%
      </span>
    </div>
  </div>
  <div class="overflow-hidden h-2 mb-4 text-xs flex rounded bg-red-200">
    <div style="width:<?=$weightPercent?>%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-red-500"></div>
  </div>
</div>

<img src="assets/svg/arrow-left.svg" width="100px" height="100px">
<a class="bg-blue-500 shadow-md text-sm text-white font-bold py-3 md:px-8 px-4 hover:bg-blue-400 rounded uppercase" 
                href="http://<?="{$_SERVER['HTTP_HOST']}/storage/{$del[0]['id']}"?>"">Shipment Info</a>
</div>

<div class="w-96 h-72 mx-auto sm:px-6 lg:px-8">
    <div class="overflow-hidden shadow-md">
        <!-- card header -->
        <div class="px-6 py-4 bg-white border-b border-gray-200 font-bold uppercase">
            <?= end($del)["name"] ?>
        </div>

        <!-- card body -->
        <div class="p-6 bg-white border-b border-gray-200">
            <!-- content goes here -->
            <?= end($del)['number']." Rue ".end($del)['street']." ".end($del)['zipcode']." ". end($del)['city']?>
        </div>

        <!-- card footer -->
        <div class="p-6 bg-white border-gray-200 text-right  flex justify-around">
            <!-- button link -->
            <a class="bg-blue-500 shadow-md text-sm text-white font-bold py-3 md:px-8 px-4 hover:bg-blue-400 rounded uppercase" 
                href="http://<?="{$_SERVER['HTTP_HOST']}/storage/{$del[0]['destination']}"?>">Storage Info</a>
        </div>
    </div>
</div>

</div>
<? endif ?>
<?php endforeach ?>

</body>
</html>
