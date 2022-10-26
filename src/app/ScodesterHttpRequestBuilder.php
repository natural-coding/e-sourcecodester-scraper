<?php

namespace App;

use \Framework\HttpRequestBuilder;

class ScodesterHttpRequestBuilder extends HttpRequestBuilder
{
   public function __construct(string $p_siteUrl)
   {
      parent::__construct($p_siteUrl);
   }

   public function getProjectDownloadingPageRequest(int $p_projectId) : string
   {
      return sprintf('%s/download-code?nid=%d',$this->getSiteUrl(),abs($p_projectId));
   }

   public function getProjectListWebPageRequest(int $p_pageIndex) : string
   {
      return sprintf('%s/php?page=%d',$this->getSiteUrl(),abs($p_pageIndex));
   }
}