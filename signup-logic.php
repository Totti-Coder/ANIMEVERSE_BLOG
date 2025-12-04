<?php
require "config/constants.php";
require "config/database.php";

if(isset($_POST["submit"])) {
    $nombre = filter_var($_POST["nombre"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $username = filter_var($_POST["username"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $createpassword = filter_var($_POST["createpassword"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmpassword = filter_var($_POST["confirmpassword"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $avatar = $_FILES["avatar"];


    // Validacion de los inputs
    if(!$nombre) {
        $_SESSION["signup"] = "Por favor, escribe tu nombre";
    }
    elseif(!$username) {
        $_SESSION["signup"] = "Por favor, escribe tu nombre de usuario";
    }
    elseif(!$email) {
        $_SESSION["signup"] = "Por favor, escribe un correo valido";
    }
    elseif(strlen($createpassword) < 8 || strlen($confirmpassword) < 8) {
        $_SESSION["signup"] = "La contraseña debe tener mas de 8 caracteres";
    }
    elseif(!$avatar["name"]) {
        $_SESSION["signup"] = "Por favor, agrega un avatar";
    } else {
        // Comprobacion de que las contraseñas son iguales
        if($createpassword !== $confirmpassword){
            $_SESSION["signup"] = "Las contraseñas no coinciden";
        } else {
            // Hasheamos las contraseñas
            $hashed_password = password_hash($createpassword, PASSWORD_DEFAULT);

            // Compruebo que el usuario y el correo electronico realmente existen ya en la base de datos
            $user_check_query = "SELECT * FROM users WHERE username=? OR email=?";
            $stmt = mysqli_prepare($connection, $user_check_query);

            mysqli_stmt_bind_param($stmt, "ss", $username, $email);

            mysqli_stmt_execute($stmt);

            $user_check_result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($user_check_result) > 0){
                $_SESSION["signup"] = "El usuario o email ya existen";
            } else {
                // Trabajamos con el avatar
                // Renombramos el avatar
                $time = time(); // Hacemos que cada imagen tenga un nombre distinto y unico usando la fecha actual
                $avatar_name = $time . $avatar["name"];
                $avatar_tmp_name= $avatar["tmp_name"];
                $avatar_destination_path = "images/" . $avatar_name;

                // Me aseguro de que el archivo es una imagen
                $allowed_files = ["png", "jpg", "jpeg"];
                $extention = explode(".", $avatar_name);
                $extention = end($extention);
                if (in_array($extention, $allowed_files)){
                    // Nos aseguramos de que la imagen so sea pesada
                    if($avatar["size"] < 1000000){
                        move_uploaded_file($avatar_tmp_name, $avatar_destination_path);
                    } else {
                        $_SESSION["signup"] = "El archivo es demasiado grande";
                    }
                } else {
                    $_SESSION["signup"] = "El archivo tiene que ser png, jpg o jpeg";
                }
            }
        } 
    } 
    // Nos redirige a la pagina de registro si existe algun problema
    if($_SESSION["signup"]) {
        // Pasamos los datos recopilados a la pagina de registro
        $_SESSION["signup-data"] = $_POST;
        header("location: " . ROOT_URL . "signup.php");
        die();
    } else {
        // Insertamos nuevo usuario en la tabla de usuarios
        $insert_user_query = "INSERT INTO users (nombre, username, email, contraseña, avatar, is_admin) VALUES(?, ?, ?, ?, ?, 0)";
        $stmt = mysqli_prepare($connection, $insert_user_query);
        mysqli_stmt_bind_param($stmt, "sssss", $nombre, $username, $email, $hashed_password, $avatar_name);
        mysqli_stmt_execute($stmt);

        if(mysqli_stmt_errno($stmt)){
            // Si hay error en la inserción
            $_SESSION["signup"] = "Error al registrar usuario. Por favor intenta de nuevo.";
            $_SESSION["signup-data"] = $_POST;
            header("location: " . ROOT_URL . "signup.php");
            die();
        } else {
            // Registro exitoso
            $_SESSION["signup-success"] = "El registro ha sido exitoso. Por favor inicia sesion";
            // Limpiamos los datos del formulario
            unset($_SESSION["signup-data"]);
            header("location: " . ROOT_URL . "signin.php");
            die();
        }
    }
    
} else {
    // Si no se hizo click en el boton y se intenta acceder a la logica, redirige a la pagina de registro
    header("location: " . ROOT_URL . "signup.php");
    die();
}
?>
