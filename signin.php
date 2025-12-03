<?php
require "config/constants.php";

$username_email = $_SESSION["signin-data"]["username_email"] ?? '';
$password = $_SESSION["signin-data"]["password"] ?? '';

unset($_SESSION["signin-data"]);
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
            <h2>Inicia Sesion</h2>
            <?php
            if (isset($_SESSION["signup-sucess"])): ?>
                <div class="alert__message success">
                    <p>
                        <?= $_SESSION["signup-sucess"];
                        unset($_SESSION["signup-sucess"]);
                        ?>
                    </p>
                </div>
            <?php elseif(isset($_SESSION["signin"])) : ?>
                <div class="alert__message error">
                    <p>
                        <?= $_SESSION["signin"];
                        unset($_SESSION["signin"]);
                        ?>
                    </p>
                </div>
            <?php endif ?>
            <form action="<?= ROOT_URL ?>signin-logic.php" enctype="multipart/form-data" method="POST">
                <input type="text" name="username_email" value="<?= $username_email ?>" placeholder="Usuario o Email">
                <input type="password" name="password" value="<?= $password ?>" placeholder="Contraseña">
                <button type="submit" name="submit" class="btn">Iniciar Sesion</button>
                <small>No tienes una cuenta? <a href="signup.php">Registrate</a></small>
            </form>
        </div>
    </section>
</body>

</html>