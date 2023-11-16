<?php

require_once '../models/Operations.php'; // Include your TableOperations class file
require_once '../controllers/ErrorHandling.php';
class OperationsController
{
    private $connection;
    private $tableOperations;

    private $errorHandling;

    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->tableOperations = new Operations($connection);
        $this->errorHandling = new ErrorHandling();
    }

    public function createTable($tableName)
    {

        if ($this->errorHandling->validteTableName($tableName)){
            $this->tableOperations->createTable($tableName);

            $_SESSION['table_created'] = true;

            header('Location: index.php');

            exit();
        }


    }

    public function insertData($table, $name, $telefono, $direccion, $email)
    {
        // Logic for inserting data
        if (!($this->errorHandling->validateTableInsert($table, $name, $telefono, $direccion, $email))){
            exit();
        }
        $this->tableOperations->insertData($table, $name, $telefono, $direccion, $email);
        $_SESSION['valid_insert'] = true;
        header('Location:index.php');
        exit();
    }

    public function updateData($table, $dataColumn, $newValue, $whereCondition)
    {
        // Logic for updating data
        $this->tableOperations->updateData($table, $dataColumn, $newValue, $whereCondition);

        $_SESSION['valid_update'] = true;
        header('Location:index.php');
        exit();
    }

    public function showData($tableName)
    {
        if (!($this->errorHandling->validteTableName($tableName))){
            exit();
        }
        // Logic for showing data
        if ($tableName === "*") {
            $result = $this->tableOperations->showAllData($tableName);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_row()) {
                    $tableName = $row[0];
                    $resultTable = $this->tableOperations->showData($tableName);
                    try {
                        if ($resultTable->num_rows > 0) {
                            echo "<h2>{$tableName}:</h2>";
                            echo "<table border='1'>";
                            echo "<tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Telefono</th>
                                <th>Direccion</th>
                                <th>Email</th>
                              </tr>";

                            while ($rowTable = $resultTable->fetch_assoc()) {
                                echo "<tr>
                                            <td>{$rowTable['id']}</td>
                                            <td>{$rowTable['nombre']}</td>
                                            <td>{$rowTable['telefono']}</td>
                                            <td>{$rowTable['direccion']}</td>
                                            <td>{$rowTable['email']}</td>
                                          </tr>";
                            }
                            echo "</table>";
                        }
                    }catch (Exception $e){
                        echo "<p>No hay filas para mostrar en {$tableName}.</p>";
                    }

                }
            }
        }else{
            $result = $this->tableOperations->showData($tableName);

            try {
                if ($result->num_rows > 0){
                    echo "
                            <h2>{$tableName}</h2>
                            <table border='1'>
                            <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Direccion</th>
                            <th>Email</th>
                            </tr>
                    ";

                    while ($row = $result->fetch_assoc()){
                        echo "
                            <tr>
                                <td>{$row['id']}</td>
                                <td>{$row['nombre']}</td>
                                <td>{$row['telefono']}</td>
                                <td>{$row['direccion']}</td>
                                <td>{$row['email']}</td>
                            </tr>
                        ";
                    }
                    echo "</table>";
                }
            }catch (Exception $e){
                echo "no hay filas para mostrar en {$tableName}";
                exit();
            }
        }


    }

    // Other methods as needed
}

?>
