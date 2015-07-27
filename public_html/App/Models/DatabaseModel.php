<?php

namespace App\Models;

use PDO;
use UnexpectedValueException;
use App\Models\Exceptions\ModelNotFoundException;

abstract class DatabaseModel
{

    public $data = [];

    protected static $columns = [];

    protected static $fakeColumns = [];

    public $errors = [];

    private static $db;

    public function __construct($input = null)
    {
        if (static::$columns) {
            foreach (static::$columns as $column) {
                $this->$column = null;
                $this->errors[$column] = null;
            }
        }

        if (static::$fakeColumns) {
            foreach (static::$fakeColumns as $column) {
                $this->$column = null;
                $this->errors[$column] = null;
            }
        }

        if (is_numeric($input) && $input > 0) {
            // input is a number, load that record from db.
            $this->find($input);
        }
        if (is_array($input)) {
            // input is array, load data from array
            $this->processArray($input);
        }
    }

    protected static function getDatabaseConnection()
    {
        if (! self::$db) {
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8';

            self::$db = new PDO($dsn, DB_USER, DB_PASS);

            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        }

        return self::$db;
    }

    public function processArray($input)
    {
        foreach (static::$columns as $column) {
            if (isset($input[$column])) {
                $this->$column = $input[$column];
            }
        }
        foreach (static::$fakeColumns as $column) {
            if (isset($input[$column])) {
                $this->$column = $input[$column];
            }
        }
    }


    public static function all($sortColumn = "", $asc = true, $pageSize = null, $pageNumber = null)
    {
        $models = [];

        $db = static::getDatabaseConnection();

        $query = "SELECT " . implode(",", static::$columns) .
            " FROM " . static::$tableName;

        if ($sortColumn !== "") {
            if (! array_search($sortColumn, static::$columns)) {
                throw new UnexpectedValueException("Property '$sortColumn' not found in columns list.");
            }
            $query .= " ORDER BY " . $sortColumn;
            if ($asc) {
                $query .= " ASC";
            } else {
                $query .= " DESC";
            }
        }

        if ($pageSize > 0 && $pageNumber > 0) {
            $firstRecord = ($pageSize * $pageNumber) - $pageSize;
            $query .= " LIMIT " . $firstRecord . ", " . $pageSize;
        }

        $statement = $db->prepare($query);
        $statement->execute();

        while ($record = $statement->fetch(PDO::FETCH_ASSOC)) {
            $model = new static();
            $model->data = $record;
            array_push($models, $model);
        }

        return $models;
    }

    public static function allBy($column, $value, $sortColumn = "", $asc = true, $pageSize = null, $pageNumber = null)
    {
        $models = [];

        $db = static::getDatabaseConnection();

        $query = "SELECT " . implode(",", static::$columns) .
            " FROM " . static::$tableName;

        if (! array_search($column, static::$columns)) {
            throw new UnexpectedValueException("Property '$column' not found in columns list.");
        }

            $query .= " WHERE $column = :value";

        if ($sortColumn !== "") {
            if (! array_search($sortColumn, static::$columns)) {
                throw new UnexpectedValueException("Property '$sortColumn' not found in columns list.");
            }
            $query .= " ORDER BY " . $sortColumn;
            if ($asc) {
                $query .= " ASC";
            } else {
                $query .= " DESC";
            }
        }

        if ($pageSize > 0 && $pageNumber > 0) {
            $firstRecord = ($pageSize * $pageNumber) - $pageSize;
            $query .= " LIMIT " . $firstRecord . ", " . $pageSize;
        }

            $statement = $db->prepare($query);
            $statement->bindValue(":value", $value);
            $statement->execute();

        while ($record = $statement->fetch(PDO::FETCH_ASSOC)) {
            $model = new static();
            $model->data = $record;
            array_push($models, $model);
        }

        return $models;
    }

    public static function count()
    {
        $db = static::getDatabaseConnection();

        $query = "SELECT count(id) FROM " . static::$tableName;

        $statement = $db->prepare($query);
        $statement->execute();

        return $statement->fetchColumn();
    }

    public function find($id)
    {
        $db = static::getDatabaseConnection();

        $query = "SELECT " . implode(",", static::$columns) .
            " FROM " . static::$tableName .
            " WHERE id = :id";

        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->execute();

        $record = $statement->fetch(PDO::FETCH_ASSOC);

        if (! $record) {
            throw new ModelNotFoundException();
        }

            $this->data = $record;

    }

