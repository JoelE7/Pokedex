<?php
require_once("barraIndex.php");
require_once("listado.php");

$filtro="";
if(isset($_GET['filtro'])){
$filtro = $_GET['filtro'];
}
?>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col  mb-5">
                <form action="busqueda.php" class="mt-3 mb-3" method="get">
                    <input type="text" name="buscar" class="d-block m-auto form-control w-75" placeholder="Ingrese el nombre,tipo o número de pokémon">
                    <input type="submit" name="enviar" class="btn btn-success d-inline d-block m-auto" value="¿Quien es ese pokemon?" style="margin-bottom: 5px;">
                </form>
                <?php
                //traemos la conexion a la base de datos
                require_once("conexionALaBaseDeDatos.php");
                //armamos la solicitud a la bd
                // en este caso siempre mostramos los pokemones ordenados por su numero de pokemon
                $solicitud ="";
                if($filtro != ""){
                    $solicitud = "SELECT * FROM pokemon WHERE nombre ='$filtro' order by numero";
                }else{
                    $solicitud = "SELECT * FROM pokemon order by numero";

                }
                $resultado = mysqli_query($conexion, $solicitud);
                imprimirResultados($resultado);
                ?>
            </div>
        </div>
    </div>
</main>
</body>
<script src="recursos/JS/jquery-3.5.1.slim.min.js"></script>
<script src="recursos/JS/popper.min.js"></script>
<script src="recursos/JS/bootstrap.min.js"></script>

</html>