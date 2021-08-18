<?php

$offset = isset($_GET["offset"]) ? $_GET["offset"] : 0;

$maxPage = ceil(($totalToLoad/50));

$currentPage = ($offset+50)/50;

$currentURL =  "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

$modularURL = explode($offset,$currentURL)[0];

if(!strpos($modularURL, "?&offset=")){
  $modularURL.="?&offset=";
}


?>

<!-- This example requires Tailwind CSS v2.0+ -->
<div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
  <div class="flex-1 flex justify-between sm:hidden">
    <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
      Précédent
    </a>
    <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
      Suivant
    </a>
  </div>
  <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
    <div>
      <p class="text-sm text-gray-700">
        Montrant les résultats
        <span class="font-medium"><?= $offset+1 ?></span>
        à
        <? if($currentPage != $maxPage): ?>
        <span class="font-medium"><?= $offset+50 ?></span>
        <? endif ?>
        <? if($currentPage == $maxPage): ?>
        <span class="font-medium"><?= $totalToLoad ?></span>
        <? endif ?>
        sur
        <span class="font-medium"><?= $totalToLoad ?></span>
      </p>
    </div>
    <div>
      <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">


      <? if($currentPage > 1): ?>
        <a href="http://<?= $modularURL?><?=$offset-50 ?>" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
          <span class="sr-only">Previous</span>
          <!-- Heroicon name: solid/chevron-left -->
          <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
          </svg>
        </a>
      <? endif ?>
        <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->

        <? if($currentPage > 1): ?>
        <a href="http://<?= $modularURL."0" ?>" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
          1
        </a>
        <? endif ?>

        <? if($currentPage == 1): ?>
        <a class="z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
          1
        </a>
        <? endif ?>
        
        <? if ($currentPage > 2): ?>
          <? if($currentPage > 3 && $maxPage - 3 != 1): ?>
            <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
              ...
            </span>
          <? endif ?>
            <? if($currentPage == $maxPage && $maxPage > 3): ?>
              <a href="http://<?= $modularURL?><?=$offset-100 ?>" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                <?= $currentPage - 2 ?>
              </a>
            <? endif ?>
          <a href="http://<?= $modularURL?><?=$offset-50 ?>" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
            <?= $currentPage - 1 ?>
          </a>
        <? endif ?>
        
        <? if($currentPage != 1 && $currentPage != $maxPage): ?>
          <a class="z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
            <?= $currentPage ?>
          </a>
        <? endif ?>

        <? if($currentPage < $maxPage-1): ?>
          <a href="http://<?= $modularURL?><?=$offset+50 ?>" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
            <?= $currentPage + 1 ?>
          </a>
          <? if($currentPage < $maxPage - 2): ?>
            <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700">
              ...
            </span>
          <? endif ?>
        <? endif ?>

        <? if($currentPage < $maxPage): ?>
        <a href="http://<?= $modularURL?><?=($maxPage-1)*50?>" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
          <?= $maxPage ?>
        </a>
        <? endif ?>

        <? if($currentPage == $maxPage): ?>
        <a class="z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
          <?= $maxPage ?>
        </a>
        <? endif ?>

        <? if($currentPage != $maxPage): ?>
        <a href="http://<?= $modularURL?><?=$offset+50 ?>" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
          <span class="sr-only">Next</span>
          <!-- Heroicon name: solid/chevron-right -->
          <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
          </svg>
        </a>
      <? endif ?>
      </nav>
    </div>
  </div>
</div>