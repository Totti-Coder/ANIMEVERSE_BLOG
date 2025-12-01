<?php
require(__DIR__ . '/../config/constants.php');  // PRIMERO las constantes
require(__DIR__ . '/../config/database.php');   // LUEGO la base de datos
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
                <li><a href="<?= ROOT_URL ?>signin.php">Iniciar Sesion</a></li>
                <li class="nav__profile">
                    <div class="avatar">
                        <img src="<?= ROOT_URL ?>images/blog1.jpg">
                    </div>
                    <ul>
                        <li><a href="<?= ROOT_URL ?>admin/index.php">Panel de control</a></li>
                        <li><a href="<?= ROOT_URL ?>logout.php">Cerrar Sesion</a></li>
                    </ul>
                </li>
            </ul>
            <button id="open__nav-btn"><i class="uil uil-bars"></i></button>
            <button id="close__nav-btn"><i class="uil uil-multiply"></i></button>
        </div>
    </nav>
    <!-- END OF NAV -->