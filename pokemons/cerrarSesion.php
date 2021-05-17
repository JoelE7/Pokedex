<?php

session_start();

// validamos que el usuario esté logueado, para cerrar sesión, caso contrario lo mandamos al index
if (isset($_SESSION['usuario'])) {
    session_unset(); //liberamos todas las variables de sesión.

    session_destroy();

    header("Location:index.php");
} else {
    header("Location:index.php");
    exit();
}
