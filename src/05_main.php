<?php

use App\DownloadFileCurlWrapper;
use App\ProjectListWebPageParser;
use App\Constants;
use App\ScodesterHttpQueryBuilder;

spl_autoload_register();

set_include_path(get_include_path() . PATH_SEPARATOR . Constants::FRAMEWORK_PATH);

// ("34 rename ProjectListPageParser.php to ProjectListWebPageParser.php")
/*
$projectListWebPageHtml = file_get_contents(Constants::PROJECT_LIST_DATA_DEBUG_PATH . 'example-ProjectList-page0.html');
$projectListWebPageParser = new ProjectListWebPageParser($projectListWebPageHtml);
print_r($projectListWebPageParser->GetProjectListJsonArray());
*/


$scodesterHttpQueryBuilder = new ScodesterHttpQueryBuilder('https://www.sourcecodester.com/');

print $scodesterHttpQueryBuilder->getDownloadQuery();
print $scodesterHttpQueryBuilder->getProjectListQuery();