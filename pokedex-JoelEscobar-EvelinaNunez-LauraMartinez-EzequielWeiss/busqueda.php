<?php
require_once("conexionALaBaseDeDatos.php");
//traemos la clase validacionConsulta
require_once("validacionConsulta.php");
session_start();

$buscar = $_GET['buscar'];

//Se fija si no inició sesion y está el campo de búsqueda vacío, vuelve a mostrar todos los pokemones
if(!isset($_SESSION['usuario']) && empty($buscar)){
    header('location:index.php?busquedaVacia');
}

//Se fija si inició sesión y si está el campo de búsqueda vacío, vuelve a mostrar todos los pokemones
else if(isset($_SESSION['usuario']) && empty($buscar)){
      header('location:home.php?busquedaVacia');
}
//Si no inició sesión y el campo de búsqueda está lleno, vuelve al index y busca en la base de datos lo que se le pasó por el filtro y lo muestra.
if(!isset($_SESSION['usuario']) && !empty($buscar)){
    header('location:index.php?filtro='.$buscar);
}
//Si inició sesión y el campo de búsqueda está lleno, va a la home y busca en la BD de lo que se le pasó.

if(isset($_SESSION['usuario']) && !empty($buscar)){
    header('location:home.php?filtro='.$buscar);
}