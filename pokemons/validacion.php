<?php

require_once("conexionALaBaseDeDatos.php");
require_once("validacionConsulta.php");

session_start();

if(isset($_SESSION['usuario'])){
    header("Location:home.php");
    exit();
}else if(!isset($_POST['user'],$_POST['pass'])){
    header("Location:index.php");
    exit();
}else

//la instanciamos
$validador = new validarConsultas();

//recibimos un resultado del metodo validarUsuario();
$fila = $validador->validarUsuario();

//en caso de no recibir ningún resultado, llegará un valor nulo
//entonces acá con el isset si la variables tiene contenido, trajo al usuario correcto, por lo definido en el metodo
if(isset($fila)){
    //inicia sesión
    //guardamos en la variable $session el usuario
    $_SESSION['usuario'] = $_POST['user'];
    //y lo mandamos al home
    header("Location: home.php");
    exit();
}else{
    //caso contrario le decimos un error de contraseña enviando devuelta al index
    header("Location:index.php?sesion=false");
    exit();
}


         
