<?php
include "partials/header.php";
?>

<section class="form__section-add">
    <div class="container form__section-container-add">
        <h2>Nuevo usuario</h2>
        <div class="alert__message error-add">
            <p>Esto es un mensaje de error</p>
        </div>
        <form action="" enctype="multipart/form-data">
            <input type="text" placeholder="Nombre">
            <input type="text" placeholder="Nombre de usuario">
            <input type="email" placeholder="Email">
            <input type="password" placeholder="Crea tu contraseña">
            <input type="password" placeholder="Confirma tu contraseña">
            <select>
                <option value="0">Autor</option>
                <option value="1">Administrador</option>
            </select>
            <div class="form__control">
                <label for="avatar">Avatar del usuario</label>
                <input type="file" id="avatar">
            </div>
            <button type="submit" class="btn">Crear</button>
            <small>Ya tienes una cuenta? <a href="signin.html">Inicia Sesion</a></small>
        </form>
    </div>
</section>

<?php
include "../partials/footer.php";
?>