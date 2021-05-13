<?php

require_once("conexionALaBaseDeDatos.php");
require_once("validacionConsulta.php");


$validador = new validarConsultas();


$fila = $validador->quitarPokemon();

header("Location:home.php");
?>