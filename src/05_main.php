<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Constants;
use App\ScodesterHttpQueryBuilder;
use App\RequestPageCurlWrapper;
use App\ProjectListWebPageParser;
use App\ProjectDownloadingPageParser;
use App\DownloadFileCurlWrapper;
use App\Factories\CurlWrapperFactory;
use App\Factories\SleeperFactory;

// ("51 CurlWrapperFactory useTestDoubles method")

/*$useTestDoubles = true;
$curlWrapperFactory = new CurlWrapperFactory($useTestDoubles);
// $curlWrapperFactory = new CurlWrapperFactory();

$requestPageCurlWrapper = $curlWrapperFactory->createRequestPageCurlWrapper();

$projectListAllArray = [];

for($pageNumQueryParam = 0; $pageNumQueryParam < 2; ++$pageNumQueryParam)
{
   $scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder('https://www.sourcecodester.com/');
   $url = $scodesterHttpQueryBuilder->getProjectListWebPageQuery($pageNumQueryParam);

   $response = $requestPageCurlWrapper->sendRequest($url);

   $projectListWebPageParser = new ProjectListWebPageParser($response);
   $projectListArray = $projectListWebPageParser->getProjectListJsonArray();

   $projectListAllArray[$pageNumQueryParam] = $projectListArray;

   $randomAmountOfSeconds = random_int(3,7);
   print $randomAmountOfSeconds . PHP_EOL;

   // sleep($randomAmountOfSeconds);
}

//print_r($projectListAllArray);
print json_encode($projectListAllArray);
*/

// ("52 getProjectListWebPageQuery works using sprintf!")
/*
$scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder('https://www.sourcecodester.com/');
$url = $scodesterHttpQueryBuilder->getProjectListWebPageQuery(10);

print $url;
*/

// ("53 getDownloadQuery works")
/*
$scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder('https://www.sourcecodester.com/');
$url = $scodesterHttpQueryBuilder->getDownloadQuery(15628);

print $url;
*/

// ("54 use output-projectListAllArray.txt for development")
/*
$projectListAllArray = json_decode(file_get_contents(Constants::PROJECT_LIST_DATA_DEBUG_PATH . 'output-projectListAllArray.txt'));

print_r($projectListAllArray);
*/

// ("55 Add url to download source to project data JSON")
/*
$projectListAllArray = json_decode(file_get_contents(Constants::PROJECT_LIST_DATA_DEBUG_PATH . 'output-projectListAllArray.txt'));

foreach($projectListAllArray as $projectsOnWebPageArray)
   foreach($projectsOnWebPageArray as $projectData)
   {
      $scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder('https://www.sourcecodester.com/');

      $projectData->srcUrl = $scodesterHttpQueryBuilder->getDownloadQuery($projectData->id);
   }

print_r($projectListAllArray);
*/

// ("57 Download and save file")
/*
$useTestDoubles = true;
// $curlWrapperFactory = new CurlWrapperFactory($useTestDoubles);
$curlWrapperFactory = new CurlWrapperFactory();


$downloadFileCurlWrapper = $curlWrapperFactory->createDownloadFileCurlWrapper(Constants::DOWNLOADS_PATH);

$downloadFileCurlWrapper->downloadFile('https://www.sourcecodester.com/sites/default/files/download/oretnom23/train_scheduler_app.zip','15720.zip');
*/

// ("61 Get Project downloadingPage response")
/*
$projectListAllArray = json_decode(file_get_contents(Constants::PROJECT_LIST_DATA_DEBUG_PATH . 'output-projectListAllArray.txt'));

// $useTestDoubles = true;
// $curlWrapperFactory = new CurlWrapperFactory($useTestDoubles);
$curlWrapperFactory = new CurlWrapperFactory();

$requestPageCurlWrapper = $curlWrapperFactory->createRequestPageCurlWrapper();


$count = 0;

foreach($projectListAllArray as $projectsOnWebPageArray)
   foreach($projectsOnWebPageArray as $projectData)
   {
      $scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder('https://www.sourcecodester.com/');

      $downloadingPageUrl = $scodesterHttpQueryBuilder->getProjectDownloadingPageQuery($projectData->id);

      var_dump($projectData->id);

      $response = $requestPageCurlWrapper->sendRequest($downloadingPageUrl);
      var_dump($response);
      if (++$count===2)
         die;
      sleep(2);



      // $projectData->srcUrl = $scodesterHttpQueryBuilder->getProjectDownloadingPageQuery($projectData->id);
   }

print_r($projectListAllArray);
*/

