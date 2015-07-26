<?php

date_default_timezone_set("Pacific/Auckland");

error_reporting(E_ALL);

if (stristr($_SERVER['HTTP_HOST'], ".yoobee.net.nz")) {
    define("DEV_ENVIRONMENT", false);
    // production environment
    ini_set('display_errors', true);
    ini_set("log_errors", 1);
    ini_set("error_log", getcwd() . "/php-error.log");
} else {
    define("DEV_ENVIRONMENT", true);
    // local developer environment
    ini_set('display_errors', true);
    ini_set("log_errors", 1);
    ini_set("error_log", getcwd() . "/php-error.log");
}

require "vendor/autoload.php";

session_start();
session_regenerate_id(true);

$auth = new App\Services\AuthenticationService();

App\Views\View::registerAuthenticationService($auth);
App\Controllers\Controller::registerAuthenticationService($auth);


require "routes.php";
