<?php

namespace App;

class Constants
{
   const ROOT_PATH = __DIR__ . DIRECTORY_SEPARATOR  . '..' . DIRECTORY_SEPARATOR;
   const APP_PATH = self::ROOT_PATH . 'App' . DIRECTORY_SEPARATOR;
   const CONFIG_PATH = self::APP_PATH . 'Config' . DIRECTORY_SEPARATOR;
   const DOWNLOADS_PATH = self::ROOT_PATH . 'Downloads' . DIRECTORY_SEPARATOR;

   const PROJECT_LIST_DATA_DEBUG_PATH = self::APP_PATH .  '_debug' . DIRECTORY_SEPARATOR;
}