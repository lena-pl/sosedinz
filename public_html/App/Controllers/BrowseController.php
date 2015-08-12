<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use \App\Views\BrowseView;

class BrowseController extends Controller
{

    public function browse()
    {
        $posts = Post::all("created", false );

    	$view = new BrowseView(compact('posts'));
    	$view->render();
    }
}