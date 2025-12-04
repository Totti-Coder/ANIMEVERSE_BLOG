<?php
require "config/constants.php";  
require "config/database.php";

// Extraemos los datos del usuario de la db
if(isset($_SESSION["user-id"])) {
    $id = filter_var($_SESSION["user-id"], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=?";
    $stmt = mysqli_prepare($connection, $query);

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);

    $query_result = mysqli_stmt_get_result($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FULL STACK BLOG APPLICATION</title>
    <!-- CUSTOM STYLESHEET -->
    <link rel="stylesheet" href="<?= ROOT_URL ?>css/styles.css">
    <!-- ICONSCOUT CDN-->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.2.0/css/line.css">
    <!-- MONTSERRAT FONT -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <nav>
        <div class="container nav__container">
            <a href="<?= ROOT_URL ?>" class="nav__logo">ANIMEVERSE</a>
            <ul class="nav__items">
                <li><a href="<?= ROOT_URL ?>blog.php">Blog</a></li>
                <li><a href="<?= ROOT_URL ?>about.php">Que somos?</a></li>
                <li><a href="<?= ROOT_URL ?>services.php">Servicios</a></li>
                <li><a href="<?= ROOT_URL ?>contact.php">Contacto</a></li>
                <?php if(isset($_SESSION["user-id"])): ?>
                    <li class="nav__profile">
                    <div class="avatar">
                        <img src="<?= ROOT_URL . "images/" . $avatar ?>" >
                    </div>
                    <ul>
                        <li><a href="<?= ROOT_URL ?>index.php">Panel de control</a></li>
                        <li><a href="<?= ROOT_URL ?>logout.php">Cerrar Sesion</a></li>
                    </ul>
                </li>
                <?php else : ?>
                <li><a href="<?= ROOT_URL ?>signin.php">Iniciar Sesion</a></li>
                <?php endif ?>
            </ul>
            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>
    <!-- END OF NAV -->