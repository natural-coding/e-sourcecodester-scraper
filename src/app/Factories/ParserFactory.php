<?php

namespace App\Factories;
use App\Interfaces\GetProjectListInterface;
use App\ProjectListWebPageParser;


class ParserFactory extends FactoryBase
{
   public function createProjectListWebPageParser(string $p_ProjectListPageHtml) : GetProjectListInterface
   {
      return new ProjectListWebPageParser($p_ProjectListPageHtml);
   }
}