// ("63 zipped uri parsing works")
/*
$projectListAllArray = json_decode(file_get_contents(Constants::PROJECT_LIST_DATA_DEBUG_PATH . 'output-projectListAllArray.txt'));

$useTestDoubles = true;
$curlWrapperFactory = new CurlWrapperFactory($useTestDoubles);
//$curlWrapperFactory = new CurlWrapperFactory();

$requestPageCurlWrapper = $curlWrapperFactory->createRequestPageCurlWrapper();

$count = 0;

foreach($projectListAllArray as $projectsOnWebPageArray)
   foreach($projectsOnWebPageArray as $projectData)
   {
      $scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder('https://www.sourcecodester.com/');

      $downloadingPageUrl = $scodesterHttpQueryBuilder->getProjectDownloadingPageQuery($projectData->id);

      $response = $requestPageCurlWrapper->sendRequest($downloadingPageUrl);

      $projectDownloadingPageParser = new ProjectDownloadingPageParser($response);
      $projectData->ZippedSourcesUri = $projectDownloadingPageParser->getUriForZippedProjectSources();

      //var_dump($response);
      var_dump($projectData->ZippedSourcesUri);
      die;



      // $projectData->srcUrl = $scodesterHttpQueryBuilder->getProjectDownloadingPageQuery($projectData->id);
   }

print_r($projectListAllArray);
*/

// ("64 Sleeper object works")
/*
$projectListAllArray = json_decode(file_get_contents(Constants::PROJECT_LIST_DATA_DEBUG_PATH . 'output-projectListAllArray.txt'));

$useTestDoubles = true;
$curlWrapperFactory = new CurlWrapperFactory($useTestDoubles);
//$curlWrapperFactory = new CurlWrapperFactory();

$requestPageCurlWrapper = $curlWrapperFactory->createRequestPageCurlWrapper();

$count = 0;

foreach($projectListAllArray as $projectsOnWebPageArray)
   foreach($projectsOnWebPageArray as $projectData)
   {
      $scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder('https://www.sourcecodester.com/');

      $downloadingPageUrl = $scodesterHttpQueryBuilder->getProjectDownloadingPageQuery($projectData->id);

      $response = $requestPageCurlWrapper->sendRequest($downloadingPageUrl);

      $projectDownloadingPageParser = new ProjectDownloadingPageParser($response);
      $projectData->ZippedSourcesUri = $projectDownloadingPageParser->getUriForZippedProjectSources();

      var_dump($projectData->ZippedSourcesUri);

      new \Framework\Sleeper();
   }

// print_r($projectListAllArray);
*/

// ("65 SleeperFactory works Add FactoryBase.php")   
/*
$projectListAllArray = json_decode(file_get_contents(Constants::PROJECT_LIST_DATA_DEBUG_PATH . 'output-projectListAllArray.txt'));

$useTestDoubles = true;
//$useTestDoubles = false;
$curlWrapperFactory = new CurlWrapperFactory($useTestDoubles);
$sleeperFactory = new SleeperFactory($useTestDoubles);

$requestPageCurlWrapper = $curlWrapperFactory->createRequestPageCurlWrapper();

$count = 0;

foreach($projectListAllArray as $projectsOnWebPageArray)
   foreach($projectsOnWebPageArray as $projectData)
   {
      $scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder('https://www.sourcecodester.com/');

      $downloadingPageUrl = $scodesterHttpQueryBuilder->getProjectDownloadingPageQuery($projectData->id);

      $response = $requestPageCurlWrapper->sendRequest($downloadingPageUrl);
      print "downloadingPageUrl: $downloadingPageUrl\n";

      $projectDownloadingPageParser = new ProjectDownloadingPageParser($response);
      $projectData->ZippedSourcesUri = $projectDownloadingPageParser->getUriForZippedProjectSources();

      var_dump($projectData->ZippedSourcesUri);

      $sleeperFactory->createSleeper(1,3);
      // $sleeperFactory->createSleeper(0,0);
   }

// print_r($projectListAllArray);
*/
$projectListAllArray = json_decode(file_get_contents(Constants::PROJECT_LIST_DATA_DEBUG_PATH . 'output-projectListAllArray.txt'));

// $useTestDoubles = true;
$useTestDoubles = false;
$curlWrapperFactory = new CurlWrapperFactory($useTestDoubles);
$sleeperFactory = new SleeperFactory($useTestDoubles);

$requestPageCurlWrapper = $curlWrapperFactory->createRequestPageCurlWrapper();

$count = 0;
foreach($projectListAllArray as $projectsOnWebPageArray)
   foreach($projectsOnWebPageArray as $projectData)
   {
      $scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder('https://www.sourcecodester.com/');

      $downloadingPageUrl = $scodesterHttpQueryBuilder->getProjectDownloadingPageQuery($projectData->id);

      $response = $requestPageCurlWrapper->sendRequest($downloadingPageUrl);

      $projectDownloadingPageParser = new ProjectDownloadingPageParser($response);
      $zippedSourcesUri = $projectDownloadingPageParser->getUriForZippedProjectSources();

      $downloadFileCurlWrapper = $curlWrapperFactory->createDownloadFileCurlWrapper(Constants::DOWNLOADS_PATH);

      $fileUrlToDownload = 'https://www.sourcecodester.com' . $zippedSourcesUri;
      $downloadFileCurlWrapper->downloadFile(
         $fileUrlToDownload,
         $projectData->id . '.zip'
      );

      print "Downloading... [$fileUrlToDownload]" . PHP_EOL;

      $sleeperFactory->createSleeper(1,5);

      if (++$count === 2)
         die;
   }
