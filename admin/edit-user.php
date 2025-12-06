<?php
include "partials/header.php";

if(isset($_GET["id"])) {
    $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
}
?>

    <section class="form__section-add">
        <div class="container form__section-container-add">
            <div class="user-edit">
                <h2>Editar usuario</h2>

                <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" enctype="multipart/form-data" method="POST">
                    <input type="text" name="nombre" placeholder="Nombre">
                    <input type="text" name="username" placeholder="Nombre de usuario">
                    <input type="email" name="email" placeholder="Email">
                    <select>
                        <option value="0">Autor</option>
                        <option value="1">Administrador</option>
                    </select>
                    <button type="submit" name="submit" class="btn">Crear</button>
            </div>
            </form>
        </div>
    </section>

    <?php
    include "../partials/footer.php";
    ?>