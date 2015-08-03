<?php

namespace App\Controllers;

use \App\Views\DashView;
use \App\Models\Post;
use \App\Models\User;

class DashController extends Controller
{

    public function show()
    {
        if (! static::$auth->check()) {
            //do this if user is logged in
            header("Location: ./?page=home");
            exit();
        } 
        if (!isset($_GET['id']) || $_GET['id'] <= 0) {
            header("Location: ./?page=dash&id=" . static::$auth->user()->id);
            exit();
        }

        $p = isset($_GET['p']) ? (int)$_GET['p'] : 1;
        $pageSize = 25;
        $posts = Post::allBy("user_id", $_GET['id'], "title", true, $pageSize, $p);

        $recordCount = Post::count();

        $view = new DashView(compact('posts', 'pageSize', 'p', 'recordCount'));
        $view->render();

    }
}
