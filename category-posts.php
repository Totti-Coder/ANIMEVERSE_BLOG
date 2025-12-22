<?php
include "partials/header.php";

if (isset($_GET["id"])) {
    $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);

    // Consultamos el nombre de la categoria actual
    $category_query = "SELECT title FROM categories WHERE id = ?";
    $category_stmt = mysqli_prepare($connection, $category_query);
    mysqli_stmt_bind_param($category_stmt, "i", $id);
    mysqli_stmt_execute($category_stmt);
    $category_result = mysqli_stmt_get_result($category_stmt);
    $category_row = mysqli_fetch_assoc($category_result);

    // Consulta para obtener todos los posts de esa categoría con sus autores
    $posts_query = "SELECT p.*, u.nombre AS author_name, u.avatar AS author_avatar FROM posts p JOIN users u ON p.author_id = u.id WHERE p.category_id = ? ORDER BY p.date_time DESC";
    $posts_stmt = mysqli_prepare($connection, $posts_query);
    mysqli_stmt_bind_param($posts_stmt, "i", $id);
    mysqli_stmt_execute($posts_stmt);
    $posts_result = mysqli_stmt_get_result($posts_stmt);

} else {
    header("location: " . ROOT_URL . "blog.php");
    die();
}

$meses = ['Jan' => 'Ene', 'Feb' => 'Feb', 'Mar' => 'Mar', 'Apr' => 'Abr', 'May' => 'May', 'Jun' => 'Jun', 'Jul' => 'Jul', 'Aug' => 'Ago', 'Sep' => 'Sep', 'Oct' => 'Oct', 'Nov' => 'Nov', 'Dec' => 'Dic'];
?>

<header class="category__title">
    <h2><?= $category_row['title'] ?? 'Categoría no encontrada' ?></h2>
</header>

<section class="posts">
    <div class="container posts__container">
        <?php if (mysqli_num_rows($posts_result) > 0): ?>
            <?php while ($post = mysqli_fetch_assoc($posts_result)): ?>
                <?php
                $fecha = date("d M, Y - H:i", strtotime($post['date_time']));
                $fecha_final = strtr($fecha, $meses);
                ?>
                <article class="post">
                    <div class="post__thumbnail">
                        <img src="./images/<?= $post['thumbnail'] ?>" alt="<?= $post['title'] ?>">
                    </div>
                    <div class="post__info">
                        <h3 class="post__title">
                            <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                        </h3>
                        <p class="post__body">
                            <?= substr($post['body'], 0, 150) ?>...
                        </p>
                        <div class="post__author">
                            <div class="post__author-avatar">
                                <img src="./images/<?= $post['author_avatar'] ?>">
                            </div>
                            <div class="post__author-info">
                                <h5>Hecho por: <?= $post['author_name'] ?></h5>
                                <small><?= $fecha_final ?></small>
                            </div>
                        </div>
                    </div>
                </article>
            <?php endwhile ?>
        <?php else: ?>
            <div class="alert__message error">
                <p>No se encontro ninguna publicacion para esta categoría.</p>
            </div>
        <?php endif ?>
    </div>
</section>

<section class="category__buttons">
    <div class="container category__buttons-container">
        <?php
        $all_categories_query = "SELECT * FROM categories ORDER BY title";
        $all_categories = mysqli_query($connection, $all_categories_query);
        ?>
        <?php while ($category = mysqli_fetch_assoc($all_categories)): ?>
            <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $category['id'] ?>" class="category__button">
                <?= $category['title'] ?>
            </a>
        <?php endwhile ?>
    </div>
</section>

<?php
include "partials/footer.php";
?>