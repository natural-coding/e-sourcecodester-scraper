<?php

namespace App\Factories;

use App\RequestPageCurlWrapper;
use App\DownloadFileCurlWrapper;
use App\Interfaces\RequestPageInterface;
use App\Interfaces\DownloadFileInterface;

class CurlWrapperFactory
{
   private const ERROR_CANNOT_INIT_CURL = '[ERROR]: curl_init';
   private $curlHandle;
   private $methodsThatReturnTestDouble = [];

   private function methodShouldReturnTestDouble($p_methodName) : bool
   {
      return in_array($p_methodName,$this->methodsThatReturnTestDouble);
   }

   private function useTestDoubles(bool $p_useTestDoubles)
   {
      if (!$p_useTestDoubles)
         $this->methodsThatReturnTestDouble = [];
      else
      {
         $methodsToPushArray = ['createRequestPageCurlWrapper'];
         $diff = array_diff($methodsToPushArray, $this->methodsThatReturnTestDouble);

         array_push($this->methodsThatReturnTestDouble, ...$diff);
      }
   }

   public function __construct(bool $p_useTestDoubles = false)
   {
      $this->useTestDoubles($p_useTestDoubles);

      if ($p_useTestDoubles)
         return;

      $this->curlHandle = curl_init();
      if (!$this->curlHandle)
         throw new \Exception(self::ERROR_CANNOT_INIT_CURL);
   }

   public function __destruct()
   {
      if ($this->curlHandle)
         curl_close($this->curlHandle);
   }

   public function createRequestPageCurlWrapper() : RequestPageInterface
   {
      if (self::methodShouldReturnTestDouble(__FUNCTION__))
         return new \App\TestDoubles\RequestPageCurlWrapperMock($this->curlHandle);
      else
         return new RequestPageCurlWrapper($this->curlHandle);
   }

   public function createDownloadFileCurlWrapper() : DownloadFileInterface
   {
      return new DownloadFileCurlWrapper();
   }
}