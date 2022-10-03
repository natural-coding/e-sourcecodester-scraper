<?php

use App\ProjectListScraper;
use App\ProjectSourcesDownloader;
use App\FileDownloaderCurlWrapper;

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

$ch = curl_init();

$fileDownloaderCurlWrapper = new FileDownloaderCurlWrapper($ch);
$fileDownloaderCurlWrapper->DownloadFile(
   'https://www.sourcecodester.com/sites/default/files/download/pushpam02/MyGym.zip',
   'MyGym.zip'
);

curl_close($ch);