<?php
require "config/database.php";

if (isset($_POST["submit"])) {
    // Obtenemos los datos del formulario
    $username_email = filter_var($_POST["username_email"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_var($_POST["password"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (!$username_email) {
        $_SESSION["signin"] = "Introduzca su usuario o email";
    } elseif (!$password) {
        $_SESSION["signin"] = "Introduzca la contraseña";
    } else {
        $fetch_user_query = "SELECT * FROM users WHERE username=? OR email=?";
        $stmt = mysqli_prepare($connection, $fetch_user_query);

        mysqli_stmt_bind_param($stmt, "ss", $username_email, $username_email);

        mysqli_stmt_execute($stmt);

        $fetch_user_result = mysqli_stmt_get_result($stmt);

        if(mysqli_num_rows($fetch_user_result) == 1) {
            // Convertimos en un array asociativo
            $user_record = mysqli_fetch_assoc($fetch_user_result);
            $db_password = $user_record["contraseña"];

            //Comparamos la password con la de la base de datos
            if(password_verify($password, $db_password)) {
                //
            }
        } else {
            $_SESSION["signin"] = "El usuario no ha sido encontrado";
        }
    }

} else {
    header("location: " . ROOT_URL . "signin.php");
    die();
}