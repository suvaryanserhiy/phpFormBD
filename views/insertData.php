<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form</title>
</head>
<body>
<form method="post" action="insertData.php">
    <label>
        <a href="creareTable.php">1. Crear</a>
    </label>
    <br>
    <br>

    <label for="insert">
        <label>////////////////////////////////////</label>
    </label>
    <br>
    <br>
    <label for="name">Nombre: </label>

    <label> <input type="text" name="name">

    </label>

    <label for="name">Telefono: </label>

    <label> <input type="text" name="telefono">

    </label>

    <label for="name">Direccion </label>

    <label> <input type="text" name="direccion">

    </label>

    <label for="name">Email: </label>

    <label> <input type="text" name="email">

    </label>
    <label for="name">Table: </label>

    <label> <input type="text" name="table">

    </label>
    <br>
    <br>
    <label for="insert">
        <label>////////////////////////////////////</label>
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
    $connection = ($database = new Database($server, $username, $password, $dbName))->getConnection();

    try {
        $sql = "SHOW TABLES";
        $result = $connection->query($sql);
        //validation form input data
        if ($result->num_rows < 1) {
            $_SESSION['insertDBnull'] = true;
            header('Location:index.php');
            exit();
        }
    } catch (Exception $e) {
        echo "No existe ninguna tabla para insertar los datos";
    }
} catch (Exception $e) {
    echo 'Error al conectarse a servidor';
}
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    try {
        $name = isset($_POST['name']) ? $_POST['name'] : false;
        $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
        $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
        $email = isset($_POST['email']) ? $_POST['email'] : false;
        $table = isset($_POST['table']) ? $_POST['table'] : false;

    } catch (Exception $e) {
        echo 'Error validating form data -> ' . $e;
        exit('error al establecer los datos') . $connection->$e;
    }

    //end of validation

    if ($name && $telefono && $direccion && $email && $table) {
        try {
            $tableController = new OperationsController($connection);

            $tableController->insertData($table,$name,$telefono,$direccion,$email);

        } catch (RuntimeException $e) {
            echo "Error al insertar datos ->";
            echo $connection->$e;
        }

    }
}
