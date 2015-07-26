<?php

namespace App\Views;

class Error401View extends TemplateView
{

    public function render()
    {
        $page_title = "401 Unauthorised";
        $page="error401";
        include "templates/master.inc.php";
    }

    protected function content()
    {
        include "templates/error401.inc.php";
    }
}
