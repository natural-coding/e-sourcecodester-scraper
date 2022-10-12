<?php

namespace App;

use \Framework\HttpQueryBuilder;

class ScodesterHttpQueryBuilder extends HttpQueryBuilder
{
   public function __construct(string $p_siteUrl)
   {
      parent::__construct($p_siteUrl);
   }

   public function getProjectDownloadingPageQuery(int $p_projectId) : string
   {
      return sprintf('%s/download-code?nid=%d',$this->getSiteUrl(),abs($p_projectId));
   }

   public function getProjectListWebPageQuery(int $p_pageIndex) : string
   {
      return sprintf('%s/php?page=%d',$this->getSiteUrl(),abs($p_pageIndex));
   }
}