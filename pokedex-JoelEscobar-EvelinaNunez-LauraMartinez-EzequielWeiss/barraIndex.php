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
                            <ul class="navbar-nav">
                                <form action="validacion.php" class="form-inline" method="POST" enctype="multipart/form-data">
                                    <div class="btn-group">
                                        <input type="text" name="user" placeholder="Usuario" class="ml-3 form-control">
                                        <input type="password" name="pass" placeholder="password" class="ml-3 form-control">
                                        <input class="ml-3 btn btn-success" type="submit" value="Ingresar"></input>
                                    </div>
                                </form>

                            </ul>
                        </div>
                    </nav>
    </header>