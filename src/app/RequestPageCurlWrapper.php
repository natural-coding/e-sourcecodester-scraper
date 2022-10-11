<?php

namespace App;
use App\CurlWrapperBase;

class RequestPageCurlWrapper extends CurlWrapperBase implements Interfaces\RequestPageInterface
{
   public function __construct($p_curlHandle)
   {
      parent::__construct($p_curlHandle);
   }
   
   function sendRequest(string $p_Url) : string
   {
      print __FUNCTION__ . PHP_EOL;
      return __FUNCTION__;
   }
}