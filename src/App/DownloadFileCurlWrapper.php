<?php


namespace App;

use Interfaces\DownloadFileInterface;

class DownloadFileCurlWrapper implements DownloadFileInterface
{
   const ERROR_CURL_SETOPT = '[ERROR]: curl_setopt_array';
   const ERROR_CURL_EXEC = '[ERROR]: curl_exec';

   private $ch;
   private string $downloadsDirectory;

   static private function CheckCurlSetopt(bool $p_result)
   {
      if (!$p_result)
         throw new \Exception(self::ERROR_CURL_SETOPT);
   }

   private function setCommonOptions() : bool
   {
      curl_reset($this->ch);
      $options = array(
         CURLOPT_CAINFO => Constants::CONFIG_PATH . 'cacert.pem',
         CURLOPT_HEADER => false,
         CURLOPT_RETURNTRANSFER => true
      );

      return curl_setopt_array($this->ch, $options);
   }

   public function __construct(
      $p_curlHandle,
      string $p_downloadsDirectory = Constants::DOWNLOADS_PATH
   )
   {
      $this->ch = $p_curlHandle;
      $this->downloadsDirectory = $p_downloadsDirectory;

      self::CheckCurlSetopt($this->setCommonOptions());
   }

   public function downloadFile(string $p_fileUrl, string $p_fileName)
   {
      $fullFileName = $this->downloadsDirectory . $p_fileName;

      /**
       * Upon failure, an E_WARNING is emitted.
       */
      $binaryFilePointer = fopen($fullFileName, "wb");

      $options = array(
         CURLOPT_URL => $p_fileUrl,
         CURLOPT_FILE => $binaryFilePointer
      );

      self::CheckCurlSetopt(curl_setopt_array($this->ch, $options));

      curl_exec($this->ch);

      if(curl_error($this->ch))
         new \Exception(self::ERROR_CURL_EXEC);


      fclose($binaryFilePointer);
   }
}