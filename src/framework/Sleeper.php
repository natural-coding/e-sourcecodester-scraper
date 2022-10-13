<?php

namespace Framework;

/**
 * Stops execution of the main thread for given amount of seconds
 * It prevents sending too many requests to the server
 */
class Sleeper
{
   public function __construct(int $p_minAmountOfSeconds = 2,int $p_maxAmountOfSeconds = 10)
   {
      $min = \min($p_minAmountOfSeconds,$p_maxAmountOfSeconds);
      $max = \max($p_minAmountOfSeconds,$p_maxAmountOfSeconds);

      sleep(random_int($min,$max));
   }
}
