<?php

namespace App\Controllers;

class Controller
{

    protected static $auth;

    public static function registerAuthenticationService($auth)
    {
        self::$auth = $auth;
    }

}
