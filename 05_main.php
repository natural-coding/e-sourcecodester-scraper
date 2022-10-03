<?php

use App\ProjectListScraper;
use App\ProjectSourcesDownloader;

spl_autoload_register();

$projectListScraper =  new ProjectListScraper();
$projectSourcesDownloader = new ProjectSourcesDownloader();