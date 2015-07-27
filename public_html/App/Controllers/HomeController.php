<?php

namespace App\Controllers;

use \App\Views\HomeView;

class HomeController extends Controller
{

    public function show()
    {
        $view = new HomeView();
        $view->render();
    }
}
