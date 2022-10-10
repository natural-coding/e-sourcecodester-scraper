<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\DownloadFileCurlWrapper;
use App\ProjectListWebPageParser;
use App\Constants;
use App\ScodesterHttpQueryBuilder;


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

$scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder('https://www.sourcecodester.com/');
for($i=0; $i<3; ++$i)
   print $scodesterHttpQueryBuilder->getProjectListWebPageQuery($i) . PHP_EOL;
