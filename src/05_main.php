<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Config;
use App\Constants;

// ("73 read config from file")
/*
new Config(Constants::CONFIG_PATH . 'app-config.yaml');
*/

$config = new Config(Constants::CONFIG_PATH . 'app-config.json');
var_dump($config->getJson());