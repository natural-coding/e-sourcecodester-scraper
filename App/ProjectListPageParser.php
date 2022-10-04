<?php

namespace App\ProjectListPageParser;
class Constants
{
   const URI_AND_PROJECT_TITLE_REGEX = '/<h2 class="node__title title">\s+<a[\s.]+href="(?<Uri>[^"]+)".+<span[^>]+>(?<ProjectTitle>.+)<\/span>\s+<\/a>/';
}

namespace App;

use Interfaces\GetProjectListInterface;

class ProjectListPageParser implements GetProjectListInterface
{
   private array $projectListJsonArray;

   static private function parseHtmlIntoJsonArray(string $p_ProjectListPageHtml) : array
   {
      $outJsonArray = [];
      $matchesArray = [];

      preg_match_all(
         '/<h2 class="node__title title">\s+<a[\s.]+href="(?<Uri>[^"]+)".+<span[^>]+>(?<ProjectTitle>.+)<\/span>\s+<\/a>/',
         $p_ProjectListPageHtml,
         $matchesArray
      );

      print_r($matchesArray);
      die;

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