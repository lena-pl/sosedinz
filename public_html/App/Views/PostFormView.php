<?php

namespace App\Views;

class PostFormView extends TemplateView
{

    public function render()
    {
        extract($this->data);
        $verb = ( $post->id? "Edit" : "Add" );
        $page_title = $verb . " Post";
        $page="post.form";
        include "templates/int-master.inc.php";
    }

    protected function content()
    {
            extract($this->data);
            include "templates/postform.inc.php";
    }
}