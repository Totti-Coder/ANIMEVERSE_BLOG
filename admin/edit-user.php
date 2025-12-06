<?php
include "partials/header.php";

if(isset($_GET["id"])) {
    $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);
    $query = "SELECT * FROM users WHERE id=?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $query_result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($query_result);
} else {
    header("location: " . ROOT_URL . "admin/manage-users.php");
    die();
}
?>

    <section class="form__section-add">
        <div class="container form__section-container-add">
            <div class="user-edit">
                <h2>Editar usuario</h2>

                <form action="<?= ROOT_URL ?>admin/edit-user-logic.php" enctype="multipart/form-data" method="POST">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <input type="text" value="<?= $user["nombre"]?>" name="nombre" placeholder="Nombre">
                    <input type="text" value="<?= $user["username"]?>" name="username" placeholder="Nombre de usuario">
                    <input type="email" value="<?= $user["email"]?>" name="email" placeholder="Email">
                    <select name="userrole">
                        <option value="0" <?= $user['is_admin'] == 0 ? 'selected' : '' ?>>Autor</option>
                        <option value="1" <?= $user['is_admin'] == 1 ? 'selected' : '' ?>>Administrador</option>
                    </select>
                    <button type="submit" name="submit" class="btn">Editar</button>
            </div>
            </form>
        </div>
    </section>

    <?php
    include "../partials/footer.php";
    ?>