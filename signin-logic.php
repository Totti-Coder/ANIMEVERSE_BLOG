<?php
require_once "config/constants.php";
require_once "config/database.php";

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
                // Establezcemos una sesion para el control de acceso
                $_SESSION["user-id"] = $user_record["id"];
                // Comprobamos que el usuario es administrador o no
                if($user_record["is_admin"] == 1){
                    $_SESSION["user_is_admin"] = true;
                }

                // Inicio de sesion como admin
                header("location: " . ROOT_URL . "admin/");
            } else {
                $_SESSION["signin"] = "Por favor, comprueba que todo este correcto";
            }
        } else {
            $_SESSION["signin"] = "El usuario no ha sido encontrado";
        }
    }


    // Si existe algun problema, redirigimos a la pagina de inicio de sesion con los datos recopilados
    if(isset($_SESSION["signin"])) {
        $_SESSION["signin-data"] = $_POST;
        header("location: " . ROOT_URL . "signin.php");
        die();
    }


} else {
    header("location: " . ROOT_URL . "signin.php");
    die();
}