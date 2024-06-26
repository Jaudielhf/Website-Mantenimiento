<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../bootstrap-5.3.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="../../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>

    <title>Contacto</title>
</head>

<body>
    <?php
    require_once "./superior_usr.php";
    ?>
    <div class="container">
        <h1 class="">Ver estaciones</h1>
        <div class="row">
            <div class="col">
                <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d22540.023557129683!2d-100.15812785946059!3d18.9089410602161!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sTejupilco%20de%20Hidalgo%20reparacion%20de%20computadoras!5e1!3m2!1ses-419!2smx!4v1712077913355!5m2!1ses-419!2smx" width="900" height="550" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            
            <div class="col">
                <div class="container text-center">
                    <h2>ESTACIONES DE REPARACION</h2>
                    <div class="Opciones">
                        <div class="btn-group">
                            <button type="button" class="btn btn-danger dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Ver estaciones
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="./estacion.php">Estacion 1</a></li>
                                <li><a class="dropdown-item" href="#">Estacion 2</a></li>
                                <li><a class="dropdown-item" href="#">Estacion 3</a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<?php
        require_once "./inferior.php";
        ?>
</body>

</html>