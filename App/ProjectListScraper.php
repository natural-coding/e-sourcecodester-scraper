<?php

namespace App;

use App\Constants;

class ProjectListScraper
{
   private string $data;

   public function __construct()
   {
      //$data = file_get_contents(dirname(__FILE__) . DIREC)
      print Constants::ROOT_DIR;
      die;

   }

   public function GetProjectListArray() : array
   {
      return [
         1,
         2,
         3
      ];
   }
}