<?php

use App\Controllers\HomeController;
use App\Controllers\ErrorController;

use App\Models\Exceptions\ModelNotFoundException;

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

try {

    switch ($page) {
        case "home":

            $controller = new HomeController();
            $controller->show();

            break;

// ---------------------------------------------
        // case "login":

        //     $controller = new AuthenticationController();
        //     $controller->login();

        //     break;

// ---------------------------------------------

		default:
			throw new ModelNotFoundException();

			break;
    }
} catch (ModelNotFoundException $e) {

    $controller = new ErrorController;
    $controller->error404();

} catch (InsufficientPrivilegesException $e) {

    $controller = new ErrorController;
    $controller->error401($e);

} catch (Exception $e) {

  $controller = new ErrorController;
  $controller->error500($e);

}