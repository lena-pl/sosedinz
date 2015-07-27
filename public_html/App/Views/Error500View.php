<?php

namespace App\Views;

class Error500View extends TemplateView
{

    public function render()
    {
        $page_title = "500 Internal Error";
        $page="error500";
        include "templates/master.inc.php";
    }

    protected function content()
    {
        extract($this->data);
        include "templates/error500.inc.php";
    }
}
