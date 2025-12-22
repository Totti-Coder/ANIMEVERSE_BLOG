<?php
include "partials/header.php";

// Obtenemos las publicaciones de la base de datos si existe un id
if (isset($_GET["id"])) {
    $id = filter_var($_GET["id"], FILTER_SANITIZE_NUMBER_INT);

    // Hacemos el JOIN para traer datos del autor y la categoría
    $query = "SELECT p.*, u.nombre AS author_name, u.avatar AS author_avatar, c.title AS category_title FROM posts p JOIN users u ON p.author_id = u.id JOIN categories c ON p.category_id = c.id WHERE p.id = ?";

    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $query_result = mysqli_stmt_get_result($stmt);
    $post = mysqli_fetch_assoc($query_result);

    // Configuramos la fecha en español
    $meses = ['Jan'=>'Ene','Feb'=>'Feb','Mar'=>'Mar','Apr'=>'Abr','May'=>'May','Jun'=>'Jun','Jul'=>'Jul','Aug'=>'Ago','Sep'=>'Sep','Oct'=>'Oct','Nov'=>'Nov','Dec'=>'Dic'];
    $fecha_formateada = date("d M, Y - H:i", strtotime($post['date_time']));
    $fecha_final = strtr($fecha_formateada, $meses);

} else {
    header("location: " . ROOT_URL . "blog.php");
    die();
}
?>

<section class="singlepost">
    <div class="container singlepost__container">
        <h2><?= $post["title"]?></h2>
        <div class="post__author">
            <div class="post__author-avatar">
                <img src="./images/<?= $post['author_avatar'] ?>" alt="Imagen de">
            </div>
            <div class="post__author-info">
                <h5>Hecho por: <?= $post["author_name"] ?></h5>
                <small>Noviembre 11, 2025 - 21:01</small>
            </div>
        </div>
        <div class="singlepost__thumbnail">
            <img src="./images/avatar2.JPG">
        </div>
        <p>
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ullam enim illum voluptatum, debitis cumque
            praesentium dolore, deserunt quas nam fuga qui ducimus pariatur!
        </p>

    </div>
</section>
<!-- END OF SINGLEPOST -->

<?php
include "partials/footer.php";
?>