<?php
include "partials/header.php";

// Hacemos fetch a las publicaciones de los usuarios
$current_user_id = $_SESSION["user-id"];

$query = "SELECT posts.id, posts.title, categories.title as category_title 
          FROM posts 
          JOIN categories ON posts.category_id = categories.id
          WHERE posts.author_id = ? 
          ORDER BY posts.id DESC";



$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "i", $current_user_id);
mysqli_stmt_execute($stmt);
$posts = mysqli_stmt_get_result($stmt);
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
                <?php if (isset($_SESSION["user_is_admin"])): ?>
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
            <?php if (mysqli_num_rows($posts) > 0): ?>
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
                        <?php while ($post = mysqli_fetch_assoc($posts)): ?>
                            <tr>
                                <td><?= $post['title'] ?></td>
                                <td><?= $post['category_title'] ?></td>
                                <td><a href="<?= ROOT_URL ?>admin/edit-post.php?id=<?= $post['id'] ?>" class="btn sm">Edit</a>
                                </td>
                                <td><a href="<?= ROOT_URL ?>admin/delete-post.php?id=<?= $post['id'] ?>"
                                        class="btn sm danger">Delete</a></td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert__message error"><?= "No se han encontrado usuarios" ?></div>
            <?php endif ?>
        </main>
    </div>

</section>
<?php
include "../partials/footer.php";
?>