<?php

namespace App\Interfaces;


interface DownloadFileInterface
{
   public function downloadFile(string $p_fileUrl, string $p_fileName);
}