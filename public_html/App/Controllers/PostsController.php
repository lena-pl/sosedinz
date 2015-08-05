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

        if ($_FILES['feature_img']['error'] === UPLOAD_ERR_OK) {
            $post->saveFeatureImage($_FILES['feature_img']['tmp_name']);
        }

        $post->save();
        $post->saveTags();

        header("Location: ./?page=post&id=" . $post->id);
    }

    public function edit()
    {
        $post = $this->getPostFormData($_GET['id']);
        $post->loadTags();
        static::$auth->mustBeOwner($post->user_id);

        $view = new PostFormView(compact('post', 'tags'));
        $view->render();
    }

    public function update()
    {
        $post = new Post($_POST['id']);
        $post->processArray($_POST);

        static::$auth->mustBeOwner($post->user_id);

        if (is_array($post->tags)) {
            $post->tags = implode($post->tags, ",");
        }

        if (! $post->isValid()) {
            $_SESSION['post.form'] = $post;

            header("Location: ./?page=post.edit&id=" . $_POST['id']);
            exit();
        }

        if ($_FILES['feature_img']['error'] === UPLOAD_ERR_OK) {
            $post->saveFeatureImage($_FILES['feature_img']['tmp_name']);
        } else if (isset($_POST['remove-image']) && $_POST['remove-image'] === "TRUE") {
            $post->feature = null;
        }

        $post->save();
        $post->saveTags();

        header("Location: ./?page=post&id=" . $post->id);

    }

    public function destroy()
    {
        $post = new Post($_POST['id']);
        static::$auth->mustBeOwner($post->user_id);

        Post::destroy($_POST['id']);

        header("Location: ./?page=dash");
    }

    // FORMS

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
