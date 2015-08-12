<?php

namespace App\Controllers;

use \App\Views\DashView;
use \App\Views\UserFormView;

use \App\Models\Post;
use \App\Models\User;

use App\Models\Exceptions\ModelNotFoundException;

class AccountController extends Controller
{

    public function show()
    {

        if (!isset($_GET['id']) || $_GET['id'] <= 0) {
            header("Location: ./?page=dash&id=" . static::$auth->user()->id);
            exit();
        } 

        if (!User::findBy("id", $_GET['id'])){
            throw new ModelNotFoundException();
        }

        $p = isset($_GET['p']) ? (int)$_GET['p'] : 1;
        $pageSize = 6;
        $posts = Post::allBy("user_id", $_GET['id'], "title", true, $pageSize, $p);

        $user = User::findBy("id", $_GET['id']);

        $recordCount = count($posts);

        $view = new DashView(compact('posts', 'user', 'pageSize', 'p', 'recordCount'));
        $view->render();

    }

    public function edit()
    {
        $user = $this->getUserFormData(static::$auth->user()->id);
        $error = isset($_GET['error']) ? $_GET['error'] : null;

        $view = new UserFormView(compact('user', 'error'));
        $view->render();
    }

    public function update()
    {

        $input = $_POST;
        $input['id'] = static::$auth->user()->id;

        $user = new User($input);
        $user->processArray($input);


        if (! $user->isValid()) {
            $_SESSION['user.form'] = $user;

            header("Location: ./?page=account.edit&id=" . $_POST['id']);
            exit();
        }

        if ($_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $user->saveAvatar($_FILES['avatar']['tmp_name']);
        } else if (isset($_POST['remove-image']) && $_POST['remove-image'] === "TRUE") {
            $user->avatar = null;
        }

        $user->save();

        header("Location: ./?page=dash&id=" . static::$auth->user()->id);

    }

    private function getUserFormData($id)
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
