<?php

namespace App;

class Config
{
   private $configJson;
   public function __construct(string $p_fileName)
   {
      $jsonStr = file_get_contents($p_fileName);
      var_dump($jsonStr);
      die;
   }

   public function getConfigJson() : stdClass
   {

   }
}
