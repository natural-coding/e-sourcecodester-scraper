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
      $urls=<<<ENDMARKER
https://www.sourcecodester.com/php?page=0
https://www.sourcecodester.com/php?page=1
https://www.sourcecodester.com/php?page=2
https://www.sourcecodester.com/php?page=3
ENDMARKER;
      $urlsArr = explode(PHP_EOL,$urls);

      return $urlsArr[$p_pageIndex % count($urlsArr)];
   }
}