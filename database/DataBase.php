<?php
namespace database;
use PDO;
use PDOException;

class DataBase
{
    private $connection;
    private $options =array (
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
);
    private string $dbHost = DB_HOST;
    private string $dbName = DB_NAME;
    private string $dbUserName = DB_USERNAME;
    private string $dbPassword = DB_PASSWORD;
    function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUserName, $this->dbPassword, $this->options);
            echo 'ok';
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }
}


?>