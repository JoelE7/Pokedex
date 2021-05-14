<?php
require_once("conexionALaBaseDeDatos.php");
//traemos la clase validacionConsulta
require_once("validacionConsulta.php");
session_start();

$buscar = $_GET['buscar'];

//Se fija si no inicio sesion y está el campo de busqueda vacia, vuelve a mostrar todos los pokemones
if(!isset($_SESSION['usuario']) && empty($buscar)){
    header('location:index.php?busquedaVacia');
}

//Se fija si inicio se sesion y está el campo de busqueda vacia, vuelve a mostrar todos los pokemones
else if(isset($_SESSION['usuario']) && empty($buscar)){
      header('location:home.php?busquedaVacia');
}

if(!isset($_SESSION['usuario']) && !empty($buscar)){
    header('location:index.php?filtro='.$buscar);
}

if(isset($_SESSION['usuario']) && !empty($buscar)){
    header('location:home.php?filtro='.$buscar);
}