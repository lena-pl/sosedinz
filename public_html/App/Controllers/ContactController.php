<?php

namespace App\Controllers;

use \App\Views\VisitorEmailView;
use \App\Views\HostEmailView;
use \App\Views\EmailSuccessView;
use \App\Views\ContactFormView;

class ContactController extends Controller
{

    private $contact = [];

    public function __construct()
    {
        $this->contact = [
            'errors' => []
        ];
    }

    private function resetSessionFormData()
    {
        $_SESSION['contact'] = null;
    }

    private function getFormData()
    {
        $expectedVariables = ['title', 'email', 'message'];

        foreach ($expectedVariables as $variable) {
            // assume no errors
            $this->contact['errors'][$variable] = "";

            if (isset($_POST[$variable])) {
                $this->contact[$variable] = $_POST[$variable];
            } else {
                $this->contact[$variable] = "";
            }
        }
    }

    private function isFormDataValid()
    {
        $valid = true;

        if (strlen($this->contact['title']) == 0) {
            $this->contact['errors']['title'] = "A subject is required.";
            $valid = false;
        }
        if (! filter_var($this->contact['email'], FILTER_VALIDATE_EMAIL)) {
            $this->contact['errors']['email'] = "A valid email address required.";
            $valid = false;
        }
        return $valid;
    }

    public function show()
    {

        $contactform = $this->getContactFormData();

        $this->resetSessionFormData();


        // validate suggestion data

        $view = new ContactFormView(compact('contactform'));
        $view->render();
    }

    public function send()
    {
        // capture suggestion data
        $this->getFormData();

        $contactform = $this->contact;

        // send email to suggester
        $visitorEmail = new VisitorEmailView($contactform);

        // send email to event host
        $hostEmail = new HostEmailView($contactform);

        // form is valid, redirect user to success page
        $view = new EmailSuccessView();
        $view->render();

        $hostEmail->render();
        $visitorEmail->render();
    }

    private function getContactFormData()
    {
        if (isset($_SESSION['contactform'])) {
            $contactform = $_SESSION['contactform'];
        } else {
            $contactform = [
                'title' => "",
                'email' => "",
                'message' => "",
                'errors' => [
                    'title' => "",
                    'email'=> "",
                    'message' => ""
                ]
            ];
        }
        return $contactform;
    }
}
