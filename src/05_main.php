<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Constants;
use App\ScodesterHttpQueryBuilder;
use App\RequestPageCurlWrapper;
use App\ProjectListWebPageParser;
use App\DownloadFileCurlWrapper;
use App\Factories\CurlWrapperFactory;

// ("34 rename ProjectListPageParser.php to ProjectListWebPageParser.php")
/*
$projectListWebPageHtml = file_get_contents(Constants::PROJECT_LIST_DATA_DEBUG_PATH . 'example-ProjectList-page0.html');

$projectListWebPageParser = new ProjectListWebPageParser($projectListWebPageHtml);
print_r($projectListWebPageParser->GetProjectListJsonArray());
*/

// ("38 Use Composer for case sensitive autoloading")
/*
$scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder('https://www.sourcecodester.com/');
print $scodesterHttpQueryBuilder->getDownloadQuery();
print $scodesterHttpQueryBuilder->getProjectListQuery();
*/

// ("39 getProjectListWebPageQuery test output")
/*
$scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder('https://www.sourcecodester.com/');
for($i=0; $i<3; ++$i)
   print $scodesterHttpQueryBuilder->getProjectListWebPageQuery($i) . PHP_EOL;
*/

// ("40 Getting project list stub")
/*
$projectListAllArray = [];

for($i=0; $i<3; ++$i)
{
   $scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder('https://www.sourcecodester.com/');
   $url = $scodesterHttpQueryBuilder->getProjectListWebPageQuery($i);

   $requestPageCurlWrapper = new RequestPageCurlWrapper();
   $response = $requestPageCurlWrapper->sendRequest($url);

   $projectListWebPageParser = new ProjectListWebPageParser($response);
   $projectListArray = $projectListWebPageParser->getProjectListJsonArray();

   $projectListAllArray = array_merge($projectListAllArray,$projectListArray);
}

print_r($projectListAllArray);
*/

// ("46 requestPage works")
/*
$curlWrapperFactory = new CurlWrapperFactory();
$requestPageCurlWrapper = $curlWrapperFactory->createRequestPageCurlWrapper();

$response = $requestPageCurlWrapper->sendRequest('https://www.sourcecodester.com/php?page=1');

var_dump($response);
*/

// ("48 CurlWrapperFactory able to return TestDoubles")
/**
 * Let's violate something ;-)
 */
/*
$methodsThatReturnTestDouble = ['createRequestPageCurlWrapper'];
//$methodsThatReturnTestDouble = [];
$curlWrapperFactory = new CurlWrapperFactory($methodsThatReturnTestDouble);

$requestPageCurlWrapper = $curlWrapperFactory->createRequestPageCurlWrapper();
$response = $requestPageCurlWrapper->sendRequest('https://www.sourcecodester.com/php?page=1');

print substr($response,0,130);
*/

//$methodsThatReturnTestDouble = ['createRequestPageCurlWrapper'];
$methodsThatReturnTestDouble = [];
$curlWrapperFactory = new CurlWrapperFactory($methodsThatReturnTestDouble);

$requestPageCurlWrapper = $curlWrapperFactory->createRequestPageCurlWrapper();

$projectListAllArray = [];

for($pageNumQueryParam = 10; $pageNumQueryParam < 12; ++$pageNumQueryParam)
{
   $scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder('https://www.sourcecodester.com/');
   $url = $scodesterHttpQueryBuilder->getProjectListWebPageQuery($pageNumQueryParam);

   $response = $requestPageCurlWrapper->sendRequest($url);

   $projectListWebPageParser = new ProjectListWebPageParser($response);
   $projectListArray = $projectListWebPageParser->getProjectListJsonArray();

   $projectListAllArray = array_merge($projectListAllArray,$projectListArray);

   $randomAmountOfSeconds = random_int(3,7);
   // $randomAmountOfSeconds = 0;
   print $randomAmountOfSeconds . PHP_EOL;
   sleep($randomAmountOfSeconds);
}

print_r($projectListAllArray);
