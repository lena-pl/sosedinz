<?php

namespace App\Models;

use Intervention\Image\ImageManagerStatic as Image;
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
    	'content' 	  => 'minlength:140'
    ];

    public function user()
    {
        return new User($this->user_id);
    }

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
        $this->tags = implode($taglist, ", ");
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

    public function saveFeatureImage($filename)
    {
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($filename);

        $extensions = [
            'image/jpg'  => '.jpg',
            'image/jpeg' => '.jpg',
            'image/png'  => '.png',
            'image/gif'  => '.gif'
        ];

        $extension = '.jpg';
        if (isset($extensions[$mime])) {
            $extension = $extensions[$mime];
        }

        $newFilename = uniqid() . $extension;

        $folder = "./images/features/originals"; // no trailing slash

        if (! is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $destination = $folder . "/" . $newFilename;

        move_uploaded_file($filename, $destination);

        $this->feature_img = $newFilename;

        //240x300 80x100
        if (! is_dir("./images/features/300h")) {
            mkdir("./images/features/300h", 0777, true);
        }
        $img = Image::make($destination);
        $img->fit(240, 300);
        $img->save("./images/features/300h/" . $newFilename);

        if (! is_dir("./images/features/100h")) {
            mkdir("./images/features/100h", 0777, true);
        }
        $img = Image::make($destination);
        $img->fit(80, 100);
        $img->save("./images/features/100h/" . $newFilename);
    }

    public static function search($searchquery)
    {
        $models = [];
        $db = static::getDatabaseConnection();

        $query = "SET @searchterm = :searchquery ;";
        $statement = $db->prepare($query);
        $statement->bindValue(':searchquery', $searchquery);
        $statement->execute();

        $query = "SELECT
                posts.id, title, content, taglist,
                MATCH(title) AGAINST(@searchterm) * 2 AS score_title,
                MATCH(content) AGAINST(@searchterm) AS score_description,
                MATCH(taglist) AGAINST(@searchterm IN BOOLEAN MODE) * 1.5 AS score_tag
            FROM posts
            LEFT JOIN (
                SELECT post_id, GROUP_CONCAT(tag SEPARATOR ', ') AS taglist 
                FROM tags
                RIGHT JOIN posts_tags ON posts_tags.tag_id = id
                GROUP BY post_id
            ) AS tags ON posts.id = post_id
            WHERE
                MATCH(title) AGAINST(@searchterm) OR
                MATCH(content) AGAINST(@searchterm) OR
                MATCH(taglist) AGAINST(@searchterm IN BOOLEAN MODE)
            ORDER BY (score_title + score_description + score_tag) DESC";

        $statement = $db->prepare($query);
        $statement->execute();
        while ($record = $statement->fetch(PDO::FETCH_ASSOC)) {
            $model = new Post();
            $model->data = $record;
            array_push($models, $model);
        }

        return $models;
    }

}
