<?php 
require_once "./superior_usr.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ESTACIONES</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div class="mapa">
                <iframe src="https://www.google.com/maps/embed?pb=!4v1712722996374!6m8!1m7!1srGpdd52cXstPNgjmT5XiIw!2m2!1d18.90807544345983!2d-100.1523291485407!3f319.029539180259!4f-14.992750362688255!5f0.7820865974627469" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
            <div class="col">
                <?php 
                require_once "./citas.php";
                ?>
            </div>
        </div>
    </div>
</body>
</html>