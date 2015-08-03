<?php

namespace App\Controllers;

use \App\Views\HomeView;

use \App\Models\User;

class HomeController extends Controller
{

    public function show()
    {
    	$user = $this->getUserFormData();
    	$error = isset($_GET['error']) ? $_GET['error'] : null;

        $view = new HomeView(compact('user', 'error'));
        // $view->render();

        if (static::$auth->check()):
            //do this if user is logged in
            header("Location: ./?page=dash");
            exit();
        else:
            $view->render();
        endif;
    }

    private function getUserFormData($id = null)
    {
        if (isset($_SESSION['user.form'])) {
            $user = $_SESSION['user.form'];
            unset($_SESSION['user.form']);
        } else {
            $user = new User($id);
        }
        return $user;
    }
}
