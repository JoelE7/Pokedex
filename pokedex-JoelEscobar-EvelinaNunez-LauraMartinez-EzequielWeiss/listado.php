<?php

function imprimirResultados($resultado){

    echo "<table class='table table-info table-hover table-responsive-xs'>
                                <tr>
                                <td>Imagen:</td>
                                <td>Tipo:</td>
                                <td>Número:</td>
                                <td>Nombre:</td>
                                <td>Acciones</td>
                                </tr>";
    // todos los resultados los imprimimos en una tabla
    //las etiquetas <tr> son filas y las <td> son columnas
    // Como el usuario está logueado se les mostraran las acciones de modificaciones a realizar en la tabla
    // vamos imprimiendo cada resultado, desarmando la variable $resultado donde la bd nos responderá de acuerdo a lo que le enviamos

    while ($fila = $resultado-> fetch_assoc()) {
        echo "<tr>";
        // primero imprimimos la imagen correspondiente al pokemon
        //Aclaración: en la bd, no están subidas las imagenes sino solo el nombre de ellas entonces
        //cuando imprimimos el nombre en la etiqueta <img> es como si en el source estuvieramos poniendo el nombre de la imagen
        //y solo se mostrará
        //ej: la primera iteración $fila['imagen'] = Bulbasaur.PNG
        //<img src="IMG/' . $fila['imagen']> = <img src="IMG/' . Bulbasaur.PNG>
        //y así irá imprimiendo una por una
        echo '<td><img src="recursos/IMG/' . $fila['imagen'] . '"style="width:10em; height:10em;"></td>';
        // lo mismo que con las imagenes pasa con el tipo de pokemon, Tierra.PNG,agua.PNG,Fuego.PNG,Veneno.PNG
        echo '<td><img src="recursos/IMG/' . $fila['tipo'] . ".png". '"style="width:10em; height:10em;"></td>';
        // Número de pokemon
        echo "<td>" . $fila['numero'] . "</td>";
        // El nombre del pokemon
        echo "<td>" . $fila['nombre'] . "</td>";
        // quien no inicia sesión tiene acceso solamente a la info del pokemon
        //se envía el numero de pokemon para poder mostrar la informacion
        if(isset($_SESSION['usuario'])){
            echo "<td><a href='acciones.php?numero=" . $fila['id'] . "&&accion=1' ><button class='btn btn-warning'>Modificar</button></a>
                <a href='acciones.php?numero=" . $fila['numero'] . "&&accion=2' ><button class='btn btn-success'>Subir</button></a>
                <a href='quitar.php?numero=" . $fila['id'] . "' ><button class='btn btn-danger'>Quitar</button></a>
                <a href='info.php?numero=" . $fila['id'] . "&&inicio=2' ><button class='btn btn-primary'>Info</button></a>
                </td>";
        }else{
            echo "<td><a href='info.php?numero=" . $fila['id'] . "&&inicio=1' ><button class='btn btn-primary'>Info</button></a>
            </td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}