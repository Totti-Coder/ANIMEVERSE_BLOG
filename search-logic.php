<?php
require 'partials/header.php';

$search = isset($_GET['search']) ? mysqli_real_escape_string($connection, $_GET['search']) : '';

// Array para traducir meses
$meses = [
    'Jan' => 'Ene',
    'Feb' => 'Feb',
    'Mar' => 'Mar',
    'Apr' => 'Abr',
    'May' => 'May',
    'Jun' => 'Jun',
    'Jul' => 'Jul',
    'Aug' => 'Ago',
    'Sep' => 'Sep',
    'Oct' => 'Oct',
    'Nov' => 'Nov',
    'Dec' => 'Dic'
];

// Busqueda de si el usuario escribio algo
if (!empty($search)) {
    // Buscamos publicaciones donde el título o el cuerpo contengan las letras escritas
    $query = "SELECT p.*, c.title AS category_title, u.nombre AS author_name, u.avatar AS author_avatar FROM posts p JOIN categories c ON p.category_id = c.id JOIN users u ON p.author_id = u.id WHERE p.title LIKE '%$search%' OR p.body LIKE '%$search%' ORDER BY p.date_time DESC";

} else {
    // Si el buscador está vacío, puedes devolver todos los posts o nada
    $query = "SELECT p.*, c.title AS category_title, u.nombre AS author_name, u.avatar AS author_avatar FROM posts p JOIN categories c ON p.category_id = c.id JOIN users u ON p.author_id = u.id ORDER BY p.date_time DESC";
}

$result = mysqli_query($connection, $query);

if (mysqli_num_rows($result) > 0) {
    while ($post = mysqli_fetch_assoc($result)) {
        $post_fecha = date("d M, Y - H:i", strtotime($post['date_time']));
        $fecha_actual = strtr($post_fecha, $meses);
        ?>
        <article class="post">
            <div class="post__thumbnail">
                <img src="./images/<?= $post['thumbnail'] ?>">
            </div>
            <div class="post__info">
                <a href="category-posts.php?id=<?= $post['category_id'] ?>"
                    class="category__button"><?= $post['category_title'] ?></a>
                <h3 class="post__title"><a href="post.php?id=<?= $post['id'] ?>"><?= $post['title'] ?></a></h3>
                <p class="post__body"><?= substr($post['body'], 0, 150) ?></p>
                <div class="post__author">
                    <div class="post__author-avatar"><img src="./images/<?= $post['author_avatar'] ?>"></div>
                    <div class="post__author-info">
                        <h5>Hecho por: <?= $post['author_name'] ?></h5>
                        <small><?= $fecha_actual ?></small>
                    </div>
                </div>
            </div>
        </article>
        <?php
    }
} else {
    echo "<div class='alert__message error lg'><p>No se encontraron publicaciones con las letras: '<strong>" . htmlspecialchars($search) . "</strong>'</p></div>";
}