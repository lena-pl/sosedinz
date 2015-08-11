<?php

namespace App\Views;

class CommunityRulesView extends TemplateView
{

    public function render()
    {
        $page_title = "Community Rules";
        $page="community";
        include "templates/int-master.inc.php";
    }

    protected function content()
    {
            include "templates/communityrules.inc.php";
    }
}
