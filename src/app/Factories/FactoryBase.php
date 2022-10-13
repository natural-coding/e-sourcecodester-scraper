<?php

namespace App\Factories;

class FactoryBase
{
   private $methodsThatReturnTestDouble = [];

   protected function methodShouldReturnTestDouble($p_methodName) : bool
   {
      return in_array($p_methodName,$this->methodsThatReturnTestDouble);
   }

   private function useTestDoubles(bool $p_useTestDoubles, array $p_methodNamesToUseArray = [])
   {
      if (!$p_useTestDoubles)
         $this->methodsThatReturnTestDouble = [];
      else
      {
         $diff = array_diff($p_methodNamesToUseArray, $this->methodsThatReturnTestDouble);

         array_push($this->methodsThatReturnTestDouble, ...$diff);
      }
   }

   public function __construct(bool $p_useTestDoubles = false, array $p_methodNamesToUseArray = [])
   {
      $this->useTestDoubles($p_useTestDoubles,$p_methodNamesToUseArray);
   }





}
