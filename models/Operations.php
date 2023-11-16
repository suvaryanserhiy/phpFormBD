<?php

class Operations
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function createTable($tableName)
    {
        $sql = "CREATE TABLE IF NOT EXISTS {$tableName} (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            nombre VARCHAR(50),
            telefono INT(9),
            direccion VARCHAR(150),
            email VARCHAR(100)
        )";

        mysqli_query($this->connection, $sql);
    }

    public function insertData($table, $name, $telefono, $direccion, $email)
    {
        $sql = "INSERT INTO {$table}
            (nombre,telefono,direccion,email)
            VALUES
            ('{$name}','{$telefono}','{$direccion}','{$email}'
        )";
        mysqli_query($this->connection, $sql);
    }

    public function updateData($table, $column, $newValue, $whereCondition)
    {
        $sql = "UPDATE {$table}
                        SET
                            {$column} = '{$newValue}'
                        WHERE
                            {$whereCondition}
        ";
        mysqli_query($this->connection, $sql);

    }

    public function showData($table)
    {
        $sql = "SELECT * FROM {$table}";

       return mysqli_query($this->connection, $sql);
    }

    public function showAllData($table)
    {
        $sql = "SHOW TABLES";

        return mysqli_query($this->connection, $sql);
    }

}

?>
