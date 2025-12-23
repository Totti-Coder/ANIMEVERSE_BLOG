<?php
include "partials/header.php";

// Obtenemos las publicaciones
$posts_query = "SELECT p.*, c.title AS category_title, u.nombre AS author_name, u.avatar AS author_avatar FROM posts p JOIN categories c ON p.category_id = c.id JOIN users u ON p.author_id = u.id WHERE p.is_featured = 0 ORDER BY p.date_time DESC";
$posts_result = mysqli_query($connection, $posts_query);

// Array para traducir meses
$meses = [
    'Jan' => 'Ene', 'Feb' => 'Feb', 'Mar' => 'Mar', 'Apr' => 'Abr',
    'May' => 'May', 'Jun' => 'Jun', 'Jul' => 'Jul', 'Aug' => 'Ago',
    'Sep' => 'Sep', 'Oct' => 'Oct', 'Nov' => 'Nov', 'Dec' => 'Dic'
];
?>

<section class="search__bar">
    <form class="container search__bar-container" onsubmit="return false;">
        <div>
            <i class="uil uil-search"></i>
            <input type="search" name="search" placeholder="Buscar" autocomplete="off">
        </div>
        <button type="button" class="btn"><i class="uil uil-angle-right"></i></button>
    </form>
</section>

<section class="posts">
    <div class="container posts__container">
        <?php while ($post = mysqli_fetch_assoc($posts_result)): ?>
            <?php
            // Aquí dentro SÍ existe $post['date_time']
            $post_fecha = date("d M, Y - H:i", strtotime($post['date_time']));
            ?>
            <article class="post">
                <div class="post__thumbnail">
                    <img src="./images/<?= $post['thumbnail'] ?>">
                </div>
                <div class="post__info">
                    <a href="<?= ROOT_URL ?>category-posts.php?id=<?= $post['category_id'] ?>" class="category__button">
                        <?= $post['category_title'] ?>
                    </a>
                    <h3 class="post__title">
                        <a href="<?= ROOT_URL ?>post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a>
                    </h3>
                    <p class="post__body"><?= substr($post['body'], 0, 150) ?></p>
                    <div class="post__author">
                        <div class="post__author-avatar">
                            <img src="./images/<?= $post['author_avatar'] ?>">
                        </div>
                        <div class="post__author-info">
                            <h5>Hecho por: <?= $post['author_name'] ?></h5>
                            <small><?= strtr($post_fecha, $meses) ?></small>
                        </div>
                    </div>
                </div>
            </article>
        <?php endwhile ?>
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
<!-- END OF CATEGORY BUTTONS -->
<?php
include "partials/footer.php";
?>