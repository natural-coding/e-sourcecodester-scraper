<?php

namespace App;

use Constants;
use Interfaces\GetProjectListInterface;

class ProjectListScraper implements GetProjectListInterface;
{
   private array $projectListJsonArray;

   static private function ExtratStringIntoJsonArray(string $p_projectListData) : array
   {
      $outJsonArray = [];

      $linesArray = explode(PHP_EOL,$p_projectListData);

      foreach($linesArray as $line)
      {
         $projectData = new \stdClass();

         $easyCsvArray = explode(',',$line);

         $projectData->id = trim($easyCsvArray[0]);
         $projectData->title = trim($easyCsvArray[1]);

         array_push($outJsonArray,$projectData);
      }

      return $outJsonArray;
   }

   public function __construct()
   {
      $data = file_get_contents(Constants::PROJECT_LIST_DATA_DEBUG_PATH . 'ProjectListData.txt');
      $this->projectListJsonArray = self::ExtratStringIntoJsonArray($data);
   }

   public function GetProjectListJsonArray() : array
   {
      return $this->projectListJsonArray;
   }
}