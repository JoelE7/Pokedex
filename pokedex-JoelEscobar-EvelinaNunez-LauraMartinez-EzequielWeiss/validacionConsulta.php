<?php
//traemos la bd
require_once("conexionALaBaseDeDatos.php");

//si alguien quiere acceder a este lugar lo volvemos a la pagina anterior de nuevo
// echo "<script>window.history.back();</script>";
//transformamos la variable $conexion de la bd, en una super global con la variable super global $globals
//pasandole por parametro la misma

$GLOBALS['conexion'];

class validarConsultas
{

    function validarUsuario()
    {
        //cuando llamamos este metodo recibimos 2 parametros el usuario y la contraseña
        //esta es una de las formas basicas de evitar una forma de hackeo de sql por inyección 
        //armamos la solicitud
        $solicitud = "SELECT * from usuario where nombre = ? and pass = ?";
        //preparamos la consulta usando la variable conexion de la bd que en este caso esta dentro de globals
        //enviamos la solicitud
        $stmt = $GLOBALS['conexion']->prepare($solicitud);
        //recibimos los 2 datos del formulario para ejecutar bien el metodo
        $usuario = $_POST["user"];
        $clave = $_POST["pass"];
        //de acuerdo a los tipos de datos que estemos tratando de pasar a la bd
        //vamos enviando los datos con el metodo bind_param()
        //el primer parametro corresponde a las iniciales de cada tipo de dato que estemos enviando
        //ej: si enviamos 2 strings a la bd, tenemos que poner 2 s, debido a que son 2 tipos de datos String, con sus iniciales
        //lo mismo si fuera un dato int, colocamos una i, si fuera un boolean una b, y asi con cada tipo de dato
        //el 2do parametro y así infitamente son la cantidad de datos que vamos a pasar, todos ellos
        //OJO porque debe coincidir la cantidad de datos que pasamos como con la cantidad que pusimos de datos a pasar del 1er parametro
        //es decir si en el primer parametro pasamos 2 Strings (ss), tenemos que enviar solamente 2 variables de tipo String, si enviamos
        //una de más o se nos olvida pasar uno, la bd explota y da un fatal error
        //lo mismo pasaria si ponemos una s y le tratamos de pasar un  int, explota la bd
        $stmt->bind_param("ss", $usuario, $clave);
        //ejecutamos la sentencia
        $stmt->execute();
        //guardamos el resultado
        $result = $stmt->get_result();
        // lo retornamos
        return $result->fetch_assoc();
    }

