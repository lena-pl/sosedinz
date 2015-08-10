<?php

use App\Controllers\HomeController;
use App\Controllers\SearchController;

use App\Controllers\ContactController;

use App\Controllers\AccountController;
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

        case "search":
            
            $controller = new SearchController();
            $controller->search();
            
            break;

// ---------------------------------------------
        case "contact":
            
            $controller = new ContactController();
            $controller->show();
            
            break;

        case "send.message":
            
            $controller = new ContactController();
            $controller->send();
            
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

            $controller = new AccountController();
            $controller->show();

            break;

        case "account.edit":

            $controller = new AccountController();
            $controller->edit();

            break;

        case "account.update":

            $controller = new AccountController();
            $controller->update();

            break;

        case "account.destroy";

            $controller = new AccountController();
            $controller->destroy();

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

// ---------------------------------------------

// ---------------------------------------------

        case "comment.create";

            $controller = new CommentsController();
            $controller->create();

            break;

        case "comment.edit";

            $controller = new CommentsController();
            $controller->edit();

            break;

        case "comment.update";

            $controller = new CommentsController();
            $controller->update();

            break;

        case "comment.destroy";

            $controller = new CommentsController();
            $controller->destroy();

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