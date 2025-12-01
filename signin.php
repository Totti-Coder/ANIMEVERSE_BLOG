<?php
require "config/constants.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Multipage Blog Website</title>
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
        <h2>Inicia Sesion</h2>
        <div class="alert__message error">
            <p>Esto es un mensaje de error</p>
        </div>
        <form action="<?= ROOT_URL ?>signup-logic.php" enctype="multipart/form-data">
            <input type="text" placeholder="Usuario o Email">
            <input type="password" placeholder="Contraseña">
            <button type="submit" class="btn">Iniciar Sesion</button>
            <small>No tienes una cuenta? <a href="signup.php">Registrate</a></small>
        </form>
    </div>
</section>
</body>
</html>