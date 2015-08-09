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

    public function paginate($url, $p, $recordCount, $pageSize = 10, $maxContextLinks = 5)
    {
        $totalPages = ceil($recordCount / $pageSize);
        $previousPage = $p - 1;
        $nextPage = $p + 1;

        // calculate range of context links
        $low = $p - floor($maxContextLinks / 2);
        if ($low < 2) { $low = 2; }
        $high = $p + floor($maxContextLinks / 2);
        if ($high > $totalPages - 1) { $high = $totalPages - 1; }

        // if the low or high limit is hit, adjust context links to suit
        if ($low == 2) { $high = $maxContextLinks; }
        if ($high == $totalPages - 1) { $low = $totalPages - $maxContextLinks + 1; }

        // ensure the highs and lows don't exceed the number of pages
        if ($low < 2) { $low = 2; }
        if ($high > $totalPages - 1) { $high = $totalPages - 1; }

        include 'templates/pagination.inc.php';
    }

}
