<?php

namespace App\Factories;

use App\RequestPageCurlWrapper;
use App\Interfaces\RequestPageInterface;

class CurlWrapperFactory
{
   private const ERROR_CANNOT_INIT_CURL = '[ERROR]: curl_init';
   private $curlHandle;
   public function __construct()
   {
      $this->curlHandle = curl_init();
      if (!$this->curlHandle)
         throw new Exception(selff::ERROR_CANNOT_INIT_CURL);
   }

   public function __destruct()
   {
      curl_close($this->curlHandle);
   }

   public function createRequestPageCurlWrapper() : RequestPageInterface
   {
      //return new RequestPageCurlWrapper($this->curlHandle);
      return new \App\TestDoubles\RequestPageCurlWrapperMock;
   }
}