    public static function findBy($column, $value)
    {
        $db = static::getDatabaseConnection();

        $query = "SELECT " . implode(",", static::$columns) .
            " FROM " . static::$tableName .
            " WHERE " . $column . " = :value";

        $statement = $db->prepare($query);
        $statement->bindValue(':value', $value);
        $statement->execute();

        $record = $statement->fetch(PDO::FETCH_ASSOC);

        if (! $record) {
            throw new ModelNotFoundException();
        }

        $obj = new static;
        $obj->data = $record;
        return $obj;
    }

    public function save()
    {
        if ($this->id > 0) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    public function insert()
    {
        $db = static::getDatabaseConnection();

        $columns = static::$columns;

        unset($columns[array_search('id', $columns)]);

        $query = "INSERT INTO " . static::$tableName .
            " (" . implode(", ", $columns) . ")" .
            " VALUES (";

        $insertcols = [];
        foreach ($columns as $column) {
            array_push($insertcols, ":" . $column);
        }
        $query .= implode(", ", $insertcols);

        $query .= ")";

        $statement = $db->prepare($query);

        foreach ($columns as $column) {
            if ($column === "password") {
                $this->$column = password_hash($this->$column, PASSWORD_DEFAULT);
            }
            $statement->bindValue(":" . $column, $this->$column);
        }

        $statement->execute();

        $this->id = $db->lastInsertId();
    }

    public function update()
    {
        $db = static::getDatabaseConnection();

        $columns = static::$columns;

        unset($columns[array_search('id', $columns)]);

        $query = "UPDATE " . static::$tableName . " SET ";

        $updatecols = [];
        foreach ($columns as $column) {
            array_push($updatecols, $column . " = :" . $column);
        }
        $query .= implode(", ", $updatecols);

        $query .= " WHERE id = :id";

        $statement = $db->prepare($query);

        foreach (static::$columns as $column) {
            if ($column === "password") {
                $this->$column = password_hash($this->$column, PASSWORD_DEFAULT);
            }
            $statement->bindValue(":" . $column, $this->$column);
        }


        $statement->execute();
    }

    public static function destroy($id)
    {
        $db = static::getDatabaseConnection();

        $query = "DELETE FROM " . static::$tableName .
            " WHERE id = :id ";

        $statement = $db->prepare($query);
        $statement->bindValue(':id', $id);

        $statement->execute();
    }

   public function isValid()
    {
        $valid = true;

        foreach (static::$validationRules as $column => $rules) {
            $this->errors[$column] = null;
            $rules = explode(",", $rules);
            foreach ($rules as $rule) {
                if (strstr($rule, ":")) {
                    $rule = explode(":", $rule);
                    $value = $rule[1];
                    $rule = $rule[0];
                }
                switch ($rule) {
                    case 'minlength':
                        if (strlen($this->$column) < $value) {
                            $valid = false;
                            $this->errors[$column] = "Must be at least $value characters long.";
                        }
                    break;
                    case 'maxlength':
                        if (strlen($this->$column) > $value) {
                            $valid = false;
                            $this->errors[$column] = "Must be no more than $value characters long.";
                        }
                    break;
                    case 'numeric':
                        if (! is_numeric($this->$column)) {
                            $valid = false;
                            $this->errors[$column] = "Must be a number.";
                        }
                    break;
                    case 'email':
                        if (! filter_var($this->$column, FILTER_VALIDATE_EMAIL)) {
                            $valid = false;
                            $this->errors[$column] = "Must be a valid email address.";
                        }
                    break;
                    case 'match':
                        if ($this->$column !== $this->$value) {
                            $valid = false;
                            $this->errors[$column] = "Must match with {$value} field.";
                        }
                    break;
                    case 'unique':
                        try {
                            $record = $value::findBy($column, $this->$column);
                        } catch (ModelNotFoundException $e) {
                            break;
                        }
                        $valid = false;
                        $this->errors[$column] = "This value is already being used.";
                    break;
                }
            }
        }

        return $valid;
    }

    public function __get($name)
    {
        if (in_array($name, static::$columns) || in_array($name, static::$fakeColumns)) {
            return $this->data[$name];
        }
        throw new UnexpectedValueException("Property '$name' not found in columns list.");
    }

    public function __set($name, $value)
    {
        if (!in_array($name, static::$columns) && !in_array($name, static::$fakeColumns)) {
            throw new UnexpectedValueException("Property '$name' not found in columns list.");
        }
        $this->data[$name] = $value;
    }
}
