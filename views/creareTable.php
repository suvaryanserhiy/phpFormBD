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

    $database = new Database($server, $username, $password, $dbName);
    $conection = $database->getConnection();

} catch (Exception $e) {
    echo 'Error al conectarse a servidor';
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    try {
        if (isset($_POST['tableName'])) {
            $table = $_POST['tableName'];
        }
    } catch (ErrorException $e) {
        echo "Error al intruducir el nombre de la tabla";
        exit();
    }


    try {
        $sql = "CREATE DATABASE IF NOT EXISTS form";
        $conection->query($sql);

        $tableController = new OperationsController($conection);

        $tableController->createTable($table);


    } catch (Exception $e) {
        echo "Error al crear la tabla {$table}" .$conection->$e;
    }

}
