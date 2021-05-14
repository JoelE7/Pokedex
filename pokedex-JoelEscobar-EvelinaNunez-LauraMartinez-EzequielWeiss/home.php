<?php
require_once("barraHome.php");
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
                // traemos la conexion a la bd
                require_once("conexionALaBaseDeDatos.php");
                //armamos la solicitud a la bd
                // en este caso siempre mostramos los pokemones ordenados por su numero de pokemon
                $solicitud = "SELECT * FROM pokemon order by numero";
                // enviamos dicha solicitud a la bd
                $resultado = mysqli_query($conexion, $solicitud);

                // todos los resultados los imprimimos en una tabla
                //las etiquetas <tr> son filas y las <td> son columnas
                // Como el usuario está logueado se les mostraran las acciones de modificaciones a realizar en la tabla
                echo "<table class='table table-info table-hover table-responsive-xs'>
                                <tr>
                                <td>Imagen:</td>
                                <td>Tipo:</td>
                                <td>Número:</td>
                                <td>Nombre:</td>
                                <td>Acciones</td>
                                </tr>";
                // vamos imprimiendo cada resultado, desarmando la variable $resultado donde la bd nos responderá de acuerdo a lo que le enviamos
                while ($fila = mysqli_fetch_array($resultado)) {
                    echo "<tr>";

                    // primero imprimimos la imagen correspondiente al pokemon
                    //Aclaración: en la bd, no están subidas las imagenes sino solo el nombre de ellas entonces
                    //cuando imprimimos el nombre en la etiqueta <img> es como si en el source estuvieramos poniendo el nombre de la imagen
                    //y solo se mostrará
                    //ej: la primera iterración $fila['imagen'] = Bulbasaur.PNG
                    //<img src="IMG/' . $fila['imagen']> = <img src="IMG/' . Bulbasaur.PNG>
                    //y así irá imprimiendo una por una
                    echo '<td><img src="recursos/IMG/' . $fila['imagen'] . '"style="width:10em; height:10em;"><a/></td>';
                    // lo mismo que con las imagenes pasa con el tipo de pokemon, Tierra.PNG,agua.PNG,Fuego.PNG,Veneno.PNG
                    echo '<td><img src="recursos/IMG/' . $fila['tipo'] . '"style="width:10em; height:10em;"</td>';
                    // Número de pokemon
                    echo "<td>" . $fila['numero'] . "</td>";
                    // El nombre del pokemon
                    echo "<td>" . $fila['nombre'] . "</td>";
                    // Acciones
                    //cuando apretemos en cualquiera de los botones, se le enviará tanto como el número o el id del pokemon que queremos modificar
                    //y el número de acción(excepto en el de quitar que solo se envía el id, esto porque es más sencillo borrar un dato
                    //que actualizar o insertar)
                    //en la parte de info enviará el id para mostrar la informacion
                    echo "<td><a href='acciones.php?numero=" . $fila['id'] . "&&accion=1' ><button class='btn btn-warning'>Modificar</button></a>
                                      <a href='acciones.php?numero=" . $fila['numero'] . "&&accion=2' ><button class='btn btn-success'>Subir</button></a>
                                      <a href='quitar.php?numero=" . $fila['id'] . "' ><button  class='btn btn-danger'>Quitar</button></a>
                                      <a href='info.php?numero=" . $fila['id'] . "&&inicio=2' ><button  class='btn btn-primary'>Info</button></a>
                            </td>";
                    echo "</tr>";
                }
                echo "</table>";
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