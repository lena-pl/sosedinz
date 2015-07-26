<?php

namespace App\Views;

class HomeView extends TemplateView
{

    public function render()
    {
        extract($this->data);
        $page_title = "";
        $page="index";
        include "templates/master.inc.php";
    }

    protected function content()
    {
            extract($this->data);
            include "templates/index.inc.php";
    }
}
