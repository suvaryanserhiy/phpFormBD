<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form</title>
</head>
<body>
<form method="post" action="creareTable.php">
    <label>
        Table Name: <input type="text" name="tableName">
    </label>
    <br>
    <br>

    <label for="insert">
        <a href="insertData.php">2. Insertar</a>
    </label>
    <br>
    <br>

    <label for="update">
        <a href="updateData.php">3. Actualizar</a>
    </label>

    <br>
    <br>

    <label for="print">
        <a href="showData.php">4. Mostrar</a>
    </label>
    <br>
    <br>
    <label>
        <input type="submit" name="submit" value="Submit">
    </label>
</form>
</body>
</html>

<?php

require_once('../models/Database.php');
require_once('../controllers/OperationsController.php');

session_start();
$settings = parse_ini_file('../settings.ini');
$server = $settings['server'];
$username = $settings['username'];
$password = $settings['password'];
$dbName = $settings['database'];


try {

}catch (RuntimeException $e){

}


try {     //tring to connect to a database with parameters
    $database = new Database($server, $username, $password, $dbName); // establish connection with a server
    $conection = $database->getConnection();  //get that connenction

} catch (Exception $e) {
    echo 'Error al conectarse a servidor';   //if connection wasn`t successful
}

try {
    if ($_SERVER['REQUEST_METHOD'] === "POST") { //check's if the request method from a server is POST
        try {
            if (isset($_POST['tableName'])) {
                $table = $_POST['tableName'];   //check`s if a tableName exists
            }
        } catch (ErrorException $e) {
            echo "Error al intruducir el nombre de la tabla"; // if not exists pront`s
            exit(); // exiting from a code;
        }


        try {

            $tableController = new OperationsController($conection); // create an obnject

            $tableController->createTable($table); // use Object's method


        } catch (Exception $e) {
            echo "Error al crear la tabla {$table}" .$conection->$e; // if creation of a table was failure
        }

    }
}catch (RuntimeException $e){
    echo "Not a POST method sended";  //Print's on a screen custom error message
}

