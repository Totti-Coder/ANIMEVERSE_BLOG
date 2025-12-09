<?php
include "partials/header.php";

// Hacemos fetch de las categorias de la base de datos
$query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $query);
?>

<section class="form__section-add">
    <div class="container form__section-container-add">
        <h2>Agrega un articulo</h2>
        <div class="alert__message error-add">
            <p>Esto es un mensaje de error</p>
        </div>
        <form action="<?= ROOT_URL ?>admin/add-post-logic" enctype="multipart/form-data" method="POST">
            <input type="text" name="title" placeholder="Titulo">
            <select name="category">
                <?php while($category = mysqli_fetch_assoc($categories)): ?>
                    <option value="<?= $category["id"]?>"><?= $category["title"]?></option>
                <?php endwhile ?>

            </select>
            <textarea rows="10" name="body" placeholder="Cuerpo"></textarea>
            <?php if(isset($_SESSION["user_is_admin"])): ?>
            <div class="form__control checkbox-row">
                <input type="checkbox"name="is_featured" value="1" id="is_featured" checked>
                <label for="is_featured">Destacado</label>
            </div>
            <?php endif ?>
            <div class="form__control">
                <label for="thumbnail">Agrega una imagen</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <button type="submit" name="submit" class="btn">Agregar</button>
        </form>
    </div>
</section>

<?php
include "../partials/footer.php";
?>