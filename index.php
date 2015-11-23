
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Ejercicio PHP</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" >    <!-- Bootstrap theme -->

</head>

<body >

    <?php
        require_once('cliente.php');
    ?>


    <div id="back-ground-form" class="container" style="display:none; opacity: 0;"></div> <!-- Backgound form-->
    <div id="form" class="container" style=" display:none; opacity: 0; border-radius: 10px;" >
        <?php include('form.html'); ?>
    </div> <!-- form new client-->

    <div class="container" >

        <div class="page-header">
            <h2>Ejercicio php</h2>
            <p>Tabla que muestra valores obtenidos de una tabla clientes, los cuales se podran eliminar mediante un botón y crear de nuevos.</p>
            <p>PHP, MySQL, Bootstrap, y Ajax para la inserción, eliminación en base de datos y actualización visual de datos instantáneamente.</p>
            <h1>Tabla</h1>
        </div>

        <div class="row">
            <div class="">
                <table class="table">
                    <thead>
                    <tr>
                        <th>Del.</th>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Fecha nacimiento</th>
                        <th>País</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $show_values = new Cliente();
                            $show_values->showValue();
                        ?>
                    </tbody>
                </table>
                <button id='nuevo' type="button" class="btn btn-success" >Nuevo</button>
                <div id="mess"></div>
            </div>
        </div>

    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="ajax.js"></script>

    <footer class="panel-footer" style="margin-top: 50px;">

    </footer>
</body>
</html>
