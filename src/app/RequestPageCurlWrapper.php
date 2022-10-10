<?php

namespace App;

class RequestPageCurlWrapper implements Interfaces\RequestPageInterface
{
   function sendRequest(string $p_Url) : string
   {
      print __FUNCTION__ . PHP_EOL;
      return __FUNCTION__;
   }
}