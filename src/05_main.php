<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Constants;
use App\ScodesterHttpQueryBuilder;
use App\RequestPageCurlWrapper;
use App\ProjectListWebPageParser;
use App\DownloadFileCurlWrapper;
use App\Factories\CurlWrapperFactory;

// ("51 CurlWrapperFactory useTestDoubles method")
/*
$useTestDoubles = true;
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

print_r($projectListAllArray);
*/

// ("52 getProjectListWebPageQuery works using sprintf!")
/*
$scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder('https://www.sourcecodester.com/');
$url = $scodesterHttpQueryBuilder->getProjectListWebPageQuery(10);

print $url;
*/

$scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder('https://www.sourcecodester.com/');
$url = $scodesterHttpQueryBuilder->getDownloadQuery(15628);

print $url;