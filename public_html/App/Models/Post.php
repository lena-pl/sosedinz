<?php

namespace App\Models;
use PDO;
use finfo;

class Post extends DatabaseModel
{

    protected static $columns = ['id', 'user_id', 'title', 'content', 'feature_img', 'created'];

    protected static $fakeColumns = ['tags'];

    protected static $tableName = "posts";

    protected static $validationRules = [
    	'title' 	  => 'minlength:1',
        'user_id'     => 'numeric,exists:\App\Models\User',
    	'content' 		  => 'minlength:140'
    ];

    public function comments()
    {
        return Comment::allBy('post_id', $this->id);
    }

    public function getTags()
    {
        $models = [];

        $db = static::getDatabaseConnection();

        $query  = "SELECT id, tag FROM tags ";
        $query .= " JOIN posts_tags ON id = tag_id ";
        $query .= " WHERE post_id = :id";

        $statement = $db->prepare($query);
        $statement->bindValue(":id", $this->id);
        $statement->execute();

        while ($record = $statement->fetch(PDO::FETCH_ASSOC)) {
            $model = new Tag();
            $model->data = $record;
            array_push($models, $model);
        }

        return $models;
    }

    public function loadTags()
    {
        $tags = $this->getTags();
        $taglist = [];
        foreach ($tags as $tag) {
            array_push($taglist, $tag->tag);
        }
        $this->tags = implode($taglist, ",");
    }

    public function saveTags()
    {
        // take the string from the tags property
        // explode it into an array
        $tags = explode(",",$this->tags);
        foreach ($tags as &$tag) {
            $tag = strtolower(trim($tag));
        }

        $db = static::getDatabaseConnection();

        $db->beginTransaction();

        try {

            $this->addNewTags($db, $tags);
            $tagIds = $this->getTagIds($db, $tags);
            $this->deleteAllTagsFromPost($db);
            $this->insertTagsForPost($db, $tagIds);

            $db->commit();

        } catch (Exception $e) {
            $db->rollBack();
            throw $e;
        }

    }

    private function addNewTags($db, $tags)
    {
        // insert each tag into the tags table (ignore dupes)
        $query = "INSERT IGNORE INTO tags (tag) VALUES ";

        $tagvalues = [];
        for ($i = 0; $i < count($tags); $i += 1) {
            array_push($tagvalues, "(:tag{$i})");
        }
        $query .= implode(",", $tagvalues);

        $statement = $db->prepare($query);
        for ($i = 0; $i < count($tags); $i += 1) {
            $statement->bindValue(":tag{$i}", $tags[$i]);
        }

        $statement->execute();
    }

    private function getTagIds($db, $tags)
    {

        // get the ids for each tag
        $query = "SELECT id FROM tags WHERE ";
        $tagvalues = [];
        for ($i = 0; $i < count($tags); $i += 1) {
            array_push($tagvalues, " tag = :tag{$i}");
        }
        $query .= implode(" OR ", $tagvalues);

        $statement = $db->prepare($query);
        for ($i = 0; $i < count($tags); $i += 1) {
            $statement->bindValue(":tag{$i}", $tags[$i]);
        }

        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_COLUMN);
    }

    private function deleteAllTagsFromPost($db)
    {
        // delete all existing relationships between this movie and all tags

        $query = "DELETE FROM posts_tags WHERE post_id = :post_id";
        $statement = $db->prepare($query);
        $statement->bindValue(':post_id', $this->id);
        $statement->execute();
    }

    private function insertTagsForPost($db, $tagIds)
    {
        // insert all relationships (ignore dupes)

        $query = "INSERT IGNORE INTO posts_tags (post_id, tag_id) VALUES ";

        $tagvalues = [];
        for ($i = 0; $i < count($tagIds); $i += 1) {
            array_push($tagvalues, "(:post_id_{$i}, :tag_id_{$i})");
        }
        $query .= implode(",", $tagvalues);

        $statement = $db->prepare($query);
        for ($i = 0; $i < count($tagIds); $i += 1) {
            $statement->bindValue(":post_id_{$i}", $this->id);
            $statement->bindValue(":tag_id_{$i}", $tagIds[$i]);
        }

        $statement->execute();
    }

}
