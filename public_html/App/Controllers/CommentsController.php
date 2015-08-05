<?php

namespace App\Controllers;

use App\Models\Comment;
use \App\Views\CommentFormView;

class CommentsController extends Controller
{
    public function create()
    {
        $input = $_POST;
        $input['user_id'] = static::$auth->user()->id;

        $newcomment = new Comment($input);

        if (! $newcomment->isValid()) {
            $_SESSION['comment.form'] = $newcomment;
            header("Location: ./?page=post&id=" . $newcomment->post_id);
            exit();
        }

        $newcomment->save();
        header("Location: ./?page=post&id=" . $newcomment->post_id . "#comment-" . $newcomment->id);
    }


    public function edit()
    {
        $comment = $this->getCommentFormData($_GET['id']);
        static::$auth->mustBeOwner($comment->user_id);

        $view = new CommentFormView(compact('comment'));
        $view->render();
    }

    public function update()
    {
        $comment = new Comment($_POST['id']);
        $comment->processArray($_POST);

        static::$auth->mustBeOwner($comment->user_id);

        if (! $comment->isValid()) {
            $_SESSION['comment.form'] = $comment;

            header("Location: ./?page=comment.edit&id=" . $_GET['id']);
            exit();
        }

        $comment->save();

        header("Location: ./?page=post&id=" . $comment->post_id);

    }

    public function destroy()
    {
        $comment = new Comment($_POST['id']);
        static::$auth->mustBeOwner($comment->user_id);

        Comment::destroy($_POST['id']);

        header("Location: ./?page=post&id=" . $comment->post_id);
    }

    private function getCommentFormData($id = null)
    {
        if (isset($_SESSION['comment.form'])) {
            $comment = $_SESSION['comment.form'];
            unset($_SESSION['comment.form']);
        } else {
            $comment = new Comment($id);
        }
        return $comment;
    }
}
