<?php

namespace App;

use Interfaces\GetProjectListInterface;

class ProjectListPageParser implements GetProjectListInterface
{
   const URI_AND_PROJECT_TITLE_REGEX = '#<h2 class="node__title title">\s+<a[\s.]+href="(?<Uri>[^"]+)".+<span[^>]+>(?<ProjectTitle>.+)</span>\s+</a>#';
   const GET_PROJECT_ID_FROM_URI_REGEX = '#/php/(?<ProjectId>\d+)/#';

   const ERROR_URI_PROJECT_TITLE_COUNT_MISMATCH = '[ERROR]: Uri and ProjectTitle mismatch!';

   private array $projectListJsonArray;

   static private function parseHtmlIntoJsonArray(string $p_ProjectListPageHtml) : array
   {
      $outJsonArray = [];
      $matchesArray = [];

      /**
       * There are two groups in regex: (?<Uri>) and (?<ProjectTitle>)
       */
      preg_match_all(
         self::URI_AND_PROJECT_TITLE_REGEX,
         $p_ProjectListPageHtml,
         $matchesArray
      );

      if (count($matchesArray['Uri']) != count($matchesArray['ProjectTitle']))
         throw new \Exception(self::ERROR_URI_PROJECT_TITLE_COUNT_MISMATCH);

      foreach($matchesArray['Uri'] as $i => $uriVal)
      {
         $matchesArrayId = [];
         /**
          * There is one group in regex: (?<ProjectId>)
          */
         preg_match(self::GET_PROJECT_ID_FROM_URI_REGEX,$uriVal,$matchesArrayId);

         $projectData = new \stdClass();
         $projectData->id = $matchesArrayId['ProjectId'];
         $projectData->title = $matchesArray['ProjectTitle'][$i];
         $projectData->uri = $uriVal;

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