<?php
include "partials/header.php";
?>

<section class="dashboard">
    <?php if (isset($_SESSION["adduser-success"])): ?>
        <div class="alert__message success">
            <p>
                <?= $_SESSION["adduser-sucess"];
                unset($_SESSION["adduser-sucess"]);
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
                    <tr>
                        <td>Lucas Gomez</td>
                        <td>lucasg18</td>
                        <td><a href="edit-user.php" class="btn sm">Edit</a></td>
                        <td><a href="delete-category.php" class="btn sm danger">Delete</a></td>
                        <td>No</td>
                    </tr>
                    <tr>
                        <td>Marcos Perez</td>
                        <td>marianorajoy12</td>
                        <td><a href="edit-user.php" class="btn sm">Edit</a></td>
                        <td><a href="delete-category.php" class="btn sm danger">Delete</a></td>
                        <td>Si</td>
                    </tr>
                    <tr>
                        <td>Rigoberto Garcia</td>
                        <td>Capdesuru__</td>
                        <td><a href="edit-post.php" class="btn sm">Edit</a></td>
                        <td><a href="delete-category.php" class="btn sm danger">Delete</a></td>
                        <td>No</td>
                    </tr>
                </tbody>
            </table>
        </main>
    </div>

</section>
<?php
include "../partials/footer.php";
?>