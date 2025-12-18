<?php
require "partials/header.php";

if (isset($_GET["id"])) {
    $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);

    // Buscamos la categoria en la base de datos
    $query = "SELECT * FROM categories WHERE id=?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $query_result = mysqli_stmt_get_result($stmt);

    // Convertimos en array asociativo
    $category = mysqli_fetch_assoc($query_result);

    // Eliminamos el usuario de la base de datos
    $delete_category_query = "DELETE FROM categories WHERE id=? LIMIT 1";
    $stmt = mysqli_prepare($connection, $delete_category_query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_errno($connection)) {
        $_SESSION["delete-category"] = "No se pudo eliminar la categoria '{$category["title"]}'.";
    } else {
        $_SESSION["delete-category-success"] = "La categoria '{$category["title"]}' se ha eliminado correctamente.";
    }
}
header("location: " . ROOT_URL . "admin/manage-categories.php");
die();