<?php
require "config/constants.php";
require "config/database.php";

// Obtener los datos del formulario en caso de que haya dado a "CREAR"
if (isset($_POST["submit"])) {
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = htmlspecialchars($_POST["previous_thumbnail_name"], ENT_QUOTES, 'UTF-8');
    $title = htmlspecialchars($_POST["title"], ENT_QUOTES, 'UTF-8');
    $body = htmlspecialchars($_POST["body"], ENT_QUOTES, 'UTF-8');
    $category_id = filter_var($_POST["category"], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST["is_featured"], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES["thumbnail"];

    // Si el boton de destacado no esta marcado cambiamos el valor a cero
    $is_featured = $is_featured == 1 ? 1 : 0;

    // Validacion de los inputs
    if (!$title) {
        $_SESSION["edit-post"] = "No se pudo actualizar la publicacion. No se puede utilizar este titulo";
    } elseif (!$category_id) {
        $_SESSION["edit-post"] = "No se pudo actualizar la publicacion. No se puede utilizar esta categoria";
    } elseif (!$body) {
        $_SESSION["edit-post"] = "No se pudo actualizar la publicacion. No se ha podido actualizar el cuerpo de la publicacion";
    } else {
        // Eliminamos la miniatura existente si hay una nueva miniatura
        if ($thumbnail["name"]) {
            $previous_thumbnail_path = "../images/" . $previous_thumbnail_name;
            if (file_exists($previous_thumbnail_path)) {
                unlink($previous_thumbnail_path);
            }
            // Trabajamos con el avatar
            // Renombramos el avatar
            $time = time();
            $thumbnail_name = $time . $thumbnail["name"];
            $thumbnail_tmp_name = $thumbnail["tmp_name"];
            $thumbnail_destination_path = "../images/" . $thumbnail_name;

            // Me aseguro de que el archivo es una imagen
            $allowed_files = ["png", "jpg", "jpeg"];
            $extention = explode(".", $thumbnail_name);
            $extention = end($extention);
            if (in_array($extention, $allowed_files)) {
                // Nos aseguramos de que la imagen no sea pesada
                if ($thumbnail["size"] < 1000000) {
                    move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);
                } else {
                    $_SESSION["edit-post"] = "El archivo es demasiado grande";
                }
            } else {
                $_SESSION["edit-post"] = "El archivo tiene que ser png, jpg o jpeg";
            }
        }
    }

    // Nos redirige a la pagina de registro si existe algun problema
    if (isset($_SESSION["edit-post"])) {
        header("location: " . ROOT_URL . "admin/edit-post.php");
        die();
    } else {

        if ($is_featured == 1) {
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=0";
            $zero_all_is_featured_result = mysqli_query($connection, $zero_all_is_featured_query);
        }
        // Actualizar la publicación en la base de datos
        $thumbnail_to_insert = $thumbnail["name"] ? $thumbnail_name : $previous_thumbnail_name;

        $update_post_query = "UPDATE posts SET title=?, body=?, thumbnail=?, category_id=?, is_featured=? WHERE id=? LIMIT=1";
        $stmt = mysqli_prepare($connection, $update_post_query);
        mysqli_stmt_bind_param($stmt, "sssiii", $title, $body, $thumbnail_to_insert, $category_id, $is_featured, $id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_errno($stmt)) {
            $_SESSION["edit-post"] = "Error al actualizar la publicación";
            header("location: " . ROOT_URL . "admin/edit-post.php");
            die();
        } else {
            $_SESSION["edit-post-success"] = "Publicación actualizada correctamente";
            header("location: " . ROOT_URL . "admin/manage-posts.php");
            die();
        }
    }
} else {
    header("location: " . ROOT_URL . "admin/");
    die();
}
?>