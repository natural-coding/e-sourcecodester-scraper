<?php

namespace App;

use Constants;
use Interfaces\GetProjectListInterface;
use ProjectListPageParser;

class ProjectListScraper implements GetProjectListInterface;
{
   // ? Whether 
   private $projectListPageParser;
/*
   public function __construct(GetProjectListInterface )
   {
      $data = file_get_contents(Constants::PROJECT_LIST_DATA_DEBUG_PATH . 'ProjectListData.txt');
      $this->projectListJsonArray = self::ExtratStringIntoJsonArray($data);
   }
*/
   public function GetProjectListJsonArray() : array
   {
      return $this->projectListJsonArray;
   }
}