<?php
include "partials/header.php";
?>

<section class="form__section-add">
    <div class="container form__section-container-add">
        <h2>Editar Articulo</h2>
        <form action="" enctype="multipart/form-data">
            <input type="text" placeholder="Titulo">
            <select name="" id="">
                <option value="1">Dragon Ball</option>
                <option value="2">One Piece</option>
                <option value="3">Demon Slayer</option>
                <option value="4">Hunter x Hunter</option>
                <option value="5">Jujustu Kaisen</option>
                <option value="6">Naruto</option>
            </select>
            <textarea rows="10" placeholder="Cuerpo"></textarea>
            <div class="form__control checkbox-row">
                <input type="checkbox" id="is_featured" checked>
                <label for="is_featured">Destacado</label>
            </div>
            <div class="form__control">
                <label for="thumbnail">Actualizar Imagen</label>
                <input type="file" id="thumbnail">
            </div>
            <button type="submit" class="btn">Actualizar</button>
        </form>
    </div>
</section>

<?php
include "../partials/footer.php";
?>