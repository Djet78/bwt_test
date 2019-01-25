<?php
/**
 * @var bool  Used for develop purposes. Not recommended set it to true in production!
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

/**
 * @var string  Google reCaptcha public key
 */
const CAPTCHA_PUB_KEY = '6LfZdYwUAAAAAIuYpmgoas-l7KfUVIWobyt6UyFg';

/**
 * @var string  Google reCaptcha secret key
 */
const CAPTCHA_SEC_KEY = '6LfZdYwUAAAAAA6KUwe78fJvoYoOj6LQtyci4YVx';

/**
 * @var int  Specify time in seconds
 */
const PARSER_SLEEP_TIME = 60*60;  // 1 hour
