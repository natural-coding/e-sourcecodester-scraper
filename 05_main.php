<?php

use App\ProjectListScraper;
use App\ProjectSourcesDownloader;
use App\DownloadFileCurlWrapper;
use App\ProjectListPageParser;
use App\Constants;

spl_autoload_register();

// ("15 ProjectListScraper ProjectSourcesDownloader stubs")
/*
use App\ProjectListScraper;
use App\ProjectSourcesDownloader;

spl_autoload_register();

$projectListScraper =  new ProjectListScraper();
$projectSourcesDownloader = new ProjectSourcesDownloader();
*/

// ("21 Add Id to project data")
/*
$projectListScraper =  new ProjectListScraper();

$projectListArray = $projectListScraper->GetProjectListArray();

print_r($projectListArray);
*/

// ("24 File download works")
/*
$ch = curl_init();

$fileDownloaderCurlWrapper = new FileDownloaderCurlWrapper($ch);
$fileDownloaderCurlWrapper->DownloadFile(
   'https://www.sourcecodester.com/sites/default/files/download/pushpam02/MyGym.zip',
   'MyGym.zip'
);

curl_close($ch);
*/

// ("26 rename to DownloadFileCurlWrapper.php")
/*
$ch = curl_init();

$downloadFileCurlWrapper = new DownloadFileCurlWrapper($ch);
$downloadFileCurlWrapper->downloadFile(
   'https://www.sourcecodester.com/sites/default/files/download/pushpam02/MyGym.zip',
   'MyGym.zip'
);

curl_close($ch);
*/

// ("27 Add interfaces and ProjectListPageParser.php")
/*
$ch = curl_init();

$downloadFileCurlWrapper = new DownloadFileCurlWrapper($ch);
$downloadFileCurlWrapper->downloadFile(
   'https://www.sourcecodester.com/sites/default/files/download/pushpam02/MyGym.zip',
   'MyGym.zip'
);

curl_close($ch);
*/

$projectListPageHtml = file_get_contents(Constants::PROJECT_LIST_DATA_DEBUG_PATH . 'example-ProjectList-page0.html');
$projectListPageParser = new ProjectListPageParser($projectListPageHtml);
print_r($projectListPageParser->GetProjectListJsonArray());
