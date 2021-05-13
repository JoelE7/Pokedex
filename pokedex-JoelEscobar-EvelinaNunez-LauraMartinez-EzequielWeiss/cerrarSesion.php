<?php

session_start();

// validamos que el usuario este logueado, para cerrar sesión, caso contrario lo mandamos al index
if (isset($_SESSION['usuario'])) {
    session_unset();

    session_destroy();

    header("Location:index.php");
} else {
    header("Location:index.php");
    exit();
}
