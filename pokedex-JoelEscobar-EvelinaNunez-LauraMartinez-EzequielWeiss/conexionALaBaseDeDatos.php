<?php

// usuario y contraseña, seguro lo sabrá, pero igual xd
//debe cambiar por una base como esta con su usuario y contraseña
$nombreServidor = "localhost";
$username = "root";
$password = "sabrinakilian1";
$database = "pokedex";
$port = "3306";

$conexion = new mysqli($nombreServidor, $username, $password, $database, $port);

// la base de datos requiere su propia propiedad de codificación
mysqli_set_charset($conexion, "utf8");
