<?php
include "partials/header.php";

// Consulta a la base de datos las categorias
$query = "SELECT * FROM categories ORDER BY title";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_execute($stmt);
$categories = mysqli_stmt_get_result($stmt);
?>
<section class="dashboard">
    <?php if (isset($_SESSION["add-category-success"])): // Muestra si al agregar una categoria todo funciono correctamente ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION["add-category-success"];
                unset($_SESSION["add-category-success"]);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION["add-category"])): // Muestra si al agregar una categoria hubo algun fallo ?>
        <div class="alert__message error-add">
            <p>
                <?= $_SESSION["add-category"];
                unset($_SESSION["add-category"]);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION["edit-category"])): // Muestra si al editar una categoria hubo algun fallo ?>
        <div class="alert__message error-add">
            <p>
                <?= $_SESSION["edit-category"];
                unset($_SESSION["edit-category"]);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION["edit-category-success"])):// Muestra si al editar una categoria todo salio correctamente ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION["edit-category-success"];
                unset($_SESSION["edit-category-success"]);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION["delete-category-success"])):// Muestra si al eliminar una categoria todo salio correctamente ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION["delete-category-success"];
                unset($_SESSION["delete-category-success"]);
                ?>
            </p>
        </div>
    <?php elseif (isset($_SESSION["delete-category"])):// Muestra si al eliminar una categoria hubo algun fallo ?>
        <div class="alert__message error-add">
            <p>
                <?= $_SESSION["delete-category"];
                unset($_SESSION["delete-category"]);
                ?>
            </p>
        </div>
    <?php endif ?>
    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left"></i></button>
        <aside>
            <ul>
                <li>
                    <a href="add-post.php"><i class="uil uil-pen"></i>
                        <h5>Crear Publicacion</h5>
                    </a>
                </li>
                <li>
                    <a href="index.php"><i class="uil uil-postcard"></i></i>
                        <h5>Gestionar Publicaciones</h5>
                    </a>
                </li>
                <?php if (isset($_SESSION["user_is_admin"])): ?>
                    <li>
                        <a href="add-user.php"><i class="uil uil-user-check"></i></i>
                            <h5>Crear Usuario</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-users.php"><i class="uil uil-users-alt"></i></i>
                            <h5>Gestionar usuarios</h5>
                        </a>
                    </li>
                    <li>
                        <a href="add-category.php"><i class="uil uil-edit"></i></i>
                            <h5>Crear Categoria</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-categories.php" class="active"><i class="uil uil-clipboard-notes"></i></i>
                            <h5>Gestionar Categorias</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Gestionar Categorias</h2>
            <?php if (mysqli_num_rows($categories) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Titulo</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($category = mysqli_fetch_assoc($categories)): ?>
                            <tr>
                                <td><?= $category['title'] ?></td>

                                <td><a href="<?= ROOT_URL ?>admin/edit-category.php?id=<?= $category['id'] ?>"
                                        class="btn sm">Edit</a>
                                </td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-category.php?id=<?= $category['id'] ?>"
                                        class="btn sm danger">Delete</a></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert__message error"><?= "No se han encontrado categorias" ?></div>
            <?php endif ?>
        </main>
    </div>

</section>
<?php
include "../partials/footer.php";
?>