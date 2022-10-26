<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Config;
use App\Constants;
use App\Factories\CurlWrapperFactory;
use App\Factories\SleeperFactory;
use App\Factories\ParserFactory;
use App\ScodesterHttpRequestBuilder;


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
   $factory_CurlWrapper = new CurlWrapperFactory($useTestDoubles);

   // $factory_CurlWrapper = new CurlWrapperFactory();

   $requestPageCurlWrapper = $factory_CurlWrapper->createRequestPageCurlWrapper();

   for($pageNumQueryParam = $config["01-ProjectListPage"]->PaginationStartPage;
      $pageNumQueryParam <= $config["01-ProjectListPage"]->PaginationEndPage;
      ++$pageNumQueryParam)
   {
      $scodesterHttpRequestBuilder = new ScodesterHttpRequestBuilder($configMain->getSiteUrl());
      $url = $scodesterHttpRequestBuilder->getProjectListWebPageRequest($pageNumQueryParam);

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
   $factory_CurlWrapper = new CurlWrapperFactory($useTestDoubles);

   // $factory_CurlWrapper = new CurlWrapperFactory();

   $requestPageCurlWrapper = $factory_CurlWrapper->createRequestPageCurlWrapper();

   for($pageNumQueryParam = $configProjectListWebPage->PaginationStartPage;
      $pageNumQueryParam <= $configProjectListWebPage->PaginationEndPage;
      ++$pageNumQueryParam)
   {
      $scodesterHttpRequestBuilder = new ScodesterHttpRequestBuilder($configApp->getSiteUrl());
      $url = $scodesterHttpRequestBuilder->getProjectListWebPageRequest($pageNumQueryParam);

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

// ("85 scraping for stage 1 works")
/*
$configApp = new Config(Constants::CONFIG_PATH . 'app-config.json');
$configScraper = $configApp->getGlobalScraperSetup();
$configStage = $configApp->getScrapingStage('ProjectListWebPage');

$outProjectListAllArray = [];

if (!$configStage->MakeRequestsToNetwork)
{
   $jsonFileName = $configApp->getFileNameForStage($configStage->name);
   $outProjectListAllArray = json_decode(file_get_contents($jsonFileName));
   var_dump($outProjectListAllArray);
}
else
{
   die;
   // $useTestDoubles = true;
   // $factory_CurlWrapper = new CurlWrapperFactory($useTestDoubles);
   $factory_CurlWrapper = new CurlWrapperFactory();

   $useTestDoublesForSleepers = false;
   $factory_Sleeper = new SleeperFactory($useTestDoublesForSleepers);

   // $factory_CurlWrapper = new CurlWrapperFactory();

   $requestPageCurlWrapper = $factory_CurlWrapper->createRequestPageCurlWrapper();

   for($pageNumQueryParam = $configStage->PaginationStartPage;
      $pageNumQueryParam <= $configStage->PaginationEndPage;
      ++$pageNumQueryParam)
   {
      printf('Fetching data for page %d...', $pageNumQueryParam);

      $scodesterHttpRequestBuilder = new ScodesterHttpRequestBuilder($configScraper->SiteUrl);
      $url = $scodesterHttpRequestBuilder->getProjectListWebPageRequest($pageNumQueryParam);

      $response = $requestPageCurlWrapper->sendRequest($url);

      $projectListWebPageParser = new ProjectListWebPageParser($response);
      $projectListArray = $projectListWebPageParser->getProjectListJsonArray();

      $outProjectListAllArray = array_merge($outProjectListAllArray,$projectListArray);

      print 'OK' . PHP_EOL;

      print 'Delay between requests...';
      $factory_Sleeper->createSleeper($configScraper->RequestDelayMin,$configScraper->RequestDelayMax);
      print 'OK' . PHP_EOL;
   }

   file_put_contents(
      $configApp->getFileNameForStage($configStage->name),
      json_encode($outProjectListAllArray)
   );
}
*/
$configApp = new Config(Constants::CONFIG_PATH . 'app-config.json');
$configScraper = $configApp->getGlobalScraperSetup();

$output_ScrapingResultsArray = [];

$configStage = $configApp->getScrapingStage('ProjectListWebPage');
$output_ScrapingResultsArray['ProjectListWebPage'] = [];

if (!$configStage->MakeRequestsToNetwork)
{
   $jsonFileName = $configApp->getFileNameForStage($configStage->name);
   $output_ScrapingResultsArray['ProjectListWebPage'] = json_decode(file_get_contents($jsonFileName));
}
else
{
   $useTestDoubles = true;
   $factory_CurlWrapper = new CurlWrapperFactory($useTestDoubles);
   // $factory_CurlWrapper = new CurlWrapperFactory();

   $useTestDoublesForSleepers = true;
   $factory_Sleeper = new SleeperFactory($useTestDoublesForSleepers);

   $factory_Parser = new ParserFactory();

   $requestPageCurlWrapper = $factory_CurlWrapper->createRequestPageCurlWrapper();

   for($pageNumQueryParam = $configStage->PaginationStartPage;
      $pageNumQueryParam <= $configStage->PaginationEndPage;
      ++$pageNumQueryParam)
   {
      printf('Fetching data for page %d...', $pageNumQueryParam);

      $url = (new ScodesterHttpRequestBuilder($configScraper->SiteUrl))
         ->getProjectListWebPageRequest($pageNumQueryParam);

      $response = $requestPageCurlWrapper->sendRequest($url);

      $projectListArray = ($factory_Parser->createProjectListWebPageParser($response))
         ->getProjectListJsonArray();

      $outArr =& $output_ScrapingResultsArray['ProjectListWebPage'];
      $outArr = array_merge($outArr,$projectListArray);

      print 'OK' . PHP_EOL;

      print 'Delay between requests...';
      $factory_Sleeper->createSleeper($configScraper->RequestDelayMin,$configScraper->RequestDelayMax);
      print 'OK' . PHP_EOL;
   }

   file_put_contents(
      $configApp->getFileNameForStage($configStage->name),
      json_encode($output_ScrapingResultsArray['ProjectListWebPage'])
   );
}