<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuración de Límite de Citas</title>
    <link rel="stylesheet" href="./../../../bootstrap-5.3.3-dist/css/bootstrap.css">
    <script src="./../../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
</head>
<body>
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
