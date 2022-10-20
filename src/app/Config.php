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
}
