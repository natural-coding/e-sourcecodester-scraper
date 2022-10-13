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
      $fileName = 'example-ProjectList-page0.html';
      if (strpos($p_Url,'/download-code'))
         $fileName = '02-example-ProjectDownloadingPage-15720.html';

      return file_get_contents(Constants::PROJECT_LIST_DATA_DEBUG_PATH . $fileName);
   }   
}
