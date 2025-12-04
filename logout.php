<?php
require "config/constants.php";

// Eliminamos las sesiones y redirigimos a la pagina de inicio de sesion
session_destroy();
header("location: " . ROOT_URL);
die();