<?php

namespace App\Controllers;

use \App\Views\DashView;
use \App\Models\Post;

class DashController extends Controller
{

    public function index()
    {
    	$p = isset($_GET['p']) ? (int)$_GET['p'] : 1;
        $pageSize = 25;
        $posts = Post::all("title", true, $pageSize, $p);

        $recordCount = Post::count();

        $view = new DashView(compact('posts', 'pageSize', 'p', 'recordCount'));

        if (!static::$auth->check()):
            //do this if user is logged in
            header("Location: ./?page=home");
            exit();
        else:
            $view->render();
        endif;
    }
}
