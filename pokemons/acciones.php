<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

<?php

require_once("conexionALaBaseDeDatos.php");
require_once("validacionConsulta.php");

$validador = new validarConsultas();

// recibimos el número del pokemon
if(isset($_GET['numero'])){
    $numero = $_GET['numero'];
    // y el numero de la acción
    // hacemos nuestra consulta por si quiere actualizar el pokemon
    $solicitud = "SELECT* FROM pokemon WHERE ID=$numero";
    $resultado = $conexion->query($solicitud);
}

$accion = $_GET['accion'];
?>

<?php
session_start();
// validamos que haya iniciado sesión, sino lo mandamos al index.php
if (isset($_SESSION['usuario'])) {
    //ahora si inició sesión y el usuario se quiere ir a esta pagina sin haber pasado por el formulario
    //y las variables que debió haber pasado por ese form están vacias o no existen, lo manda al home.php
    if (isset($_GET['accion'])) {
        //si la acción llegara a ser 1, o sea que quiere actualizar un pokemon, lo enviamos a un formulario con los datos cargados del pokemon que eligíó actualizar
        if ($accion == 1) {
            if (isset($_GET['numero'])) {
                echo "<form action='modificar.php' method='POST' enctype='multipart/form-data'>";
                while ($fila  = $resultado->fetch_assoc()) {
                    echo "Número: <input = type= 'number'class='form-control' name = 'numero' value = '" . $fila['numero'] . "'  placeholder='Número de pokemon'><br> ";
                    echo "Nombre: <input = type= 'text'class='form-control' name = 'nombre' value = '" . $fila['nombre'] . "' placeholder='Nombre de pokemon'><br> ";
                    echo "Tipo : <select name='tipo' id='tipo' value = '" . $fila['tipo'] . "' class='form-control'>                     
                                     <option value='Veneno'>Veneno</option>
                                      <option value='Agua'>Agua</option>
                                       <option value = 'Fuego'>Fuego</option>
                                      <option value = 'Tierra'>Tierra</option>
                    </select>";
                    echo "<p class='text-danger'>¿Desea editar la imagen?</p>";
                    echo "<input type='radio' name='editarImagen' id='editarImagen' class='ml-5' onclick='activar()'>Si";
                    echo "<input type='radio' name='editarImagen' id='editarImagen' class='ml-5' onclick='desactivar()'>No <br>";
                    echo "Imagen: <input = type= 'file' disabled name = 'imagen' class='form-control' id='imagen' value = '" . $fila['imagen'] . "'><br> ";
                    if(isset($_GET['error'])){
                        if($_GET['error']==1){
                            echo "<p class='text-danger'>Sólo se puede subir imagenes jpg/jpeg/png/gif</p>";
                        }else if($_GET['error']==2){
                            echo "<p class='text-danger'>El tamaño es demasiado grande</p>";
                        }
                    }else{
                       
                    }
                    //el input hidden está oculto, ya que no hay necesidad de modificarlo, el valor será el id, entonces se modificará dicho id
                    echo "<input type = 'hidden' name = 'id' value = '" . $fila['id'] . "'><br>";
                    //ocultamos un input de tipo hidden donde también le vamos a pasar un atributo acción con un dicho valor, en la pagína modificar.php se ve esto
                    echo "<input type = 'hidden' name = 'accion' value = '1'><br>";
                    echo  "<input type='submit' name='enviar'class='btn btn-success form-control' value='Subir'>";
                    echo "</form>";
                }
            } else {
                 header("Location:home.php");
                 exit();
            }
        } else if ($accion == 2) {
?>
            <form action="modificar.php" method='POST' enctype='multipart/form-data'>
                Número :<input type="number" name="numero" id="numero" class="form-control" placeholder="Número de pokemon">
                Nombre : <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre de pokemon">
                Tipo :<select name="tipo" id="tipo" class="form-control">
                    <option value="Veneno">Veneno</option>
                    <option value="Agua">Agua</option>
                    <option value="Fuego">Fuego</option>
                    <option value="Tierra">Tierra</option>
                </select>
                Imagen: <input type="file" name="imagen" id="imagen" class="form-control">
                <!-- ocultamos un input de tipo hidden donde también le vamos a pasar un atributo acción con un dicho valor
        en la págína modificar.php se ve esto-->
                <input type='hidden' name='accion' value="2"><br>
                <input type="submit" value="Subir Pokemon" class="btn btn-success form-control">
                <input type="radio" name="" id="">
            </form>
<?php
        } else {
            header("Location:home.php");
            exit();
        }
    } else {
        header("Location:home.php");
        exit();
    }
} else {
    header("Location:index.php");
    exit();

}
?>
<script src="recursos/JS/script.js"></script>