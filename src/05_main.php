<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Config;
use App\Constants;
use App\Factories\CurlWrapperFactory;
use App\Factories\SleeperFactory;
use App\Factories\ParserFactory;
use App\ScodesterHttpRequestBuilder;


$factory_Array = [];
$factory_Array['CurlWrapper'] = new CurlWrapperFactory($useTestDoubles = false);
$factory_Array['Sleeper'] = new SleeperFactory($useTestDoublesForSleepers = true);
$factory_Array['Parser'] = new ParserFactory();

$configApp = new Config(Constants::CONFIG_PATH . 'app-config.json');
$configScraper = $configApp->getGlobalScraperSetup();

$output_Array = [];

$output_Array['ProjectListWebPage'] = [];

$configStage = $configApp->getScrapingStage('ProjectListWebPage');

if (!$configStage->MakeRequestsToNetwork)
{
   $jsonFileName = $configApp->getFileNameForStage($configStage->name);
   $output_Array['ProjectListWebPage'] = json_decode(file_get_contents($jsonFileName));
}
else
{
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

      $outArr =& $output_Array['ProjectListWebPage'];
      $outArr = array_merge($outArr,$projectListArray);

      print 'OK' . PHP_EOL;

      print 'Delay between requests...';
      $factory_Array['Sleeper']->createSleeper($configScraper->RequestDelayMin,$configScraper->RequestDelayMax);
      print 'OK' . PHP_EOL;
   }

   file_put_contents(
      $configApp->getFileNameForStage($configStage->name),
      json_encode($output_Array['ProjectListWebPage'])
   );
}

$output_Array['ProjectSourcesDownloadLink'] = [];

$configStage = $configApp->getScrapingStage('ProjectSourcesDownloadLink');

$output_PrevStage =& $output_Array['ProjectListWebPage'];

$requestPageCurlWrapper = $factory_Array['CurlWrapper']->createRequestPageCurlWrapper();

$projectIndexToStop = min(
   count($output_PrevStage),
   $configStage->SkipProjectsCount + $configStage->ProcessProjectsCount,
);

for($i = $configStage->SkipProjectsCount; $i < $projectIndexToStop; ++$i)
{

   $url = (new ScodesterHttpRequestBuilder($configScraper->SiteUrl))
      ->getProjectDownloadingPageRequest($output_PrevStage[$i]->id);

   $response = $requestPageCurlWrapper->sendRequest($url);

   $projectDownloadingPageParser = $factory_Array['Parser']->createProjectDownloadingPageParser($response);

   $record = new stdClass();

   $record->id = $output_PrevStage[$i]->id;
   $record->ZippedSourcesUri = $projectDownloadingPageParser->getUriForZippedProjectSources();

   array_push($output_Array['ProjectSourcesDownloadLink'],$record);

   print_r($output_Array['ProjectSourcesDownloadLink']);
   die;


   // $projectListArray = ($factory_Array['Parser']->createProjectListWebPageParser($response))
   // ->getProjectListJsonArray();

   // var_dump($output_PrevStage[$i]->id);
}
