<?php

namespace App\Factories;
use App\Interfaces\{GetProjectListInterface,GetUriForZippedProjectSourcesInterface};
use App\{ProjectListWebPageParser,ProjectDownloadingPageParser};


class ParserFactory extends FactoryBase
{
   public function createProjectListWebPageParser(string $p_ProjectListPageHtml) : GetProjectListInterface
   {
      return new ProjectListWebPageParser($p_ProjectListPageHtml);
   }

   public function createProjectDownloadingPageParser(string $p_ProjectListPageHtml) :GetUriForZippedProjectSourcesInterface
   {
      return new ProjectDownloadingPageParser($p_ProjectListPageHtml);
   }
}
