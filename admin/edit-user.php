<?php
include "partials/header.php";
?>

    <section class="form__section-add">
        <div class="container form__section-container-add">
            <div class="user-edit">
                <h2>Nuevo usuario</h2>

                <form action="" enctype="multipart/form-data">
                    <input type="text" placeholder="Nombre">
                    <input type="text" placeholder="Nombre de usuario">
                    <input type="email" placeholder="Email">
                    <select>
                        <option value="0">Autor</option>
                        <option value="1">Administrador</option>
                    </select>
                    <button type="submit" class="btn">Crear</button>
            </div>
            </form>
        </div>
    </section>

    <?php
    include "../partials/footer.php";
    ?>