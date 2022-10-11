<?php

namespace App;

use App\Constants;

class CurlWrapperBase
{
   protected const ERROR_CURL_SETOPT = '[ERROR]: curl_setopt_array';
   protected const ERROR_CURL_EXEC = '[ERROR]: curl_exec';

   private $curlHandle;

   protected function getCurlHandle()
   {
      return $this->curlHandle;
   }

   public function __construct($p_curlHandle)
   {
      $this->curlHandle = $p_curlHandle;

      $this->setDefaultOptions();
   }

   static protected function CheckCurlSetopt(bool $p_result)
   {
      if (!$p_result)
         throw new \Exception(self::ERROR_CURL_SETOPT);
   }

   protected function setDefaultOptions() : bool
   {
      curl_reset($this->curlHandle);
      $options = array(
         CURLOPT_CAINFO => Constants::APP_PATH . 'cacert.pem',
         CURLOPT_HEADER => false,
         CURLOPT_RETURNTRANSFER => true
      );

      $res = curl_setopt_array($this->curlHandle, $options);
      self::CheckCurlSetopt($res);

      return $res;
   }

}
