<?php

namespace App;

use Interfaces\GetProjectListInterface;

class ProjectListWebPageParser implements GetProjectListInterface
{
   /**
    * Regex contains the following groups:
    * (?<ProjectId>), (?<ProjectUri>), (?<ProjectTitle>)
    */
   const PROJECT_DATA_REGEX = '#<article data-history-node-id="(?<ProjectId>\d+)".+about="(?<ProjectUri>[^"]+)"[\s\S]+?(?=<span)<span[^>]+>(?<ProjectTitle>.+)</span>#';

   private array $projectListJsonArray;

   static private function parseHtmlIntoJsonArray(string $p_ProjectListPageHtml) : array
   {
      $outJsonArray = [];
      $matchesArray = [];

      /**
       * Regex contains the following groups:
       * (?<ProjectId>), (?<ProjectUri>), (?<ProjectTitle>)
       */
      preg_match_all(
         self::PROJECT_DATA_REGEX,
         $p_ProjectListPageHtml,
         $matchesArray
      );

      foreach($matchesArray['ProjectId'] as $i => $idVal)
      {
         $projectData = new \stdClass();
         $projectData->id = $idVal;
         $projectData->title = $matchesArray['ProjectTitle'][$i];
         $projectData->uri = $matchesArray['ProjectUri'][$i];

         array_push($outJsonArray,$projectData);
      }

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