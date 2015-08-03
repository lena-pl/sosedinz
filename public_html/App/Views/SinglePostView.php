<?php

namespace App\Views;

class SinglePostView extends TemplateView
{

    public function render()
    {
        extract($this->data);
        
        $page_title = $post->title;
        $page="post";
        include "templates/int-master.inc.php";
    }

    protected function content()
    {
            extract($this->data);
            include "templates/singlepost.inc.php";
    }
}
