
<body class="overflow-scroll flex flex-col items-center justify-evenly" style="background: #DEFBFA;">


<?php for($i=0; $i < 10; $i++): ?>

<div class="flex mt-8">
<div class="w-96 h-72 mx-auto sm:px-6 lg:px-8">
    <div class="overflow-hidden shadow-md">
        <!-- card header -->
        <div class="px-6 py-4 bg-white border-b border-gray-200 font-bold uppercase">
            <?= $i ?>
        </div>

        <!-- card body -->
        <div class="p-6 bg-white border-b border-gray-200">
            <!-- content goes here -->
            69 Rue du Zgeg
            69000
            Montcul
        </div>

        <!-- card footer -->
        <div class="p-6 bg-white border-gray-200 text-right flex justify-around">
            <!-- button link -->
            <a class="bg-blue-500 shadow-md text-sm text-white font-bold py-3 md:px-8 px-4 hover:bg-blue-400 rounded uppercase" 
                href="#">Click Me</a>
        </div>
    </div>
</div>


<div class="flex flex-col justify-around">
<!-- High speed fast shipment -->
<img src="assets/svg/truck.svg" width="100px" height="100px">
<img src="assets/svg/arrow-left.svg" width="100px" height="100px">
</div>

<div class="w-96 h-72 mx-auto sm:px-6 lg:px-8">
    <div class="overflow-hidden shadow-md">
        <!-- card header -->
        <div class="px-6 py-4 bg-white border-b border-gray-200 font-bold uppercase">
            Destination storage
        </div>

        <!-- card body -->
        <div class="p-6 bg-white border-b border-gray-200">
            <!-- content goes here -->
            420 Rue du trou
            42200 La Fistinière
        </div>

        <!-- card footer -->
        <div class="p-6 bg-white border-gray-200 text-right  flex justify-around">
            <!-- button link -->
            <a class="bg-blue-500 shadow-md text-sm text-white font-bold py-3 md:px-8 px-4 hover:bg-blue-400 rounded uppercase" 
                href="#">Click Me</a>
        </div>
    </div>
</div>

</div>

<?php endfor ?>

</body>
</html>
