<?php

namespace App\TestDoubles;

use App\Constants;

class RequestPageCurlWrapperMock implements \App\Interfaces\RequestPageInterface
{
   public function __construct($p_curlHandle)
   {
   }

   function sendRequest(string $p_Url) : string
   {
      return file_get_contents(Constants::PROJECT_LIST_DATA_DEBUG_PATH . 'example-ProjectList-page0.html');
   }   
}
