<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Config;
use App\Constants;

new Config(Constants::CONFIG_PATH . 'app-config.yaml');