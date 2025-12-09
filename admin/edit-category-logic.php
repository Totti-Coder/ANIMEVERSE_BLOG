<?php
require "partials/header.php";

if (isset($_POST["submit"])) {
    // Conseguimos los datos del formulario
    $id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
    $title = htmlspecialchars($_POST["title"], ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($_POST["description"], ENT_QUOTES, 'UTF-8');

    if (!$title || !$description) {
        $_SESSION["edit-category"] = "Escribe un titulo";
    } else {

        // Verificamos que existe la categoria
        $verify_query = "SELECT id FROM categories WHERE id=? LIMIT 1";
        $verify_stmt = mysqli_prepare($connection, $verify_query);
        mysqli_stmt_bind_param($verify_stmt, "i", $id);
        mysqli_stmt_execute($verify_stmt);
        $verify_result = mysqli_stmt_get_result($verify_stmt);

        if (mysqli_num_rows($verify_result) == 0) {
            $_SESSION["edit-category"] = "La categoría no existe";
        } else {
            // Actualizamos el usuario 
            $query = "UPDATE categories SET title=?, description=? WHERE id=? LIMIT 1";
            $stmt = mysqli_prepare($connection, $query);
            mysqli_stmt_bind_param($stmt, "ssi", $title, $description, $id);
            mysqli_stmt_execute($stmt);
            if (mysqli_errno($connection)) {
                $_SESSION["edit-category"] = "No se ha podido editar la categoria";
            } else {
                $_SESSION["edit-category-success"] = "La categoria $title ha sido actualizada";
            }
        }
    }
    header("location: " . ROOT_URL . "admin/manage-categories.php");
    die();
}
header("location: " . ROOT_URL . "admin/manage-categories.php");
die();