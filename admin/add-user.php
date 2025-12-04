<?php
include "partials/header.php";

// Obtener la data del formulario si hubo un error
$nombre = $_SESSION["adduser-data"]["nombre"] ?? '';
$username = $_SESSION["adduser-data"]["username"] ?? '';
$email = $_SESSION["adduser-data"]["email"] ?? '';
$createpassword = $_SESSION["adduser-data"]["createpassword"] ?? '';
$confirmpassword= $_SESSION["adduser-data"]["confirmpassword"] ?? '';

// Eliminamos los datos de la sesion
unset($_SESSION["adduser-data"]);
?>

<section class="form__section-add">
    <div class="container form__section-container-add">
        <h2>Nuevo usuario</h2>
        <?php if(isset($_SESSION["add-user"])) : ?>
            <div class="alert__message error-add">
            <p>
                <?= $_SESSION["add-user"];
                unset($_SESSION["add-user"]);
                 ?>
        </p>
        </div>
        <?php endif ?>

        <form action="<?= ROOT_URL ?>admin/add-user-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="nombre" value="<?= $nombre ?>" placeholder="Nombre">
            <input type="text"  name="username" value="<?= $username ?>" placeholder="Nombre de usuario">
            <input type="email" name="email" value="<?= $email ?>" placeholder="Email">
            <input type="password" name="createpassword" value="<?= $createpassword ?>" placeholder="Crea tu contraseña">
            <input type="password" name="confirmpassword" value="<?= $confirmpassword ?>" placeholder="Confirma tu contraseña">
            <select name="userrole">
                <option value="0">Autor</option>
                <option value="1">Administrador</option>
            </select>
            <div class="form__control">
                <label for="avatar">Avatar del usuario</label>
                <input type="file" name="avatar" id="avatar">
            </div>
            <button type="submit" name="submit" class="btn">Crear</button>
        </form>
    </div>
</section>

<?php
include "../partials/footer.php";
?>