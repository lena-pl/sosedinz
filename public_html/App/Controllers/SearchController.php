<?php

namespace App\Controllers;

use App\Views\SearchResultsView;
use App\Models\Post;

class SearchController extends Controller
{
    function search()
    {
        if (! isset($_GET['q'])) {
            $q = "";
        } else {
            $q = $_GET['q'];
        }

        $posts = Post::search($q);

        $view = new SearchResultsView(compact('posts'));
        $view->render();
    }
}