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

        $p = isset($_GET['p']) ? (int)$_GET['p'] : 1;
        $pageSize = 5;

        $recordCount = Post::count();

        $posts = Post::search($q);

        $view = new SearchResultsView(compact('posts', 'pageSize', 'p', 'recordCount'));
        $view->render();
    }
}