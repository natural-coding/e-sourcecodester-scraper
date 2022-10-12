<?php


namespace App;
use App\CurlWrapperBase;

class DownloadFileCurlWrapper extends CurlWrapperBase implements \App\Interfaces\DownloadFileInterface
{
   private const ERROR_CANNOT_OPEN_FILE = '[ERROR] Can not open file';
   private string $downloadsDirectory;

   public function __construct($p_curlHandle, string $p_downloadsDirectory)
   {
      parent::__construct($p_curlHandle);
      $this->downloadsDirectory = $p_downloadsDirectory;
   }

   public function downloadFile(string $p_fileUrl, string $p_fileName)
   {
      $fullFileName = $this->downloadsDirectory . $p_fileName;

      /**
       * Upon failure, a E_WARNING is emitted.
       */
      $binaryFilePointer = fopen($fullFileName, "wb");
      if (!$binaryFilePointer)
         throw new Exception(self::ERROR_CANNOT_OPEN_FILE . " ($p_fileName)");

      $options = array(
         CURLOPT_URL => $p_fileUrl,
         CURLOPT_FILE => $binaryFilePointer
      );

      self::CheckCurlSetopt(curl_setopt_array($this->getCurlHandle(), $options));

      curl_exec($this->getCurlHandle());

      if(curl_error($this->getCurlHandle()))
         throw new \Exception(self::ERROR_CURL_EXEC);

      fclose($binaryFilePointer);
   }
}