    function modificarPokemon()
    {
        //nombre de la imagen
        $nombre_imagen = $_FILES['imagen']['name'];
        //tipo de la imagen
        $tipo_imagen = $_FILES['imagen']['type'];
        //tamaño de la imagen
        $tamaño = $_FILES['imagen']['size'];

        //id recibido para modificar, lo metemos dentro de la super global $GLOBALS
        $GLOBALS['id'] = $_POST['id'];

        //verificar que la imagen no supere el tamaño de los 3mb
        if ($tamaño <= 3000000) {
            // verifica que sea una imagen valida
            if (
                $tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen == "image/png"
                || $tipo_imagen == "image/gif"
            ) {
                //Ruta de la carpeta destino en servidor
                //al corregir verifique que las rutas sean correctas, ya que están son de mi ordenador
                $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/Web II/pokedex-JoelEscobar-EvelinaNunez-LauraMartinez-EzequielWeiss/IMG/';

                //Movemos la imagen del directorio temporal al directorio escogido
                move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino . $nombre_imagen);
                //recibimos los datos del pokemon
                $numero = $_POST['numero'];
                $nombre = $_POST['nombre'];
                $tipo = $_POST['tipo'];
                //usamos el metodo básico para evitar la inyección por sql, arriba en el metodo validarUsuario()
                //está explicado esto
                $solicitud2 = "UPDATE pokemon SET numero = ?, nombre = ?, tipo = ?, imagen = ? WHERE id =?";
                //preparamos la consulta
                $stmt = $GLOBALS['conexion']->prepare($solicitud2);
                //enviamos los datos, fijate, en este caso vamos a pasarle 5 variables, 2 integer y 3 strings
                //los ponemos en el orden que pusimos en nuestra consulta y las enviamos
                //pd: presta atención a la variable $nombre_imagen, no pasamos la imagen sino el nombre de esa imagen :)
                $stmt->bind_param("isssi", $numero, $nombre, $tipo, $nombre_imagen, $GLOBALS['id'],);
                //ejecutamos
                $stmt->execute();
            } else {
                //en caso de que intente subir imagenes distintas o archivos no validos
                //lanzar un mensaje de error, diciendo los tipos que admite
                $error = "Solo se puede subir imagenes jpg/jpeg/png/gif";
                return $error;
            }
        } else {
            //si la imagen supera el tamaño de 3mb lanzara el mensaje 
            $error = "El tamaño es demasiado grande";
            return $error;
        }
    }

    function subirPokemon()
    {
        //nombre de la imagen
        $nombre_imagen = $_FILES['imagen']['name'];
        //tipo de la imagen
        $tipo_imagen = $_FILES['imagen']['type'];
        //tamaño de la imagen
        $tamaño = $_FILES['imagen']['size'];

        if ($tamaño <= 3000000) {
            // verifica que sea una imagen valida
            if (
                $tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen == "image/png"
                || $tipo_imagen == "image/gif"
            ) {
                //Ruta de la carpeta destino en servidor
                //al corregir verifique que las rutas sean correctas, ya que están son de mi ordenador
                $carpeta_destino = $_SERVER['DOCUMENT_ROOT'] . '/Web II/pokedex-JoelEscobar-EvelinaNunez-LauraMartinez-EzequielWeiss/IMG/';

                //Movemos la imagen del directorio temporal al directorio escogido
                move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino . $nombre_imagen);
                //recibimos las variables del formulario
                $numero = $_POST['numero'];
                $nombre = $_POST['nombre'];
                $tipo = $_POST['tipo'];
                //usamos el metodo básico para evitar la inyección por sql, arriba en el metodo validarUsuario()
                //está explicado esto
                $solicitud2 = "INSERT INTO pokemon(numero,tipo,nombre,imagen) values(?,?,?,?)";
                //preparamos la consulta
                $stmt = $GLOBALS['conexion']->prepare($solicitud2);
                //fijate las variables con las iniciales que paso en el 1er parametro y cuantas les paso como 2do parametro
                //pd: presta atención a la variable $nombre_imagen, no pasamos la imagen sino el nombre de esa imagen :)
                $stmt->bind_param("isss", $numero, $tipo, $nombre, $nombre_imagen);
                $stmt->execute();
            } else {
                //en caso de que intente subir imagenes distintas o archivos no validos
                //lanzar un mensaje de error, diciendo los tipos que admite
                $error = "Solo se puede subir imagenes jpg/jpeg/png/gif";
                return $error;
            }
        } else {
            //si la imagen supera el tamaño de 3mb lanzara el mensaje 
            $error = "El tamaño es demasiado grande";
            return $error;
        }
    }

    function quitarPokemon()
    {
        //recibimos el número del pokemon a eliminar
        $id = $_GET['numero'];
        //usamos el metodo básico para evitar la inyección por sql, arriba en el metodo validarUsuario()
        //está explicado esto
        $solicitud = "DELETE FROM pokemon WHERE id= ?";
        //preparamos la consulta
        $stmt = $GLOBALS['conexion']->prepare($solicitud);
        //usamos el bind_param()
        $stmt->bind_param("i", $id);
        //ejecutamos
        $stmt->execute();
    }

    function seleccionarUnPokemon()
    {
        $numero = $_GET['numero'];
        $solicitud = "SELECT * FROM pokemon where id=?";
        $stmt = $GLOBALS['conexion']->prepare($solicitud);
        //usamos el bind_param()
        $stmt->bind_param("i", $numero);
        //ejecutamos
        $stmt->execute();
        //guardamos el resultado
        $result = $stmt->get_result();
        // lo retornamos
        return $result->fetch_assoc();
    }
}
