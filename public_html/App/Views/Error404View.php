<?php

namespace App\Views;

class Error404View extends TemplateView
{

    public function render()
    {
        $page_title = "404 Page Not Found";
        $page="error404";
        include "templates/int-master.inc.php";
    }

    protected function content()
    {
        include "templates/error404.inc.php";
    }
}
