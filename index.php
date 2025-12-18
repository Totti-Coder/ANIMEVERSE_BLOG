<?php
include "partials/header.php";

// Obtenemos las publicaciones destacadas de la base de datos
$featured_query = "SELECT p.*, c.title AS category_title, u.nombre AS author_name, u.avatar AS author_avatar FROM posts p JOIN categories c ON p.category_id = c.id JOIN users u ON p.author_id = u.id WHERE p.is_featured = 1 LIMIT 1";
$featured_result = mysqli_query($connection, $featured_query);
$featured = mysqli_fetch_assoc($featured_result);
?>

<?php if (mysqli_num_rows($featured_result) == 1): ?>
    <section class="featured">
        <div class="container featured__container">
            <div class="post__thumbnail">
                <img src="./images/<?= $featured["thumbnail"] ?>">
            </div>
            <div class="post__info">
                <a href="category-posts.html" class="category__button"><?= $featured['category_title'] ?></a>
                <h2 class="post__title"><a href="post.html"><?= $featured["title"] ?></a></h2>
                <p class="post__body"><?= substr($featured["body"], 0, 300) ?></p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./images/<?= $featured['author_avatar'] ?>">
                    </div>
                    <div class="post__author-info">
                        <h5>Hecho por: <?= $featured['author_name'] ?></h5>
                        <small><?= date("d M, Y - H:i", strtotime($featured['date_time'])) ?></small>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif ?>

<!-- END OF FEATURED-->

<section class="posts">
    <div class="container posts__container">
        <article class="post">
            <div class="post__thumbnail">
                <img src="./images/avatar2.JPG" alt="">
            </div>
            <div class="post__info">
                <a href="category-posts.html" class="category__button">Demon Slayer</a>
                <h3 class="post__title"> <a href="post.html">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Quibusdam, dolor?
                    </a></h3>
                <p class="post__body">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe magnam voluptates
                    nostrum excepturi odit ad esse mollitia tempore, modi sapiente minus eveniet laboriosam tenetur
                    ducimus!</p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./images/avatar2.JPG">
                    </div>
                    <div class="post__author-info">
                        <h5>Hecho por: Pablo Garcia</h5>
                        <small>Noviembre 11, 2025 - 21:01</small>
                    </div>
                </div>
            </div>
        </article>
        <article class="post">
            <div class="post__thumbnail">
                <img src="./images/avatar2.JPG" alt="">
            </div>
            <div class="post__info">
                <a href="category-posts.html" class="category__button">Demon Slayer</a>
                <h3 class="post__title"> <a href="post.html">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Quibusdam, dolor?
                    </a></h3>
                <p class="post__body">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe magnam voluptates
                    nostrum excepturi odit ad esse mollitia tempore, modi sapiente minus eveniet laboriosam tenetur
                    ducimus!</p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./images/avatar2.JPG">
                    </div>
                    <div class="post__author-info">
                        <h5>Hecho por: Pablo Garcia</h5>
                        <small>Noviembre 11, 2025 - 21:01</small>
                    </div>
                </div>
            </div>
        </article>
        <article class="post">
            <div class="post__thumbnail">
                <img src="./images/avatar2.JPG" alt="">
            </div>
            <div class="post__info">
                <a href="category-posts.html" class="category__button">Demon Slayer</a>
                <h3 class="post__title"> <a href="post.html">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Quibusdam, dolor?
                    </a></h3>
                <p class="post__body">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe magnam voluptates
                    nostrum excepturi odit ad esse mollitia tempore, modi sapiente minus eveniet laboriosam tenetur
                    ducimus!</p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./images/avatar2.JPG">
                    </div>
                    <div class="post__author-info">
                        <h5>Hecho por: Pablo Garcia</h5>
                        <small>Noviembre 11, 2025 - 21:01</small>
                    </div>
                </div>
            </div>
        </article>
        <article class="post">
            <div class="post__thumbnail">
                <img src="./images/avatar2.JPG" alt="">
            </div>
            <div class="post__info">
                <a href="category-posts.html" class="category__button">Demon Slayer</a>
                <h3 class="post__title"> <a href="post.html">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                        Quibusdam, dolor?
                    </a></h3>
                <p class="post__body">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe magnam voluptates
                    nostrum excepturi odit ad esse mollitia tempore, modi sapiente minus eveniet laboriosam tenetur
                    ducimus!</p>
                <div class="post__author">
                    <div class="post__author-avatar">
                        <img src="./images/avatar2.JPG">
                    </div>
                    <div class="post__author-info">
                        <h5>Hecho por: Pablo Garcia</h5>
                        <small>Noviembre 11, 2025 - 21:01</small>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
<!-- END OF POSTS-->

<section class="category__buttons">
    <div class="container category__buttons-container">
        <a href="" class="category__button">Dragon Ball</a>
        <a href="" class="category__button">One Piece</a>
        <a href="" class="category__button">Demon Slayer</a>
        <a href="" class="category__button">Hunter x Hunter</a>
        <a href="" class="category__button">Jujutsu Kaisen</a>
        <a href="" class="category__button">Inazuma Eleven</a>
        <a href="" class="category__button">Naruto</a>
        <a href="" class="category__button">My Hero Academy</a>
    </div>
</section>
<!-- END OF CATEGORY BUTTONS -->

<?php
include "partials/footer.php"
    ?>