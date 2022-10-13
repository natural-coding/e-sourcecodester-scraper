<?php

namespace App\Factories;

use App\RequestPageCurlWrapper;
use App\DownloadFileCurlWrapper;
use App\Interfaces\RequestPageInterface;
use App\Interfaces\DownloadFileInterface;

class CurlWrapperFactory extends FactoryBase
{
   private const ERROR_CANNOT_INIT_CURL = '[ERROR]: curl_init';
   private $curlHandle;

   public function __construct(bool $p_useTestDoubles = false)
   {
      $methodNamesToUseAsTestDoubles = ['createRequestPageCurlWrapper'];
      parent::__construct($p_useTestDoubles,$methodNamesToUseAsTestDoubles);

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
      if ($this->methodShouldReturnTestDouble(__FUNCTION__))
         return new \App\TestDoubles\RequestPageCurlWrapperMock($this->curlHandle);
      else
         return new RequestPageCurlWrapper($this->curlHandle);
   }

   public function createDownloadFileCurlWrapper(string $p_downloadsDirectory) : DownloadFileInterface
   {
      return new DownloadFileCurlWrapper($this->curlHandle,$p_downloadsDirectory);
   }
}