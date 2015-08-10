<?php

namespace App\Views;

class EmailSuccessView extends TemplateView
{

    public function render()
    {
        extract($this->data);
        $page="contactsuccess";
        $page_title = "Success!";
        include "templates/int-master.inc.php";
    }

    protected function content()
    {
        extract($this->data);
        include "templates/success.inc.php";
    }
}
