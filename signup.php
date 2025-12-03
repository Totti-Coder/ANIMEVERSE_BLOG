<?php
require "config/constants.php";

// devolvemos la data del formulario si hubo algun error en el registro
$nombre = $_SESSION["signup-data"]["nombre"] ?? '';
$username = $_SESSION["signup-data"]["username"] ?? '';
$email = $_SESSION["signup-data"]["email"] ?? '';
$createpassword = $_SESSION["signup-data"]["createpassword"] ?? '';
$confirmpassword= $_SESSION["signup-data"]["confirmpassword"] ?? '';

// eliminamos los datos del registro de la sesion
unset($_SESSION["signup-data"]);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FULL STACK BLOG APPLICATION</title>
    <!-- CUSTOM STYLESHEET -->
    <link rel="stylesheet" href="./css/styles.css">
    <!-- ICONSCOUT CDN-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.2.0/css/line.css">
    <!-- MONTSERRAT FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>
<body>
<section class="form__section">
    <div class="container form__section-container">
        <h2>Registro</h2>
        <?php
            if(isset($_SESSION["signup"])): ?> 
                <div class="alert__message error">
            <p>
                <?= $_SESSION["signup"];
                unset($_SESSION["signup"]); 
                ?>
        </p>
            
        </div>
        <?php endif

        ?>
        <form action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="nombre" value="<?= $nombre ?>" placeholder="Nombre">
            <input type="text" name="username" value="<?= $username ?>" placeholder="Usuario">
            <input type="email" name="email" value="<?= $email ?>" placeholder="Email">
            <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Crea tu contraseña">
            <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirma tu contraseña">
            <div class="form__control">
                <label for="avatar">Avatar del usuario</label>
                    <input type="file" name="avatar" id="avatar">  
            </div>
            <button type="submit" name="submit" class="btn">Registrate</button>
            <small>Ya tienes una cuenta? <a href="signin.php">Inicia Sesion</a></small>
        </form>
    </div>
</section>
</body>
</html>