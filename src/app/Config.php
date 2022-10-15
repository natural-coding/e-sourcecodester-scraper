<?php

namespace App;

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
}
