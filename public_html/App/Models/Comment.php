<?php

namespace App\Models;

class Comment extends DatabaseModel
{

    protected static $columns = ['id', 'user_id', 'post_id', 'created', 'comment'];

    protected static $tableName = "comments";

    protected static $validationRules = [
        'post_id'    => 'numeric,exists:\App\Models\Post',
        'user_id'     => 'numeric,exists:\App\Models\User',
        'comment'     => 'minlength:10,maxlength:16000',
    ];

    public function user()
    {
        return new User($this->user_id);
    }

    public function post()
    {
        return new Post($this->post_id);
    }
}
