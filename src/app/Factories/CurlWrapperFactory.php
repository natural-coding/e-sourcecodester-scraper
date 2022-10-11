<?php

namespace App\Factories;

use App\RequestPageCurlWrapper;
use App\Interfaces\RequestPageInterface;

class CurlWrapperFactory
{
   private const ERROR_CANNOT_INIT_CURL = '[ERROR]: curl_init';
   private $curlHandle;
   private $methodsThatReturnTestDouble = [];

   private function methodShouldReturnTestDouble($p_methodName) : bool
   {
      return in_array($p_methodName,$this->methodsThatReturnTestDouble);
   }

   public function __construct($p_methodsThatReturnTestDouble = [])
   {
      $this->methodsThatReturnTestDouble = $p_methodsThatReturnTestDouble;

      $this->curlHandle = curl_init();
      if (!$this->curlHandle)
         throw new \Exception(self::ERROR_CANNOT_INIT_CURL);
   }

   public function __destruct()
   {
      curl_close($this->curlHandle);
   }

   public function createRequestPageCurlWrapper() : RequestPageInterface
   {
      if (self::methodShouldReturnTestDouble(__FUNCTION__))
         return new \App\TestDoubles\RequestPageCurlWrapperMock($this->curlHandle);
      else
         return new RequestPageCurlWrapper($this->curlHandle);
   }
}