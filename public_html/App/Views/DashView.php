<?php

namespace App\Views;

class DashView extends TemplateView
{

    public function render()
    {
        extract($this->data);
        $page_title = "Dashboard";
        $page="dash";
        include "templates/int-master.inc.php";
    }

    protected function content()
    {
        extract($this->data);
        include "templates/dash.inc.php";
    }
}
