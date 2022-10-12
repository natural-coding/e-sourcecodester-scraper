<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Constants;
use App\ScodesterHttpQueryBuilder;
use App\RequestPageCurlWrapper;
use App\ProjectListWebPageParser;
use App\DownloadFileCurlWrapper;
use App\Factories\CurlWrapperFactory;

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