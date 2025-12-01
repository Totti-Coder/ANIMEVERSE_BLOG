<?php
require "constants.php";

// Conectamos a la base de datos
$connection = new mysqli(DB_HOST, DB_USER, DB_PSW, DB_NAME);

if(mysqli_errno($connection)) {
    die(mysqli_error($connection));
}
?>