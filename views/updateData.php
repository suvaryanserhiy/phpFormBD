<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>form</title>
</head>
<body>
<form method="post" action="updateData.php">
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
        /////////////////////////////////////////////
    </label>
    <br>
    <br>
    <label>
        Tabla:
        <input type="text" name="table">
    </label>
    <br>
    <br>
    <label>
        Columna:
        <input type="text" name="data">
    </label>
    <br>
    <br>
    <label>
        Nuevo Valor:
        <input type="text" name="newValue">
    </label>
    <br>
    <br>
    <label>
        Donde:
        <input type="text" name="where">
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
    $connection = ($database = new Database($server, $username, $password, $dbName))->getConnection();

    try {
        $sql = "SHOW TABLES";
        $result = $connection->query($sql);
        //validation form input data
        if ($result->num_rows < 1) {
            $_SESSION['updateDBnull'] = true;
            header('Location:index.php');
            exit();
        }
    } catch (Exception $e) {
        echo "No existe ninguna tabla para insertar los datos";
    }
} catch (Exception $e) {
    echo 'Error al conectarse al servidor';
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // validation from input
    try {
        $table = isset($_POST['table']) ? $_POST['table'] : false;
        $column = isset($_POST['data']) ? $_POST['data'] : false;
        $newValue = isset($_POST['newValue']) ? $_POST['newValue'] : false;
        $whereCondition = isset($_POST['where']) ? $_POST['where'] : false;

    } catch (Exception $e) {
        echo 'Error al validar los datos';
        exit("Error al establecer los datos");
    }
    // end of validation

    try {
        if ($table && $column && $newValue && $whereCondition) {
            try {
                $tableOperation = new OperationsController($connection);

                $tableOperation->updateData($table, $column, $newValue, $whereCondition);

            } catch (Exception $e) {
                echo 'Error al actualizar los datos';
            }

        }
    } catch (Exception $e) {
        echo "Error al validar input";
    }
}
?>
