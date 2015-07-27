<?php

date_default_timezone_set("Pacific/Auckland");

error_reporting(E_ALL);

if (stristr($_SERVER['HTTP_HOST'], ".yoobee.net.nz")) {
    define("DEV_ENVIRONMENT", false);
    // production environment
    ini_set('display_errors', true);
    ini_set("log_errors", 1);
    ini_set("error_log", getcwd() . "/php-error.log");

    define("MAILGUN_KEY", '');
    define("MAILGUN_DOMAIN", '');

    define("DB_HOST", '');
    define("DB_NAME", '');
    define("DB_USER", '');
    define("DB_PASS", '');
} else {
    define("DEV_ENVIRONMENT", true);
    // local developer environment
    ini_set('display_errors', true);
    ini_set("log_errors", 1);
    ini_set("error_log", getcwd() . "/php-error.log");

    define("MAILGUN_KEY", '');
    define("MAILGUN_DOMAIN", '');

    define("DB_HOST", '');
    define("DB_NAME", '');
    define("DB_USER", '');
    define("DB_PASS", '');
}
