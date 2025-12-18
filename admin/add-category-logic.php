<?php
require "partials/header.php";

if (isset($_POST["submit"])) {
    // Conseguimos los datos del formulario
    $title = htmlspecialchars($_POST["title"], ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars($_POST["description"], ENT_QUOTES, 'UTF-8');

    if (!$title) {
        $_SESSION["add-category"] = "Escribe un titulo";
    } elseif (!$description) {
        $_SESSION["add-category"] = "Escribe una descripcion";
    }

    // Redirigimos a la pagina de add-category si hubo algun problema
    if (isset($_SESSION["add-category"])) {
        $_SESSION["add-category-data"] = $_POST;
        header("location: " . ROOT_URL . "/admin/add-category.php");
        die();
    } else {
        // Agregamos la categoria a la base de datos
        $query = "INSERT INTO categories (title, description) VALUES (?, ?)";
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "ss", $title, $description);
        mysqli_stmt_execute($stmt);

        if (mysqli_errno($connection)) {
            $_SESSION["add-category"] = "No se pudo agregar la categoria";
            header("location: " . ROOT_URL . "/admin/manage-categories.php");
            die();
        } else {
            $_SESSION["add-category-success"] = "Categoría añadida correctamente";
            header("location: " . ROOT_URL . "admin/manage-categories.php");
            die();
        }

    }
}