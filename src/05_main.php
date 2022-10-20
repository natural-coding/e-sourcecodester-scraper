<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Config;
use App\Constants;
use App\Factories\CurlWrapperFactory;
use App\ScodesterHttpQueryBuilder;
use App\ProjectListWebPageParser;

// ("73 read config from file")
/*
new Config(Constants::CONFIG_PATH . 'app-config.json');
*/

// ("75 read the JSON!!")
/*
$config = new Config(Constants::CONFIG_PATH . 'app-config.json');
var_dump($config->getJson());
*/

// ("78 getFileNameForStage works")
/*
$configMain = new Config(Constants::CONFIG_PATH . 'app-config.json');

$config = [];
$config["01-ProjectListPage"] = $configMain->getJson()->ProjectListPage;
$config["02-ProjectSourcesDownloadLink"] = $configMain->getJson()->ProjectSourcesDownloadLink;
$config["03-ProjectSourcesZipFile"] = $configMain->getJson()->ProjectSourcesZipFile;

$projectListAllArray = [];

if ($config["01-ProjectListPage"]->MakeRequestsToNetwork)
{
   $useTestDoubles = true;
   $curlWrapperFactory = new CurlWrapperFactory($useTestDoubles);

   // $curlWrapperFactory = new CurlWrapperFactory();

   $requestPageCurlWrapper = $curlWrapperFactory->createRequestPageCurlWrapper();

   for($pageNumQueryParam = $config["01-ProjectListPage"]->PaginationStartPage;
      $pageNumQueryParam <= $config["01-ProjectListPage"]->PaginationEndPage;
      ++$pageNumQueryParam)
   {
      $scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder($configMain->getSiteUrl());
      $url = $scodesterHttpQueryBuilder->getProjectListWebPageQuery($pageNumQueryParam);

      $response = $requestPageCurlWrapper->sendRequest($url);

      $projectListWebPageParser = new ProjectListWebPageParser($response);
      $projectListArray = $projectListWebPageParser->getProjectListJsonArray();

      $projectListAllArray = array_merge($projectListAllArray,$projectListArray);
   }

   file_put_contents(
      $configMain->getFileNameForStage("01-ProjectListPage"),
      json_encode($projectListAllArray)
   );
}
*/

// ("79 Refactor Config class usage")
/*
$configApp = new Config(Constants::CONFIG_PATH . 'app-config.json');
$configProjectListWebPage = $configApp->getJson()->ProjectListPage;

$projectListAllArray = [];
// 
// Stage 01. Get project ids and descriptions from the web page
// 
if ($configProjectListWebPage->MakeRequestsToNetwork)
{
   $useTestDoubles = true;
   $curlWrapperFactory = new CurlWrapperFactory($useTestDoubles);

   // $curlWrapperFactory = new CurlWrapperFactory();

   $requestPageCurlWrapper = $curlWrapperFactory->createRequestPageCurlWrapper();

   for($pageNumQueryParam = $configProjectListWebPage->PaginationStartPage;
      $pageNumQueryParam <= $configProjectListWebPage->PaginationEndPage;
      ++$pageNumQueryParam)
   {
      $scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder($configApp->getSiteUrl());
      $url = $scodesterHttpQueryBuilder->getProjectListWebPageQuery($pageNumQueryParam);

      $response = $requestPageCurlWrapper->sendRequest($url);

      $projectListWebPageParser = new ProjectListWebPageParser($response);
      $projectListArray = $projectListWebPageParser->getProjectListJsonArray();

      $projectListAllArray = array_merge($projectListAllArray,$projectListArray);
   }

   file_put_contents(
      $configApp->getOutputDirForStage('dummy') . 'projectListAllArray',
      json_encode($projectListAllArray)
   );
}
*/

// ("82 new config works 1")
/*
$configApp = new Config(Constants::CONFIG_PATH . 'app-config.json');

// var_dump($configApp->getScrapingStage('ProjectListWebPage'));
// var_dump($configApp->getScrapingStage('ProjectSourcesZipFile'));
// var_dump($configApp->getScrapingStage('ProjectSourcesZipFilettt'));
var_dump($configApp->getGlobalScraperSetup());
*/

$configApp = new Config(Constants::CONFIG_PATH . 'app-config.json');
$configScraper = $configApp->getGlobalScraperSetup();
$configStage = $configApp->getScrapingStage('ProjectListWebPage');

$outProjectListAllArray = [];

if ($configStage->MakeRequestsToNetwork)
{
   $useTestDoubles = true;
   $curlWrapperFactory = new CurlWrapperFactory($useTestDoubles);

   // $curlWrapperFactory = new CurlWrapperFactory();

   $requestPageCurlWrapper = $curlWrapperFactory->createRequestPageCurlWrapper();

   for($pageNumQueryParam = $configStage->PaginationStartPage;
      $pageNumQueryParam <= $configStage->PaginationEndPage;
      ++$pageNumQueryParam)
   {
      $scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder($configScraper->SiteUrl);
      $url = $scodesterHttpQueryBuilder->getProjectListWebPageQuery($pageNumQueryParam);

      $response = $requestPageCurlWrapper->sendRequest($url);

      $projectListWebPageParser = new ProjectListWebPageParser($response);
      $projectListArray = $projectListWebPageParser->getProjectListJsonArray();

      $outProjectListAllArray = array_merge($outProjectListAllArray,$projectListArray);
   }

   file_put_contents(
      $configApp->getFileNameForStage($configStage->name),
      json_encode($outProjectListAllArray)
   );
}