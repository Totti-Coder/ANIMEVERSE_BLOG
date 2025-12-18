<?php
require "partials/header.php";

if (isset($_GET["id"])) {
    $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);

    // Definimos el ID de sin categoria de la base de datos (creado por mi mismo)
    $uncategorized_id = 5;

    // Verificacion de que la categoría existe
    $query = "SELECT * FROM categories WHERE id=?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $query_result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($query_result) == 1) {
        $category = mysqli_fetch_assoc($query_result);
        $category_title = $category["title"];

        // Actualizar las publicaciones a sin categoria en caso de eliminar alguna (Primer category_id pertenece a uncategorized=5 y el segundo a la categoria que vamos a eliminar)
        $update_query = "UPDATE posts SET category_id=? WHERE category_id=?";
        $stmt_update = mysqli_prepare($connection, $update_query);
        mysqli_stmt_bind_param($stmt_update, "ii", $uncategorized_id, $id);
        mysqli_stmt_execute($stmt_update);
        mysqli_stmt_close($stmt_update);

        // Eliminamos la categoria
        $delete_category_query = "DELETE FROM categories WHERE id=? LIMIT 1";
        $stmt_delete = mysqli_prepare($connection, $delete_category_query);
        mysqli_stmt_bind_param($stmt_delete, "i", $id);
        mysqli_stmt_execute($stmt_delete);

        if (mysqli_errno($connection)) {
            $_SESSION["delete-category"] = "No se pudo eliminar la categoría '$category_title'.";
        } else {
            $_SESSION["delete-category-success"] = "La categoría '$category_title' se ha eliminado correctamente.";
        }
    } else {
        $_SESSION["delete-category"] = "Categoría no encontrada.";
    }
} else {
    $_SESSION["delete-category"] = "ID no válido.";
}

header("location: " . ROOT_URL . "admin/manage-categories.php");
die();
?>