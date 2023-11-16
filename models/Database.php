<?php
class Database {
    // variable declaration
    private $server;
    private $username;
    private $password;
    private $database;
    private $connection;

    public function __construct($server, $username, $password, $database) { //constructor
        $this->server = $server;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        $this->connect($database); //execute connect function



    }

    private function createDatabase($dbName)
    {
        $sql = "CREATE DATABASE IF NOT EXISTS {$dbName}";

        if ($this->connection->query($sql) === false) {
            throw new RuntimeException("Error creating database: " . $this->connection->error);
        }
    }
    private function connect() {
        $this->connection = new mysqli($this->server, $this->username, $this->password);

        if ($this->connection->connect_error) {
            throw new RuntimeException("Connection failed: " . $this->connection->connect_error);
        }

        $this->createDatabase($this->database);

        $this->connection->select_db($this->database);
    }


    public function getConnection() { // function to get a connection
        return $this->connection;
    }
}
?>
