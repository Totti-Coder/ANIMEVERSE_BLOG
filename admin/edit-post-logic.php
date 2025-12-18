<?php
require "config/constants.php";
require "config/database.php";

// Obtener los datos del formulario
if (isset($_POST["submit"])) {
    $id = filter_var($_POST["id"], FILTER_SANITIZE_NUMBER_INT);
    $previous_thumbnail_name = filter_var($_POST["previous_thumbnail_name"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $title = filter_var($_POST["title"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $body = filter_var($_POST["body"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $category_id = filter_var($_POST["category"], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = isset($_POST["is_featured"]) ? 1 : 0;
    $thumbnail = $_FILES["thumbnail"];

    // Validacion de los inputs
    if (!$title) {
        $_SESSION["edit-post"] = "No se pudo actualizar la publicacion. No se puede utilizar este titulo";
    } elseif (!$category_id) {
        $_SESSION["edit-post"] = "No se pudo actualizar la publicacion. No se puede utilizar esta categoria";
    } elseif (!$body) {
        $_SESSION["edit-post"] = "No se pudo actualizar la publicacion. No se ha podido actualizar el cuerpo de la publicacion";
    } else {
        // Por defecto usamos la miniatura anterior
        $thumbnail_to_insert = $previous_thumbnail_name;
        
        // Procesamos la nueva miniatura si se subió
        if ($thumbnail["name"] && $thumbnail["error"] === 0) {
            
            // Trabajamos con la nueva imagen
            $time = time();
            $thumbnail_name = $time . "_" . $thumbnail["name"];
            $thumbnail_tmp_name = $thumbnail["tmp_name"];
            $thumbnail_destination_path = "../images/" . $thumbnail_name;

            // Me aseguro de que el archivo es una imagen
            $allowed_files = ["png", "jpg", "jpeg"];
            $extention = explode(".", $thumbnail_name);
            $extention = strtolower(end($extention));
            
            if (in_array($extention, $allowed_files)) {

                // Nos aseguramos de que la imagen no sea pesada
                if ($thumbnail["size"] < 1000000) {
                    if (move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path)) {

                        // Solo si se subió correctamente, eliminamos la anterior y actualizamos
                        $previous_thumbnail_path = "../images/" . $previous_thumbnail_name;
                        if (file_exists($previous_thumbnail_path)) {
                            unlink($previous_thumbnail_path);
                        }
                        $thumbnail_to_insert = $thumbnail_name;
                    } else {
                        $_SESSION["edit-post"] = "Error al subir la imagen";
                    }
                } else {
                    $_SESSION["edit-post"] = "El archivo es demasiado grande. Máximo 1MB";
                }
            } else {
                $_SESSION["edit-post"] = "El archivo tiene que ser png, jpg o jpeg";
            }
        }
    }

    // Nos redirige a la pagina si existe algun problema
    if (isset($_SESSION["edit-post"])) {
        header("location: " . ROOT_URL . "admin/edit-post.php?id=" . $id);
        die();
    } else {
        // Si es una publicacion destacada, ponemos todos los demás a valor 0
        if ($is_featured == 1) {
            $zero_value = 0;
            $zero_all_is_featured_query = "UPDATE posts SET is_featured=?";
            $stmt_zero = mysqli_prepare($connection, $zero_all_is_featured_query);
            mysqli_stmt_bind_param($stmt_zero, "i", $zero_value);
            mysqli_stmt_execute($stmt_zero);
            mysqli_stmt_close($stmt_zero);
        }
        
        // Actualizamos la publicación en la base de datos
        $update_post_query = "UPDATE posts SET title=?, body=?, thumbnail=?, category_id=?, is_featured=? WHERE id=? LIMIT 1";
        $stmt = mysqli_prepare($connection, $update_post_query);
        mysqli_stmt_bind_param($stmt, "sssiii", $title, $body, $thumbnail_to_insert, $category_id, $is_featured, $id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_errno($stmt)) {
            $_SESSION["edit-post"] = "Error al actualizar la publicación: " . mysqli_stmt_error($stmt);
            header("location: " . ROOT_URL . "admin/edit-post.php?id=" . $id);
            die();
        } else {
            $_SESSION["edit-post-success"] = "Publicación actualizada correctamente";
            header("location: " . ROOT_URL . "admin/index.php");
            die();
        }
    }
} else {
    header("location: " . ROOT_URL . "admin/");
    die();
}
?>