<?php

namespace App\Factories;

use App\RequestPageCurlWrapper;
use App\Interfaces\RequestPageInterface;

class CurlWrapperFactory
{
   public function __construct()
   {

   }

   public function createRequestPageCurlWrapper() : RequestPageInterface
   {
      return new RequestPageCurlWrapper();
   }
}
