<?php

namespace App\Views;

use Mailgun\Mailgun;

abstract class EmailView extends View
{
    // private $data;

    // public function __construct($data)
    // {
    // 	$this->data = $data;
    // }

    public function sendEmail($templateFile)
    {
        extract($this->data);

        # Instantiate the client.
        $mgClient = new Mailgun(MAILGUN_KEY);
        $domain = MAILGUN_DOMAIN;


        ob_start();
        include $templateFile;

        $emailBody = ob_get_clean();

        # Make the call to the client.
        $result = $mgClient->sendMessage($domain, array(
            'from'    => 'sosediNZ <mailgun@'. $domain .'>',
            'to'      => $emailHeaders['to'],
            'subject' => $emailHeaders['subject'],
            'text'    => $emailBody
        ));
    }
}
