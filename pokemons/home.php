<?php
require_once("barraHome.php");
require_once("listado.php");

$filtro="";
if(isset($_GET['filtro'])){
    $filtro = $_GET['filtro'];
}
?>
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col  mb-5 bg-danger">
                <form action="busqueda.php" class="mt-3 mb-3" method="get">
                    <input type="text" name="buscar" class="d-block m-auto form-control w-75" placeholder="Ingrese el nombre,tipo o número de pokémon">
                    <input type="submit" name="enviar" class="btn btn-success d-inline d-block m-auto" value="¿Quién es ese pokemon?" style="margin-bottom: 5px; margin-top:5px">
                </form>
                <?php
                //traemos la conexion a la base de datos
                require_once("conexionALaBaseDeDatos.php");

                echo "<div class='dropdown-divider'></div>";
                echo "<a href='acciones.php?accion=2'><button class='btn btn-success btn-block'>Nuevo Pokemon</button></a>";
                echo "<div class='dropdown-divider'></div>";
                $solicitud ="";

                if($filtro != ""){ //Si alguien llenó algo en el campo de búsqueda

                            if(is_numeric($filtro)){ //y si es númericp
                            $solicitud = "SELECT * FROM pokemon WHERE numero= $filtro order by numero";
                            }else {
                                $solicitud = "SELECT * FROM pokemon WHERE nombre like '%$filtro%' or tipo like '%$filtro%'  order by numero";
                            }
                }else{
                    $solicitud = "SELECT * FROM pokemon order by numero";
                }


                $resultado = mysqli_query($conexion, $solicitud);
                $filasTotales=mysqli_num_rows($resultado);

                if($filasTotales>0) {
                    imprimirResultados($resultado);
                }
                else{
                    echo "<h3>Pokemon no encontrado</h3>";
                    $solicitud = "SELECT * FROM pokemon order by numero";
                    $resultado = mysqli_query($conexion, $solicitud);
                    imprimirResultados($resultado);
                }

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