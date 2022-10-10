<?php

use App\DownloadFileCurlWrapper;
use App\ProjectListWebPageParser;
use App\Constants;

spl_autoload_register();

// ("34 rename ProjectListPageParser.php to ProjectListWebPageParser.php")

$projectListWebPageHtml = file_get_contents(Constants::PROJECT_LIST_DATA_DEBUG_PATH . 'example-ProjectList-page0.html');
$projectListWebPageParser = new ProjectListWebPageParser($projectListWebPageHtml);
print_r($projectListWebPageParser->GetProjectListJsonArray());


