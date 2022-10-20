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

   public function getScrapingStage(string $p_scrapingStageName) : \stdClass
   {
      return new \stdClass();
   }

   public function getGlobalScraperSetup() : \stdClass
   {
      return new \stdClass();
   }
}
