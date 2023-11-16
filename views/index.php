<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>form</title>
</head>
<body>
<form>
    <label>
        <a href="creareTable.php">1. Crear</a>
    </label>
    <br
    <br><br
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
</form>
</body>
</html>
<?php
session_start();

// Check if the table was created successfully
if (isset($_SESSION['table_created']) && $_SESSION['table_created']) {
    echo " <p>Table has been created successfully!</p> ";

// Reset the session variable to avoid displaying the message on subsequent visits
$_SESSION['table_created'] = false;
}
if (isset($_SESSION['valid_insert']) && $_SESSION['valid_insert']){
    echo "<p>Successfull input!</p>";
}
$_SESSION['valid_insert'] = false;

if (isset($_SESSION['valid_update']) && $_SESSION['valid_update']){
    echo "<p>Successfull update!</p>";
}
$_SESSION['valid_update'] = false;

if (isset($_SESSION['insertDBnull']) && $_SESSION['insertDBnull']){
    echo "<p>No existe ninguna tabla para insertar los datos</p>";
}
$_SESSION['insertDBnull'] = false;

if (isset($_SESSION['updateDBnull']) && $_SESSION['updateDBnull']){
    echo "<p>No existe ninguna tabla para actualizar los datos</p>";
}
$_SESSION['updateDBnull'] = false;

if (isset($_SESSION['showDBnull']) && $_SESSION['showDBnull']){
    echo "<p>No existe ninguna tabla para mostrar los datos</p>";
}
$_SESSION['showDBnull'] = false;
exit();

?>