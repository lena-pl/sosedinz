<?php

namespace App\Views;

class SiteMapView extends TemplateView
{

    public function render()
    {
        if(static::$auth->check()) {
            extract($this->data);
        }
        $page_title = "Site Map";
        $page="site.map";
        include "templates/int-master.inc.php";
    }

    protected function content()
    {
        if(static::$auth->check()) {
            extract($this->data);
        }
        include "templates/sitemap.inc.php";
    }
}
