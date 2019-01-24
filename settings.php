<?php
/**
 * @var bool  Used for develop purposes. Not recommended set to true in production!
 */
const DEBUG = true;

/** 
 * @var array  PDO mysql connection settings
 */
const DB = [
    'host' => 'localhost',
    'dbname' => 'bwt',
    'user' => 'root',
    'password' => 'root',
];

/**
 * @var array  Defined apps ['app_name' => 'app_folder', 'app_name_2' => 'app_folder', ...]
 */
const APPS = [
    'weather' => 'weather_app',
];

const PARSER_SLEEP_TIME = 60*60;  // 1 hour
