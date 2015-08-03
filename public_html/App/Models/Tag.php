<?php

namespace App\Models;

class Tag extends DatabaseModel
{

    protected static $columns = ['id', 'tag'];

    protected static $tableName = "tags";

}
