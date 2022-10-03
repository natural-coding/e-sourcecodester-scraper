<?php

use App\ProjectListScraper;
use App\ProjectSourcesDownloader;

spl_autoload_register();

// ("15 ProjectListScraper ProjectSourcesDownloader stubs")
/*
use App\ProjectListScraper;
use App\ProjectSourcesDownloader;

spl_autoload_register();

$projectListScraper =  new ProjectListScraper();
$projectSourcesDownloader = new ProjectSourcesDownloader();
*/

$projectListScraper =  new ProjectListScraper();

$projectListArray = $projectListScraper->GetProjectListArray();

print_r($projectListArray);