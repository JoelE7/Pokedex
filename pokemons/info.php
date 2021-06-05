<?php

// si quiere acceder a esta pagina sin enviar a un dato, ejecutamos un script para enviarlo de vuelta a la pagina anterior
if(!isset($_GET['inicio'])){
    echo "<script>window.history.back();</script>";
    // ponemos el exit para que deje de ejecutarse la página ya que es inútil si no tenemos el dato pasado
    exit();
}
// guardamos la variable pasada si es que llegó
$verdad = $_GET['inicio'];

// una doble validacion por si se llega a romper lo de arriba
//si verdad es 1 entra
if($verdad==1){
    // si verdad no existe lo mandamos al index
    if(!isset($verdad)){
        require_once("index.php");
    }else{
        // ahora si existe, en esta página info se mostrará la barra del index
        require_once("barraIndex.php");   
    }
    // si verdad es 2, le ponemos la barra del home
}else if($verdad==2){
    require_once("barraHome.php");
}else{
    // caso de que llegue a salir todo mal mandamos un mensaje de error
    echo "Ha ocurrido un error,vuelva atrás";
    // dejamos de ejecutar la página
    exit();
}

?>
<div class="container-fluid">
    <div class="row">
        <div class="col bg-success">
            <?php
            // traemos la ejecución de la bd
            require_once("conexionALaBaseDeDatos.php");
            // traremos la clase validacionConsulta();
            require_once("validacionConsulta.php");
            // la instanciamos
            $validador = new validarConsultas();
            // ejecutamos el seleccionarPokemon() y lo traemos de acuerdo a la variable que nos llegó y lo guardamos dentro de una variable
            $fila = $validador->seleccionarUnPokemon();
            ?>
            <!-- mostramos su informacion -->
                <div class="bg-danger card-header mt-5">
                    <?php echo '<img src="recursos/IMG/' . $fila['imagen'] . '" class="float-left img-fluid"  style="width:25em; height:25em;"';?><br>   
                    <?php echo '<img src="recursos/IMG/' . $fila['tipo']  . ".png".  '" class="float-left img-fluid"  style="width:4.5em; height:4.5em;"';?><br>   
                    <h1 class="text-white font-italic display-4"><?php echo $fila['nombre'] ?></h1>
                    <p class="text-dark font-italic" style="font-size: 1.2em;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi provident incidunt, iure accusantium praesentium sed ipsa beatae nobis est corrupti natus modi nostrum corporis ea debitis assumenda in enim odio.
                    Ratione nobis quisquam veniam numquam dicta nesciunt qui necessitatibus est nostrum nulla cumque nisi ipsum rerum autem iusto placeat harum accusantium eaque quibusdam neque, dolorem dolores quidem. Libero, distinctio aspernatur!
                    Aut tenetur perferendis vitae sapiente non, ab id asperiores quam alias perspiciatis omnis saepe. Provident distinctio neque quaerat dolor alias tenetur vitae, quos ipsum earum eveniet possimus mollitia doloribus a!
                    Quae veniam dolorem hic quam maiores obcaecati soluta mollitia sint quaerat, at quis harum tempore sed sit laborum. In a error tenetur sint repellat voluptatum atque facere, consectetur maxime ab?
                    Ipsam laborum sint iste assumenda earum vero quia cum saepe voluptatem id veniam provident quae perspiciatis reprehenderit voluptates, delectus eaque, quod eius voluptatum architecto ea ad! Quaerat quos delectus in!
                    Repudiandae, accusantium, delectus quaerat illum illo nisi voluptate vel assumenda labore nulla a architecto nobis unde. Esse quam commodi cupiditate fugiat non consequatur veniam, illo explicabo nisi itaque dolorum hic.
                    Harum quisquam quidem aspernatur autem recusandae ducimus laudantium facilis officia eius. Dolores alias quasi rerum culpa quod nesciunt dolor itaque temporibus officiis porro optio, ratione ipsum? Veniam nemo quia vel!
                    Natus repudiandae perferendis debitis corporis voluptatum, molestias quasi vero labore impedit rerum at accusamus voluptatem exercitationem. Iure debitis ab cumque fugiat recusandae, voluptatibus, expedita adipisci quas illo deserunt maiores ipsam?
                    Dignissimos voluptate laudantium quae quidem corrupti eligendi deserunt quod labore architecto nostrum expedita harum, nesciunt molestiae iste, voluptatibus facere, minus quos doloremque facilis itaque distinctio minima unde aspernatur voluptates. Officia?
                    Minus quae fugit tempora molestiae veritatis nihil amet, placeat assumenda voluptas praesentium, minima quia soluta odio, quisquam officia maiores? Recusandae quo enim sapiente deserunt voluptates autem nulla mollitia dignissimos debitis!</p>
                </div>
                <a href="home.php"><button type="submit" class="btn btn-warning form-control">Volver</button></a>
         </div>
    </div>
</div>
