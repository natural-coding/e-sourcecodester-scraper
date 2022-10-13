<?php

namespace App;
use App\CurlWrapperBase;

class RequestPageCurlWrapper extends CurlWrapperBase implements \App\Interfaces\RequestPageInterface
{
   public function __construct($p_curlHandle)
   {
      parent::__construct($p_curlHandle);
   }

   function sendRequest(string $p_Url) : string
   {
      $this->setDefaultOptions();

      $res = curl_setopt($this->getCurlHandle(),CURLOPT_URL,$p_Url);
      self::CheckCurlSetopt($res);

      $response = curl_exec($this->getCurlHandle());

      $errorMessage = curl_error($this->getCurlHandle());
      if($errorMessage)
         throw new \Exception(self::ERROR_CURL_EXEC . "($errorMessage)");

      return $response;
   }
}