<?php
include "partials/header.php";
?>

<section class="dashboard">
    <div class="container dashboard__container">
        <button id="show__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-right"></i></button>
        <button id="hide__sidebar-btn" class="sidebar__toggle"><i class="uil uil-angle-left"></i></button>
        <aside>
            <ul>
                <li>
                    <a href="<?= ROOT_URL ?>admin/add-post.php"><i class="uil uil-pen"></i>
                        <h5>Crear Publicacion</h5>
                    </a>
                </li>
                <li>
                    <a href="<?= ROOT_URL ?>admin/index.php" class="active"><i class="uil uil-postcard"></i></i>
                        <h5>Gestionar Publicaciones</h5>
                    </a>
                </li>
                <?php if(isset($_SERVER["user_is_admin"])): ?>
                <li>
                    <a href="<?= ROOT_URL ?>admin/add-user.php"><i class="uil uil-user-check"></i></i>
                        <h5>Crear Usuario</h5>
                    </a>
                </li>
                <li>
                    <a href="<?= ROOT_URL ?>admin/manage-users.php"><i class="uil uil-users-alt"></i></i>
                        <h5>Gestionar usuarios</h5>
                    </a>
                </li>
                <li>
                    <a href="<?= ROOT_URL ?>admin/add-category.php"><i class="uil uil-edit"></i></i>
                        <h5>Crear Categoria</h5>
                    </a>
                </li>
                <li>
                    <a href="<?= ROOT_URL ?>admin/manage-categories.php"><i class="uil uil-clipboard-notes"></i></i>
                        <h5>Gestionar Categorias</h5>
                    </a>
                </li>
                <?php endif ?>
            </ul>
        </aside>
        <main>
            <h2>Gestionar Publicaciones</h2>
            <table>
                <thead>
                    <tr>
                        <th>Titulo</th>
                        <th>Categoria</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing.</td>
                        <td>One Piece</td>
                        <td><a href="admin/edit-post.php" class="btn sm">Edit</a></td>
                        <td><a href="admin/delete-category.php" class="btn sm danger">Delete</a></td>
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing.</td>
                        <td>Jujutsu Kaisen</td>
                        <td><a href="admin/edit-post.php" class="btn sm">Edit</a></td>
                        <td><a href="admin/delete-category.php" class="btn sm danger">Delete</a></td>
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet consectetur adipisicing.</td>
                        <td>Dragon Ball</td>
                        <td><a href="admin/edit-post.php" class="btn sm">Edit</a></td>
                        <td><a href="admin/delete-category.php" class="btn sm danger">Delete</a></td>
                    </tr>

                </tbody>
            </table>
        </main>
    </div>

</section>
<?php
include "../partials/footer.php";
?>