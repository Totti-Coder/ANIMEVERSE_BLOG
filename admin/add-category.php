<?php
include "partials/header.php";
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Agrega una categoria</h2>
        <div class="alert__message error">
            <p>Esto es un mensaje de error</p>
        </div>
        <form action="" enctype="multipart/form-data">
            <input type="text" placeholder="Titulo">
            <textarea name="" id="" cols="4" rows="10" placeholder="Descripcion"></textarea>
            <button type="submit" class="btn">Agregar</button>
        </form>
    </div>
</section>

<?php
include "../partials/footer.php";
?>