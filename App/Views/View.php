<?php

namespace App\Views;

use App\Services\AuthenticationService;

abstract class View
{

    protected $data;

    protected static $auth;

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    abstract public function render();

    public static function registerAuthenticationService($auth)
    {
        self::$auth = $auth;
    }

}
