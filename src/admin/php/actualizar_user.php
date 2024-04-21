<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
    <link rel="stylesheet" href="./../../../bootstrap-5.3.3-dist/css/bootstrap.css">
    <script src="./../../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
        }

        .form-label {
            font-weight: bold;
        }

        .btn-primary {
            width: 100%;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_POST['id_usuario']) && !empty($_POST['id_usuario'])) {
        require_once "./superior.php";
        require_once "../../MYSQL/conexion.php";
        $id_usuario = $_POST['id_usuario'];
        $sql = "SELECT * FROM usuarios WHERE id_usuario = '$id_usuario'";
        $resultado = mysqli_query($conn, $sql);

        if (mysqli_num_rows($resultado) == 1) {
            $fila = mysqli_fetch_assoc($resultado);
    ?>
            <div class="container">
                <h1 class="mb-4">Actualizar Usuario</h1>
                <form id="updateForm" action="procesar_actualizacion.php" method="post">
                    <input type="hidden" name="id_usuario" value="<?php echo $fila['id_usuario']; ?>">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $fila['nombre']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido_pat" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" id="apellido_pat" name="apellido_pat" value="<?php echo $fila['apellido_pat']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="apellido_mat" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="apellido_mat" name="apellido_mat" value="<?php echo $fila['apellido_mat']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $fila['email']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $fila['telefono']; ?>" required>
                    </div>
                    <!-- Agregar script de confirmación antes de enviar el formulario -->
                    <button type="button" class="btn btn-primary" onclick="confirmUpdate()">Actualizar</button>
                </form>
            </div>
            
            <!-- Script para confirmar la actualización -->
            <script>
                function confirmUpdate() {
                    if (confirm('¿Estás seguro de que deseas actualizar este usuario?')) {
                        document.getElementById('updateForm').submit(); // Enviar el formulario si se confirma
                    }
                }
            </script>

    <?php
        } else {
            echo "<p class='text-danger'>No se encontró ningún usuario con el ID especificado.</p>";
        }

        mysqli_free_result($resultado);
        $conn->close();
    } else {
        echo "<p class='text-danger'>No se recibió un ID de usuario válido.</p>";
    }
    ?>
</body>

</html>
