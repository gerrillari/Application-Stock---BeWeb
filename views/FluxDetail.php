
<body class="h-screen overflow-hidden flex flex-col items-center justify-center">

    <div class="w-3/4 flex flex-col items-center justify-center h-screen select-none">
    

    <div class=" flex flex-col -mt-32 bg-white px-4 sm:px-6 md:px-8 lg:px-10 py-8 rounded-xl shadow-2xl w-full max-w-md  border-l-4">
        <div class="mt-10">

                <div class="relative w-full mb-3">
                    <p class="text-center p-2">Shipment Path</p>
                    <?= $origin ?>
                </div>          
                <div class="relative w-full mb-3">
                    <p class="p-2 text-red-500">Origin Storage : </p>
                    <?= $origin ?>
                </div>
                <div class="relative w-full mb-3">
                    <p class="p-2 text-red-500">Destination Storage : </p>
                    <?= $destination ?>
                </div>
                <div class="text-center mt-6">
                    
                </div>  
                    <div class="flex flex-wrap mt-6">
                </div>
            
        </div>
    </div>
</div>

<div>
    <h1 class="text-center"> Shipment Content </h1>
    <div class="md:px-32 py-8 w-full">
  <div class="shadow overflow-hidden rounded border-b border-gray-200">
    <table class="min-w-full bg-white">
      <thead class="bg-gray-800 text-white">
        <tr>
          <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Product Name</th>
          <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Unit Weight</th>
          <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Unit Size</th>
          <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Total Weight</td>
          <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Total Size</td>
          <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Quantity</td>
        </tr>
      </thead>
    <tbody class="text-gray-700">
    <?php foreach($products as $product): ?>
      <tr>
        <td class="w-1/3 text-left py-3 px-4">Lian</td>
        <td class="w-1/3 text-left py-3 px-4">Smith</td>
        <td class="text-left py-3 px-4"><a class="hover:text-blue-500" href="tel:622322662">622322662</a></td>
        <td class="text-left py-3 px-4"><a class="hover:text-blue-500" href="mailto:jonsmith@mail.com">jonsmith@mail.com</a></td>
        <td class="w-1/3 text-left py-3 px-4">Lian</td>
        <td class="w-1/3 text-left py-3 px-4">Smith</td>
      </tr>
    <?php endforeach ?>
    </tbody>
    </table>
  </div>
</div>


</div>

</body>
</html>
