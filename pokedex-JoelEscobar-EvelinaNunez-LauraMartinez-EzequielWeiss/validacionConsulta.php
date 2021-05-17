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
        //Cuando llamamos este método recibimos 2 parámetros (el usuario y la contraseña)
        //esta es una de las formas básicas de evitar una forma de hackeo de sql por inyección
        //armamos la solicitud
        $solicitud = "SELECT * from usuario where nombre = ? and pass = ?";
        //preparamos la consulta usando la variable conexion de la bd que en este caso está dentro de globals
        //enviamos la solicitud
        $stmt = $GLOBALS['conexion']->prepare($solicitud);
        //recibimos los 2 datos del formulario para ejecutar bien el método
        $usuario = $_POST["user"];
        $clave = $_POST["pass"];
        //De acuerdo a los tipos de datos que estemos tratando de pasar a la bd,
        //con el método bind_param le asociamos los parámetros()
        $stmt->bind_param("ss", $usuario, $clave);
        //ejecutamos la sentencia
        $stmt->execute();
        //guardamos el resultado
        $result = $stmt->get_result();
        // lo retornamos
        return $result->fetch_assoc();
    }

    function modificarPokemon()
    {   //nombre de la imagen
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
                $carpeta_destino ="recursos/IMG/";
                //Movemos la imagen del directorio temporal al directorio escogido
                move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino . $nombre_imagen);
                //recibimos los datos del pokemon
                $numero = $_POST['numero'];
                $nombre = $_POST['nombre'];
                $tipo = $_POST['tipo'];

                $solicitud2 = "UPDATE pokemon SET numero = ?, nombre = ?, tipo = ?, imagen = ? WHERE id =?";
                //preparamos la consulta
                $stmt = $GLOBALS['conexion']->prepare($solicitud2);

                $stmt->bind_param("isssi", $numero, $nombre, $tipo, $nombre_imagen, $GLOBALS['id'],);

                $stmt->execute();
            } else {
                //En caso de que intente subir imagenes distintas o archivos no válidos,
                //lanzar un mensaje de error, diciendo los tipos que admite
                $error = "Sólo se puede subir imagenes jpg/jpeg/png/gif";
                return $error;
            }
        } else {
            //si la imagen supera el tamaño de 3mb, lanzará el mensaje
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
                $carpeta_destino ="recursos/IMG/";
                //Movemos la imagen del directorio temporal al directorio escogido
                move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta_destino . $nombre_imagen);
                //recibimos las variables del formulario
                $numero = $_POST['numero'];
                $nombre = $_POST['nombre'];
                $tipo = $_POST['tipo'];

                $solicitud2 = "INSERT INTO pokemon(numero,tipo,nombre,imagen) values(?,?,?,?)";
                //preparamos la consulta
                $stmt = $GLOBALS['conexion']->prepare($solicitud2);
                $stmt->bind_param("isss", $numero, $tipo, $nombre, $nombre_imagen);
                $stmt->execute();
            } else {
                //En caso de que intente subir imagenes distintas o archivos no válidos,
                //lanzar un mensaje de error, diciendo los tipos que admite
                $error = "Sólo se puede subir imágenes jpg/jpeg/png/gif";
                return $error;
            }
        } else {
            //si la imagen supera el tamaño de 3mb, lanzará el mensaje
            $error = "El tamaño es demasiado grande";
            return $error;
        }
    }

    function quitarPokemon()
    {
        //recibimos el número del pokemon a eliminar
        $id = $_GET['numero'];
        $solicitud = "DELETE FROM pokemon WHERE id= ?";
        //preparamos la consulta
        $stmt = $GLOBALS['conexion']->prepare($solicitud);
        $stmt->bind_param("i", $id);
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
