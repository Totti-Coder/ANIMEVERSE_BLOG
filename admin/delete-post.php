<?php
require "partials/header.php";

if (isset($_GET)) {
    $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);

    // Obtenemos las publicaciones de la base de datos para borrar la miniatura de la carpeta images
    $query = "SELECT * FROM posts WHERE id=?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $query_result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($query_result) == 1) {
        $post = mysqli_fetch_assoc($query_result);
        $thumbnail_name = $post["thumbnail"];
        $thumbnail_path = "../images/" . $thumbnail_name;#

        // Eliminamos miniatura
        if ($thumbnail_path) {
            unlink($thumbnail_path);

            // Eliminamos la publicaion de la base de datos
            $delete_post_query = "DELETE FROM posts WHERE id=? LIMIT 1";
            $stmt = mysqli_prepare($connection, $delete_post_query);
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);

            if (!mysqli_errno($connection)) {
                $_SESSION["delete-post-success"] = "Se ha eliminado correctamente la publicacion";
            } else {
                $_SESSION["delete-post"] = "Error al eliminar la publicación";
            }

        }
    }
    header("location: " . ROOT_URL . "admin/");
    die();
}