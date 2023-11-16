<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>form</title>
</head>
<body>
<form method="post" action="">
    <label>
        <a href="creareTable.php">1. Crear</a>
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
        Nombre de la tabla:
        <input type="text" name="table">
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

//imports
require_once('../models/Database.php');
require_once('../controllers/OperationsController.php');

session_start(); //start session


//setting
$settings = parse_ini_file('../settings.ini');
$server = $settings['server'];
$username = $settings['username'];
$password = $settings['password'];
$dbName = $settings['database'];


try {
    $connection = ($database = new Database($server, $username, $password, $dbName))->getConnection(); //getting a connection to a server
} catch (Exception $e) {
    echo 'Error al conectarse al servidor'; // if failure
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') { // if method POST
    try {
        $table = isset($_POST['table']) ? $_POST['table'] : false;
    } catch (Exception $e) {
        echo 'Error al validar los datos';
        exit('Error al establecet los datos');
    }

    try {
        if ($table){ // if table not false
            try {
                $tableOperation = new OperationsController($connection);

                $tableOperation->showData($table); //execute a showData method
            }catch (Exception $e){
                echo "Error al vilualizar los  datos" . $connection->$e;
            }

        }
    }catch (Exception $e){
        echo "Error al validar input";
    }

}

?>

