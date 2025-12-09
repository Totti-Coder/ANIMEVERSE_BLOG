<?php
require "partials/header.php";

if (isset($_POST["submit"])) {
    $author_id = $_SESSION["user-id"];
    $title = htmlspecialchars($_POST["title"], ENT_QUOTES, 'UTF-8');
    $body = htmlspecialchars($_POST["body"], ENT_QUOTES, 'UTF-8');
    $category_id = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
    $is_featured = filter_var($_POST['is_featured'], FILTER_SANITIZE_NUMBER_INT);
    $thumbnail = $_FILES["thumbnail"];

    // Establecer el destacado a cero si no esta chequeado
    $is_featured = $is_featured == 1 ?: 0;

    // Validamos los datos
    if (!$title) {
        $_SESSION["add-post"] = "Escribe el titulo de la publicacion";
    } elseif (!$category_id) {
        $_SESSION["add-post"] = "Elige una categoria";
    } elseif (!$body) {
        $_SESSION["add-post"] = "Debes escribir un cuerpo en la publicacion";
    } elseif (!$thumbnail["name"]) {
        $_SESSION["add-post"] = "Escoge una miniatura para la publicacion";
    } else {
        // Trabajamos con la miniatura
        // Renombramos la imagen
        $time = time();
        $thumbnail_name = $time . $thumbnail["name"];
        $thumbnail_tmp_name = $thumbnail["tmp_name"];
        $thumbnail_destination_path = "../images/" . $thumbnail_name;

        // Nos aseguramos de que el archivo sea una imagen
        $allowed_files = ["png", "jpeg", "jpg"];
        $extension = explode(".", $thumbnail_name);
        $extension = end($extension);
        var_dump($extension);

        if (in_array($extension, $allowed_files)) {
            // Nos aseguramos de que la imagen no sea muy pesada (+2mb)
            if ($thumbnail["size"] < 2000000) {
                // Subimos la miniatura
                move_uploaded_file($thumbnail_tmp_name, $thumbnail_destination_path);

            } else {
                $_SESSION["add-post"] = "El archivo es demasiado pesado. Debe ser de menos de 2mb";
            }
        } else {
            $_SESSION["add-post"] = "El archivo deberia ser png, jpg o jpeg";
        }
    }
}