<?php


session_start();
//si el usuario no inició sesión, lo manda al index.php
if (!isset($_SESSION['usuario'])) {
    header("Location:index.php");
    exit();
    //ahora si inicio sesión y el usuario se quiere ir a esta pagina sin haber pasado por el formulario
    //y las variables que debio haber pasado por ese form están vacias o no existen, lo manda al home.php
} else if (!isset($_POST['accion'])) {
    header("Location:home.php");
    exit();
} else

    // traemos la bd
    require_once("conexionALaBaseDeDatos.php");

//traemos la clase validacionConsulta();
require_once("validacionConsulta.php");

//la instanciamos
$validador = new validarConsultas();

//recibimos la acción del formulario ya sea donde subimos o actualizamos
$accion = $_POST['accion'];

//si era 1 o sea actualizar un pokemon ejecutamos el metodo modificarPokemon() de la clase
if ($_POST['accion'] == 1) {
    if (is_string($validador->modificarPokemon())) {
        $error =  $validador->modificarPokemon();
        if($error=="1"){
            $id = $_POST['id'];
            header("Location:acciones.php?accion=1&&error=1&&numero=" .$id."");
            //  echo "Sólo se puede subir imagenes jpg/jpeg/png/gif";
        }else if($error==2){
            $id = $_POST['id'];
            header("Location:acciones.php?accion=1&&error=2&&numero=" .$id."");
        }else{
            echo "Error, inesperado";
        }
    } else {
        header("Location:home.php");
        exit();
    }
    // si era 2 o sea subir un pokemon subimos el pokemon con los datos que paso
} else if ($_POST['accion'] == 2) {
    if (is_string($validador->subirPokemon())) {
        $error =  $validador->subirPokemon();
        if($error=="1"){
            $id = $_POST['id'];
            header("Location:acciones.php?accion=2&&error=1&&numero=" .$id."");
            //  echo "Sólo se puede subir imagenes jpg/jpeg/png/gif";
        }else if($error==2){
            $id = $_POST['id'];
            header("Location:acciones.php?accion=2&&error=2&&numero=" .$id."");
        }else{
            echo "Error, inesperado";
        }
    } else {
        header("Location:home.php");
        exit();
    }
} else {
    echo "Ha ocurrido un error";
}
