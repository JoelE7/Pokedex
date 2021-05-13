<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tp 5 - Pokédex</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <header>
        <div class="container-fluid m-0 p-0">
            <div class="row m-0 p-0">
                <div class="col m-0 p-0">
                    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                        <a href="#" class="navbar-brand"><img src="recursos/IMG/icons8-pokedex-48.png" style="width:100px;"></a>
                        <h1 class="text-center text-danger display-4 w-100">Pokedex</h1>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#uno">
                            <!-- este es el icono del menu de navegacion -->
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!-- aca es donde se llama al menu -->
                        <div class="collapse navbar-collapse" id="uno">
                            <div class="navbar-nav">
                                <?php
                                // cuando dicho usuario ingrese a la platarorma se mostrará su nombre de usuario
                                session_start();
                                // si la variable está vacía entonces el usuario no podrá ingresar al home.php
                                //y lo enviará al index para que pueda iniciar sesión
                                if (isset($_SESSION['usuario'])) {
                                    echo "<div class=''>
                                        <p class='text-danger d-inline display-4'>" . $_SESSION['usuario'] . "</p>
                                        <a href='cerrarSesion.php''><input type='submit' value='Cerrar sesión' class='btn btn-primary'></a>              
                                    </div>";
                                } else {
                                    header("Location:index.php");
                                }
                                ?>

                            </div>
                        </div>
                    </nav>
    </header>
    <main>
        <div class="container-fluid">
            <div class="row">
                <div class="col  mb-5">
                    <form action="" class="mt-3 mb-3">
                        <input type="text" class="d-block m-auto form-control w-75" placeholder="Ingrese el nombre,tipo o número de pokémon">
                        <input type="submit" class="btn btn-success d-inline d-block m-auto" value="¿Quien es ese pokemon?" style="margin-bottom: 5px;">
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
                        echo '<td><img src="recursos/IMG/' . $fila['imagen'] . '"style="width:10em; height:10em;"></td>';
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
                        echo "<td><a href='acciones.php?numero=" . $fila['id'] . "&&accion=1' ><button class='btn btn-warning'>Modificar</button></a>
                                      <a href='acciones.php?numero=" . $fila['numero'] . "&&accion=2' ><button class='btn btn-success'>Subir</button></a>
                                      <a href='quitar.php?numero=" . $fila['id'] . "' ><button  class='btn btn-danger'>Quitar</button></a>
                        
                        
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