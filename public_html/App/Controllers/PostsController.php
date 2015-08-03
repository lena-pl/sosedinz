<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Comment;
use \App\Views\SinglePostView;
use \App\Views\PostFormView;

class PostsController extends Controller
{

    public function show()
    {
    	$post      = new Post((int)$_GET['id']);
        $newcomment = $this->getCommentFormData();

        $comments = $post->comments();
        $tags     = $post->getTags();

    	$view = new SinglePostView(compact('post','comments','newcomment', 'tags'));
    	$view->render();
    }

    public function create()
    {
        $post = $this->getPostFormData();

        $view = new PostFormView(compact('post'));
        $view->render();
    }

    public function store()
    {

        $input = $_POST;
        $input['user_id'] = static::$auth->user()->id;
        $post = new Post($input);

        if (is_array($post->tags)) {
            $post->tags = implode($post->tags, ",");
        }

        if (! $post->isValid()) {
            $_SESSION['post.form'] = $post;

            header("Location: ./?page=post.create");
            exit();
        }

        if ($_FILES['feature']['error'] === UPLOAD_ERR_OK) {
            $post->saveFeatureImage($_FILES['feature']['tmp_name']);
        }

        $post->save();
        $post->saveTags();

        header("Location: ./?page=post&id=" . $post->id);
    }

    public function edit()
    {
        static::$auth->mustBeOwner();
        $post = $this->getPostFormData($_GET['id']);
        $post->loadTags();

        $view = new PostFormView(compact('post', 'tags'));
        $view->render();
    }

    public function update()
    {

        static::$auth->mustBeOwner();

        $post = new post($_POST['id']);
        $post->processArray($_POST);

        if (is_array($post->tags)) {
            $post->tags = implode($post->tags, ",");
        }

        if (! $post->isValid()) {
            $_SESSION['post.form'] = $post;

            header("Location: ./?page=post.edit&id=" . $_POST['id']);
            exit();
        }

        if ($_FILES['feature']['error'] === UPLOAD_ERR_OK) {
            $post->saveFeatureImage($_FILES['feature']['tmp_name']);
        } else if (isset($_POST['remove-image']) && $_POST['remove-image'] === "TRUE") {
            $post->feature = null;
        }

        $post->save();
        $post->saveTags();

        header("Location: ./?page=post&id=" . $post->id);

    }

    public function destroy()
    {
        static::$auth->mustBeOwner();

        post::destroy($_POST['id']);

        header("Location: ./?page=posts");
    }

    private function getPostFormData($id = null)
    {
        if (isset($_SESSION['post.form'])) {
            $post = $_SESSION['post.form'];
            unset($_SESSION['post.form']);
        } else {
            $post = new Post($id);
        }
        return $post;
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
