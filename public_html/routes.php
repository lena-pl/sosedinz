<?php

use App\Controllers\HomeController;
use App\Controllers\DashController;
use App\Controllers\PostsController;
use App\Controllers\CommentsController;
use App\Controllers\AuthenticationController;
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
        case "login":

            $controller = new AuthenticationController();
            $controller->login();

            break;

        case "auth.attempt":

            $controller = new AuthenticationController();
            $controller->attempt();

            break;

        case "register":

            $controller = new AuthenticationController();
            $controller->register();

            break;

        case "auth.store":

            $controller = new AuthenticationController();
            $controller->store();

            break;

        case "logout":

            $controller = new AuthenticationController();
            $controller->logout();

        break;
// ---------------------------------------------
        case "dash":

            $controller = new DashController();
            $controller->index();

            break;

// ---------------------------------------------

        case "post";

            $controller = new PostsController();
            $controller->show();

            break;

        case "post.create";

            $controller = new PostsController();
            $controller->create();

            break;

        case "post.store";

            $controller = new PostsController();
            $controller->store();

            break;

        case "post.edit";

            $controller = new PostsController();
            $controller->edit();

            break;

        case "post.update";

            $controller = new PostsController();
            $controller->update();

            break;

        case "post.destroy";

            $controller = new PostsController();
            $controller->destroy();

            break;

        case "comment.create";

            $controller = new CommentsController();
            $controller->create();

            break;

// ---------------------------------------------

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