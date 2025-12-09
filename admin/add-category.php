<?php
include "partials/header.php";

// Obtener la data del formulario si hubo un error
$title = $_SESSION["add-category-data"]["title"] ?? null;
$description = $_SESSION["add-category-data"]["description"] ?? null;

// Eliminamos los datos de la sesion
unset($_SESSION["add-category-data"]);
?>

<section class="form__section">
    <div class="container form__section-container">
        <h2>Agrega una categoria</h2>
        <?php if (isset($_SESSION["add-category"])): ?>
            <div class="alert__message error-add">
                <p>
                    <?= $_SESSION["add-category"];
                    unset($_SESSION["add-category"]);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>/admin/add-category-logic.php" enctype="multipart/form-data" method="POST">
            <input type="text" name="title" value="<?= $title ?>"placeholder="Titulo">
            <textarea name="description" cols="4" rows="10" placeholder="Descripcion"><?= $description ?></textarea>
            <button type="submit" name="submit" class="btn">Agregar</button>
        </form>
    </div>
</section>

<?php
include "../partials/footer.php";
?>