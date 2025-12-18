<?php
require "partials/header.php";

if (isset($_GET["id"])) {
    $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);

    // Buscamos el usuario en la base de datos
    $query = "SELECT * FROM users WHERE id=?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $query_result = mysqli_stmt_get_result($stmt);

    // Convertimos en array asociativo
    $user = mysqli_fetch_assoc($query_result);

    // Aseguramos que solo puede devolver un usuario
    if (mysqli_num_rows($query_result) == 1) {
        $avatar_name = $user["avatar"];
        $avatar_path = "../images/" . $avatar_name;
        // Eliminamos la imagen si existe en la carpeta
        if ($avatar_path) {
            unlink($avatar_path);
        }
    }


    // Hacemos fetch de todos los thumbnail sobre las publicaciones de los usuarios y la eliminamos
    $thumbnails_query = "SELECT thumbnail FROM posts WHERE author_id=?";
    $stmt = mysqli_prepare($connection, $thumbnails_query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $thumbnails_query_result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($thumbnails_query_result) > 0) {
        while($thumbnail = mysqli_fetch_assoc($thumbnails_query_result)){
            $thumbnail_destination_path = "../images/" . $thumbnail["thumbnail"];
            // Eliminamos la miniatura de la carpeta
            if($thumbnail_destination_path){
                unlink($thumbnail_destination_path);
            }
        }
    }

    
    // Eliminamos el usuario de la base de datos
    $delete_user_query = "DELETE FROM users WHERE id=?";
    $stmt = mysqli_prepare($connection, $delete_user_query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    if (mysqli_errno($connection)) {
        $_SESSION["delete-user"] = "No se pudo eliminar al usuario '{$user["username"]}'.";
    } else {
        $_SESSION["delete-user-success"] = "El usuario '{$user["username"]}' se ha eliminado correctamente.";
    }
}
header("location: " . ROOT_URL . "admin/manage-users.php");
die();