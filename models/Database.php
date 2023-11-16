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

        $this->connect(); //execute connect function
    }

    private function connect() {
        $this->connection = new mysqli($this->server, $this->username, $this->password, $this->database); // establish connection to a server

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection() { // function to get a connection
        return $this->connection;
    }
}
?>
