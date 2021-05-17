<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="recursos/IMG/icons8-pokedex-48.png">
    <title>Tp 5 - Pokédex</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <header>
        <div class="container-fluid m-0 p-0">
            <div class="row m-0 p-0">
                <div class="col m-0 p-0">
                    <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                        <a href="home.php" class="navbar-brand"><img src="recursos/IMG/icons8-pokedex-48.png" style="width:100px;"></a>
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
                                // si la variable está vacía, entonces el usuario no podrá ingresar al home.php
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