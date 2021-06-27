<nav
  class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6"
>
  <div
    class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto"
  >
 
    <!-- Brand -->
    <p
      class="md:block text-left md:pb-2 text-blueGray-600 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0"
      
    >
      Usine Ricard
    </p>
    
    <div
      class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded"
      [ngClass]="collapseShow"
    >
      
     
      <!-- Navigation -->
      <ul class="md:flex-col md:min-w-full flex flex-col list-none">
        <li class="items-center">
          <a
            class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
            href="http://<?=$_SERVER["HTTP_HOST"]?>"
            ><i class="fas fa-tv opacity-75 mr-2 text-sm"></i>
            Dashboard</a
          >
        </li>
        <li class="items-center">
          <a
            class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
            href="http://<?=$_SERVER["HTTP_HOST"]?>/storages"
            ><i class="fas fa-newspaper text-blueGray-400 mr-2 text-sm"></i>
            Storages</a
          >
        </li>
        <li class="items-center">
          <a
            class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
            href="http://<?=$_SERVER["HTTP_HOST"]?>/products"
            ><i class="fas fa-user-circle text-blueGray-400 mr-2 text-sm"></i>
            Products</a
          >
        </li>
        <li class="items-center">
          <a
            class="text-blueGray-700 hover:text-blueGray-500 text-xs uppercase py-3 font-bold block"
            href="http://<?=$_SERVER["HTTP_HOST"]?>/flux"
            ><i class="fas fa-fingerprint text-blueGray-400 mr-2 text-sm"></i>
            Shipments</a
          >
        </li>
        <li class="items-center">
          <a
            class="text-blueGray-300 text-xs uppercase py-3 font-bold block"
            href="http://<?=$_SERVER["HTTP_HOST"]?>/logout"
            ><i class="fas fa-tools text-blueGray-300 mr-2 text-sm"></i>
            Logout</a
          >
        </li>
      </ul>
      <!-- Divider -->
      <hr class="my-4 md:min-w-full" />
      <!-- Heading -->
      <h6
        class="md:min-w-full text-blueGray-500 text-xs uppercase font-bold block pt-1 pb-4 no-underline"
      >
        Documentation
      </h6>
      <!-- Navigation -->
      <ul
        class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4"
      >
        <li class="inline-flex">
          <a
            class="text-blueGray-700 hover:text-blueGray-500 text-sm block mb-4 no-underline font-semibold"
            href="https://gitlab.com/dwwm_mtp_03/internal-projects/application-stock/-/wikis/home"
            ><i
              class="mr-2 text-blueGray-400 text-base"
            ></i>
            Wiki</a
          >
        </li>
        
        
        
      </ul>
    </div>
  </div>
</nav>