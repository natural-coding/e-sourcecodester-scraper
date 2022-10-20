<?php

namespace App;
use App\Constants;

class Config
{
   private const ERROR_UNKNOWN_SCRAPING_STAGE = '[ERROR] Unknown scraping stage';
   private \stdClass $configJson;

   public function __construct(string $p_jsonFileName)
   {
      $jsonStr = file_get_contents($p_jsonFileName);
      $this->configJson = json_decode($jsonStr);
   }

   private function getJson() : \stdClass
   {
      return $this->configJson;
   }

   public function getScrapingStage(string $p_scrapingStageName) : \stdClass
   {
      foreach($this->getJson()->stages as $stage)
      {
         if ($stage->name === $p_scrapingStageName)
            return $stage;
      }

      throw new \Exception(sprintf('%s: -> (%s)', self::ERROR_UNKNOWN_SCRAPING_STAGE, $p_scrapingStageName));
   }

   public function getGlobalScraperSetup() : \stdClass
   {
      return $this->getJson()->GlobalScraperSetup;
   }

   public function getOutputDirForStage(string $p_scrapingStageName) : string
   {
      $scrapingStage = $this->getScrapingStage($p_scrapingStageName);
      $stageOutputDir = sprintf('%02d-%s', $scrapingStage->id, $scrapingStage->name);

      return Constants::SCRAPER_OUTPUT_PATH . $stageOutputDir . DIRECTORY_SEPARATOR;
   }
   public function getFileNameForStage(string $p_scrapingStageName) : string
   {
      $scrapingStage = $this->getScrapingStage($p_scrapingStageName);
      
      $stageFileName = sprintf('%s-%03d-%03d',
         $scrapingStage->outputFilePrefix,
         $scrapingStage->PaginationStartPage,
         $scrapingStage->PaginationEndPage
      );

      return  $this->getOutputDirForStage($p_scrapingStageName) . $stageFileName;
   }
}
