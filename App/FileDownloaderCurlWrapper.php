<?php

namespace App;

class FileDownloaderCurlWrapper
{
   const ERROR_CURL_SETOPT = '[ERROR]: curl_setopt_array';

   private $ch;

   private function setOptions() : bool
   {
      curl_reset($this->ch);
      $options = array(
         CURLOPT_CAINFO => Constants::APP_PATH . 'cacert.pem',
         CURLOPT_HEADER => false,
         CURLOPT_RETURNTRANSFER => 1
      );

      return curl_setopt_array($this->ch, $options);
   }

   public function __construct($p_curlHandle)
   {
      $this->ch = $p_curlHandle;

      if (!$this->setOptions())
         throw new \Exception(self::ERROR_CURL_SETOPT);
  }
}