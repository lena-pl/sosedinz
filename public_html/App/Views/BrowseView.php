<?php

namespace App\Views;

class BrowseView extends TemplateView
{

    public function render()
    {
        extract($this->data);
        $page_title = "Browse";
        $page="browse";
        include "templates/int-master.inc.php";
    }

    protected function content()
    {
        extract($this->data);
        include "templates/browse.inc.php";
    }
}
