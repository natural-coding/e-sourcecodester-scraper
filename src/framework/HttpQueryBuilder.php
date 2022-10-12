<?php

namespace Framework;

class HttpQueryBuilder
{
   private string $siteUrl;

   public function __construct(string $p_siteUrl)
   {
      $this->siteUrl = rtrim($p_siteUrl,'/');
   }

   public function getSiteUrl() : string
   {
      return $this->siteUrl;
   }
}
