<?php

namespace App\Views;

class CommentFormView extends TemplateView
{

    public function render()
    {
        extract($this->data);
        $verb = ( $comment->id? "Edit" : "Add" );
        $page_title = "Edit Comment";
        $page="comment.form";
        include "templates/int-master.inc.php";
    }

    protected function content()
    {
            extract($this->data);
            include "templates/commentform.inc.php";
    }
}