<?php

namespace App;

class ProjectDownloadingPageParser implements \App\Interfaces\GetUrlForZippedProjectSourcesInterface
{
   function getUrlForZippedProjectSources() : string
   {
      return 'https://www.sourcecodester.com/sites/default/files/download/oretnom23/train_scheduler_app.zip';
   }
}
