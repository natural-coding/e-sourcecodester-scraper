<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Config;
use App\Constants;
use App\Factories\CurlWrapperFactory;
use App\Factories\SleeperFactory;
use App\Factories\ParserFactory;
use App\ScodesterHttpRequestBuilder;


$factory_Array = [];

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
   $factory_Array['CurlWrapper'] = new CurlWrapperFactory($useTestDoubles);
   
   $useTestDoublesForSleepers = true;
   $factory_Array['Sleeper'] = new SleeperFactory($useTestDoublesForSleepers);
   
   $factory_Array['Parser'] = new ParserFactory();

   $requestPageCurlWrapper = $factory_Array['CurlWrapper']->createRequestPageCurlWrapper();

   for($pageNumQueryParam = $configStage->PaginationStartPage;
      $pageNumQueryParam <= $configStage->PaginationEndPage;
      ++$pageNumQueryParam)
   {
      printf('Fetching data for page %d...', $pageNumQueryParam);

      $url = (new ScodesterHttpRequestBuilder($configScraper->SiteUrl))
         ->getProjectListWebPageRequest($pageNumQueryParam);

      $response = $requestPageCurlWrapper->sendRequest($url);

      $projectListArray = ($factory_Array['Parser']->createProjectListWebPageParser($response))
         ->getProjectListJsonArray();

      $outArr =& $output_ScrapingResultsArray['ProjectListWebPage'];
      $outArr = array_merge($outArr,$projectListArray);

      print 'OK' . PHP_EOL;

      print 'Delay between requests...';
      $factory_Array['Sleeper']->createSleeper($configScraper->RequestDelayMin,$configScraper->RequestDelayMax);
      print 'OK' . PHP_EOL;
   }

   file_put_contents(
      $configApp->getFileNameForStage($configStage->name),
      json_encode($output_ScrapingResultsArray['ProjectListWebPage'])
   );
}

$configStage = $configApp->getScrapingStage('ProjectSourcesDownloadLink');
$output_ScrapingResultsArray['ProjectSourcesDownloadLink'] = [];