<?php
namespace database;

use PDO;
use PDOException;

class DataBase
{
    private $connection;
    private $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
    );
    private string $dbHost = DB_HOST;
    private string $dbName = DB_NAME;
    private string $dbUserName = DB_USERNAME;
    private string $dbPassword = DB_PASSWORD;
    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUserName, $this->dbPassword, $this->options);
            echo 'ok';
        } catch (PDOException $e) {
            dd($e->getMessage());
            exit;
        }
    }

    public function SELECT(string $sql, $values = null)
    {
        try {
            $stmt = $this->connection->prepare($sql);
            if ($values == null) {
                $stmt->execute();
            } else {

                $stmt->execute($values);
            }
            $result = $stmt;
            return $result;
        } catch (PDOException $e) {
            dd($e->getMessage());
            return false;
        }

    }
    public function INSERT(string $tableName, array $fields, array $values)
    {
        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO" . $tableName . "(" . implode(', ', $fields) . ", created_at ) VALUES (:" . implode(', :', $fields) . " , now());"
            );
            $stmt->execute(array_combine($fields, $values));
        } catch (PDOException $e) {
            dd($e->getMessage());

            return false;
        }

    }
    public function UPDATE(string $tableName, $id, $fields, $values)
    {
        $sql = "UPDATE" . $tableName . "SET";

        foreach (array_combine($fields, $values) as $field => $value) {
            if ($value) {
                $sql .= "`" . $field . "` = ? ,";
            } else {
                $sql .= "`" . $field . "` = NULL ,";
            }
        }
        $sql .= "updated_at= now()";
        $sql .= "WHERE id = ?";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute(array_merge(array_filter(array_values($values)), [$id]));
            return true;
        } catch (PDOException $e) {
            dd($e->getMessage());

            return false;
        }
    }
    public function DELETE($tableName, $id)
    {
        $sql = "DELETE FROM " . $tableName . " WHERE id = ? ;";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            dd($e->getMessage());

            return false;
        }

    }
}


?>