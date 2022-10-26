<?php

namespace App\Factories;
use Framework\Sleeper;

class SleeperFactory extends UseTestDoublesFactory
{
   public function __construct(bool $p_useTestDoubles = false)
   {
      $methodNamesToUseAsTestDoubles = ['createSleeper'];
      parent::__construct($p_useTestDoubles,$methodNamesToUseAsTestDoubles);
   }

   public function createSleeper(int $p_minAmountOfSeconds = 2,int $p_maxAmountOfSeconds = 10) : Sleeper
   {
      if ($this->methodShouldReturnTestDouble(__FUNCTION__))
         return new Sleeper(0,0);
      else
         return new Sleeper($p_minAmountOfSeconds,$p_maxAmountOfSeconds);
   }
}
