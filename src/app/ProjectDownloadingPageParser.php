<?php

namespace App;

class ProjectDownloadingPageParser implements \App\Interfaces\GetUriForZippedProjectSourcesInterface
{
   /**
    * Regex contains the following groups:
    * (?<ZippedUriToDownload>)
    */
   const PROJECT_ZIPPED_SOURCE_REGEX = <<<EndMarker
#var _file = '(?<ZippedUriToDownload>[^']+)';#   
EndMarker;
   const ERROR_CANNOT_FIND_ZIPPED_URI_TO_DOWNLOAD = '[ERROR] Can not find zipped URI to download!';

   private string $zippedUriToDownload;

   public function __construct(string $p_ProjectListPageHtml)
   {
      $matchesArray = [];

      preg_match(self::PROJECT_ZIPPED_SOURCE_REGEX, $p_ProjectListPageHtml, $matchesArray);

      $this->zippedUriToDownload = $matchesArray['ZippedUriToDownload'];

      if ($this->zippedUriToDownload === '')
         throw new Exception(self::ERROR_CANNOT_FIND_ZIPPED_URI_TO_DOWNLOAD);
   }

   function getUriForZippedProjectSources() : string
   {
      return $this->zippedUriToDownload;
   }
}
