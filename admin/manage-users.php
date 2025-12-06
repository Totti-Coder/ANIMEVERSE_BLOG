<?php
include "partials/header.php";

// Consulta a la base de datos evitando eliminar nuestra sesion de administrador
$current_admin_id = $_SESSION["user-id"];
$query = "SELECT * FROM users WHERE NOT id=? ORDER BY id DESC";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "i", $current_admin_id);
mysqli_stmt_execute($stmt);
$users = mysqli_stmt_get_result($stmt);
?>

<section class="dashboard">
    <?php if (isset($_SESSION["adduser-success"])): ?>
        <div class="alert__message success container">
            <p>
                <?= $_SESSION["adduser-success"];
                unset($_SESSION["adduser-success"]);
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
                        <a href="manage-users.php" class="active"><i class="uil uil-users-alt"></i></i>
                            <h5>Gestionar usuarios</h5>
                        </a>
                    </li>
                    <li>
                        <a href="add-category.php"><i class="uil uil-edit"></i></i>
                            <h5>Crear Categoria</h5>
                        </a>
                    </li>
                    <li>
                        <a href="manage-categories.php"><i class="uil uil-clipboard-notes"></i></i>
                            <h5>Gestionar Categorias</h5>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Gestionar Usuarios</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Usuario</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($user = mysqli_fetch_assoc($users)) : ?>
                    <tr>
                        <td><?= $user['nombre'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><a href="<?= ROOT_URL ?>admin/edit-user.php?id=<?= $user['id'] ?>" class="btn sm">Edit</a></td>
                        <td><a href="<?= ROOT_URL ?>admin/delete-user.php?id=<?= $user['id'] ?>" class="btn sm danger">Delete</a></td>
                        <td><?= $user['is_admin'] ? 'Si' : 'No' ?></td>
                    </tr>
                    <?php endwhile ?>
                </tbody>
            </table>
        </main>
    </div>

</section>
<?php
include "../partials/footer.php";
?>