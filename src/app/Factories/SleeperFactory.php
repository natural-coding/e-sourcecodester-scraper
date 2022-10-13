<?php

namespace App\Factories;
use Framework\Sleeper;

class SleeperFactory extends FactoryBase
{
   public function __construct(bool $p_useTestDoubles = false)
   {
      $methodNamesToUseAsTestDoubles = ['createSleeper'];
      parent::__construct($p_useTestDoubles,$methodNamesToUseAsTestDoubles);
   }

   public function createSleeper() : Sleeper
   {
      if ($this->methodShouldReturnTestDouble(__FUNCTION__))
         return new Sleeper(0,0);
      else
         return new Sleeper();
   }
}
