<?php
require "partials/header.php";

if(isset($_POST["submit"])) {
    // Actualizamos los datos del formulario
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $nombre = htmlspecialchars($_POST["nombre"], ENT_QUOTES, 'UTF-8');
    $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $is_admin = filter_var($_POST["userrole"], FILTER_SANITIZE_NUMBER_INT);

    // Comprobamos que los inputs sean validos
    if(!$nombre || !$username || !$email) {
        $_SESSION["edit-user"] = "Forma del campo invalida";
    } else {
        // Actualizamos el usuario 
        $query = "UPDATE users SET nombre=?, username=?, email=?, is_admin=? WHERE id=? LIMIT 1";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "sssii", $nombre, $username, $email, $is_admin, $id);
        mysqli_stmt_execute($stmt);

        if(mysqli_errno($connection)) {
            $_SESSION["edit-user"] = "No se ha podido editar el usuario";
        } else {
            $_SESSION["edit-user-success"] = "El usuario $nombre con usuario: $username, ha sido actualizado";
        }
    }
}

header("location: " . ROOT_URL . "admin/manage-users.php");
die();