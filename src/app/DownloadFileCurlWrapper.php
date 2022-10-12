<?php


namespace App;
use App\CurlWrapperBase;

class DownloadFileCurlWrapper implements \App\Interfaces\DownloadFileInterface
{
   public function __construct()
   {
      print __FUNCTION__;
   }

   public function downloadFile(string $p_fileUrl, string $p_fileName)
   {
   }
}