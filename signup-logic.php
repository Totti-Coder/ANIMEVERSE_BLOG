<?php
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
            echo $createpassword . "<br/>";
            echo $hashed_password;
        }
    }
} else {
    // Si no se hizo click en el boton y se intenta acceder a la logica, redirige a la pagina de registro
    header("location: " . ROOT_URL . "signup.php");
    die();
}
?>
