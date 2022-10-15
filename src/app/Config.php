<?php

namespace App;
use App\Constants;

class Config
{
   private \stdClass $configJson;

   public function __construct(string $p_jsonFileName)
   {
      $jsonStr = file_get_contents($p_jsonFileName);
      $this->configJson = json_decode($jsonStr);
   }

   public function getJson() : \stdClass
   {
      return $this->configJson;
   }

   public function getSiteUrl() : string
   {
      return $this->getJson()->SiteUrl;
   }

   public function getOutputDirForStage(string $p_scrapingStageName) : string
   {
      $outputDir = Constants::SCRAPER_OUTPUT_PATH;

      switch ($p_scrapingStageName)
      {
         case "01-ProjectListPage":
            $outputDir .= $p_scrapingStageName;
            break;
         default:
            rtrim($outputDir,DIRECTORY_SEPARATOR);
            break;
      }

      return realpath($outputDir) . DIRECTORY_SEPARATOR;
   }

   public function getFileNameForStage(string $p_scrapingStageName) : string
   {
      $outFileName = 'default.txt';

      switch ($p_scrapingStageName)
      {
         case "01-ProjectListPage":
            $outFileName = sprintf('project-descriptions-%03d-%03d',1,10);
            break;
      }

      return $this->getOutputDirForStage($p_scrapingStageName) . $outFileName;
   }
}
