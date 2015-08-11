<?php

namespace App\Controllers;

use App\Views\CommunityRulesView;
use App\Views\SiteMapView;

use App\Models\Post;

class FooterController extends Controller
{
    public function rules()
    {
        $view = new CommunityRulesView();
        $view->render();
    }

    public function map()
    {
        if (static::$auth->check()) {
            $user = static::$auth->user()->id;
        } else {
            $user = null;
        }
        $posts = Post::allBy("user_id", $user, "title", true);

        $view = new SiteMapView(compact('user', 'posts'));
        $view->render();
    }
}