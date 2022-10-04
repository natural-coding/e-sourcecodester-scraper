<?php

namespace App;

use Interfaces\GetProjectListInterface;

class ProjectListPageParser implements GetProjectListInterface
{
   private array $projectListJsonArray;

   static private function parseHtmlIntoJsonArray(string $p_ProjectListPageHtml) : array
   {
      $outJsonArray = [];

      $projectData = new \stdClass();

      $projectData->id = trim('15627');
      $projectData->title = trim('Web-Based Student Clearance System in PHP Free Source Code');

      array_push($outJsonArray,$projectData);

      $projectData = new \stdClass();
      
      $projectData->id = trim('15688');
      $projectData->title = trim('Canteen Management System Project Source Code in PHP Free Download');

      array_push($outJsonArray,$projectData);      

      return $outJsonArray;
   }

   public function __construct(string $p_ProjectListPageHtml)
   {
      $this->projectListJsonArray = self::parseHtmlIntoJsonArray($p_ProjectListPageHtml);
   }

   public function GetProjectListJsonArray() : array
   {
      return $this->projectListJsonArray;
   }
}