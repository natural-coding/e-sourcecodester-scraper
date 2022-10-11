<?php

namespace App\TestDoubles;

class RequestPageCurlWrapperMock implements \App\Interfaces\RequestPageInterface
{
   public function __construct()
   {
      print __FUNCTION__;
   }

   function sendRequest(string $p_Url) : string
   {
      return __FUNCTION__;
   }   
}
