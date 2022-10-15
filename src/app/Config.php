<?php

namespace App;

class Config
{
   private \stdClass $configJson;

   public function __construct(string $p_fileName)
   {
      $jsonStr = file_get_contents($p_fileName);
      $this->configJson = json_decode($jsonStr);
   }

   public function getJson() : \stdClass
   {
      return $this->configJson;
   }
}
