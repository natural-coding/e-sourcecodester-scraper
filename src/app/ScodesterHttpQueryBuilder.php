<?php

namespace App;

use \Framework\HttpQueryBuilder;

class ScodesterHttpQueryBuilder extends HttpQueryBuilder
{
   public function __construct(string $p_siteUrl)
   {
      parent::__construct($p_siteUrl);
   }

   public function getDownloadQuery() : string
   {
      return $this->getSiteUrl();
   }

   public function getProjectListWebPageQuery(int $p_pageIndex) : string
   {
      return sprintf('%s/php?page=%d',$this->getSiteUrl(),abs($p_pageIndex));
   }
}