<?php

namespace App;

require_once(Constants::FRAMEWORK_PATH . 'HttpQueryBuilder.php');

class ScodesterHttpQueryBuilder extends \Framework\HttpQueryBuilder
{
   public function __construct(string $p_siteUrl)
   {
      parent::__construct($p_siteUrl);
   }

   public function getDownloadQuery() : string
   {
      return $this->getSiteUrl();
   }

   public function getProjectListQuery() : string
   {
      return $this->getSiteUrl();
   }
}