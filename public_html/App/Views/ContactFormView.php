<?php

namespace App\Views;

class ContactFormView extends TemplateView
{

    public function render()
    {
        extract($this->data);
        $page_title = "Contact Us";
        $page="contact";
        include "templates/int-master.inc.php";
    }

    protected function content()
    {
            extract($this->data);
            include "templates/contactform.inc.php";
    }
}