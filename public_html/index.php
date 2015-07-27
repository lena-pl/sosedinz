<?php

require "../sosedinz-config.inc.php";
require "vendor/autoload.php";

session_start();
session_regenerate_id(true);

$auth = new App\Services\AuthenticationService();

App\Views\View::registerAuthenticationService($auth);
App\Controllers\Controller::registerAuthenticationService($auth);


require "routes.php";
