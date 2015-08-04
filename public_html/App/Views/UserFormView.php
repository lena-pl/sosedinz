<?php

namespace App\Views;

class UserFormView extends TemplateView
{
    public function render()
    {
        extract($this->data);
        $page = "account.edit";
        $page_title = "Edit Account";
        include "templates/int-master.inc.php";
    }

    protected function content()
    {
        extract($this->data);
        include "templates/editaccount.inc.php";
    }
}
