<?php
include "partials/header.php";

// Conseguimos las categorias de la base de datos
$category_query = "SELECT * FROM categories";
$categories = mysqli_query($connection, $category_query);

// Obtenemos la data de la peticion post de la base de datos a traves del id
if(isset($_GET["id"])) {
    $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM posts WHERE id=?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $query_result = mysqli_stmt_get_result($stmt);
    $post = mysqli_fetch_assoc($query_result);
} else {
    header("location: " . ROOT_URL . "admin/");
    die();
}
?>

<section class="form__section-add">
    <div class="container form__section-container-add">
        <h2>Editar Publicacion</h2>
        <?php if(isset($_SESSION["edit-post"])): ?>
            <div class="alert__message error">
                <p>
                    <?= $_SESSION["edit-post"];
                    unset($_SESSION["edit-post"]);
                    ?>
                </p>
            </div>
        <?php endif ?>
        <form action="<?= ROOT_URL ?>admin/edit-post-logic.php" enctype="multipart/form-data" method="POST">
            <input type="hidden" value="<?= $post["id"] ?>" name="id">
            <input type="hidden" value="<?= $post["thumbnail"] ?>" name="previous_thumbnail_name">
            <input type="text" value="<?= $post["title"] ?>" name="title" placeholder="Titulo">
            <select name="category" id="">
                <?php while ($category = mysqli_fetch_assoc($categories)): ?>
                <option value="<?= $category["id"] ?>" <?= $category["id"] == $post["category_id"] ? 'selected' : '' ?>><?= $category["title"] ?></option>
                <?php endwhile ?>
            </select>
            <textarea rows="10" name="body" placeholder="Cuerpo"><?= $post["body"] ?></textarea>
            <div class="form__control checkbox-row">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" <?= $post["is_featured"] ? 'checked' : '' ?>>
                <label for="is_featured">Destacado</label>
            </div>
            <div class="form__control">
                <label for="thumbnail">Actualizar imagen</label>
                <input type="file" name="thumbnail" id="thumbnail">
            </div>
            <button type="submit" name="submit" class="btn">Actualizar</button>
        </form>
    </div>
</section>

<?php
include "../partials/footer.php";
?>