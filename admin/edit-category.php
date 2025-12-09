<?php
include "partials/header.php";

if(isset($_GET["id"])){
    $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);

    // Hacemos fetch a la categoria de la base de datos
    $query = "SELECT * FROM categories WHERE id=?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $query_result = mysqli_stmt_get_result($stmt);
    $category = mysqli_fetch_assoc($query_result);


} else {
    header("location: " . ROOT_URL . "admin/manage-categories.php");
}
?>

    <section class="form__section">
        <div class="container form__section-container">
            <h2>Editar Categoria</h2>
            <form action="<?= ROOT_URL ?>admin/edit-category-logic.php" enctype="multipart/form-data" method="POST">
                <input type="hidden" name="id" value="<?= $category['id'] ?>">
                <input type="text" name="title" value="<?= $category['title'] ?>" placeholder="Titulo">
                <textarea rows="4" name="description" placeholder="Descripcion"><?= $category['description'] ?></textarea>
                <button type="submit" name="submit" class="btn">Actualizar</button>
            </form>
        </div>
    </section>

    <?php
include "../partials/footer.php";
?>