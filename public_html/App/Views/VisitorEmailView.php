<?php

namespace App\Views;

class VisitorEmailView extends EmailView
{
    public function render()
    {
        $this->sendEmail("templates/visitoremail.inc.php");
    }
}
