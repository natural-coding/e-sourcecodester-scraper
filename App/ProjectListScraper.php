<?php

namespace App;

use App\Constants;

class ProjectListScraper
{
   private string $data;

   public function __construct()
   {
      $this->data = file_get_contents(Constants::PROJECT_LIST_DATA_PATH . 'ProjectListData.txt');
   }

   public function GetProjectListArray() : array
   {
      return explode(PHP_EOL,$this->data);
   }
}