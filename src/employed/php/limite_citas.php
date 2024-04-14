
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Límite de Citas</title>
    <link rel="stylesheet" href="./../../../bootstrap-5.3.3-dist/css/bootstrap.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        label {
            font-weight: bold;
        }

        .form-control {
            margin-bottom: 20px;
        }

        .btn-primary {
            width: 100%;
        }
    </style>
</head>

<body>
<?php
    require_once "./superior.php";
    ?>
    <div class="container mt-4">
        <h1>Configuración de Límite de Citas</h1>
        <form action="guardar_limite_citas.php" method="post">
            <div class="mb-3">
                <label for="max_citas" class="form-label">Máximo de Citas por Día:</label>
                <input type="number" class="form-control" id="max_citas" name="max_citas" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
        <a href="../php/citas.php" class="btn btn-secondary mt-3">Regresar</a>
    </div>
</body>

</html>
