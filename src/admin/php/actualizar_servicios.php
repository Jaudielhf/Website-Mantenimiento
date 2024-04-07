<?php
// Verificar si se recibió un ID válido por parámetro GET
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_servicio = $_GET['id'];

    // Establecer conexión con la base de datos
    require_once "../../MYSQL/conexion.php";

    // Verificar si se envió el formulario para actualizar el servicio
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recibir y sanitizar los datos del formulario
        $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
        $precio = mysqli_real_escape_string($conn, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($conn, $_POST['descripcion']);

        // Verificar si se subió una nueva imagen
        if ($_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
            $imagen_tmp = $_FILES['imagen']['tmp_name'];
            $imagen_nombre = $_FILES['imagen']['name'];
            $imagen_tipo = $_FILES['imagen']['type'];

            // Mover la imagen a una ubicación permanente en el servidor
            $imagen_ruta = '../../img/' . $imagen_nombre;
            move_uploaded_file($imagen_tmp, $imagen_ruta);

            // Actualizar el registro en la base de datos, incluyendo la imagen
            $sql = "UPDATE servicios SET nombre='$nombre', precio='$precio', descripcion='$descripcion', imagen='$imagen_nombre' WHERE id_servicio='$id_servicio'";
        } else {
            // Actualizar el registro en la base de datos sin cambiar la imagen
            $sql = "UPDATE servicios SET nombre='$nombre', precio='$precio', descripcion='$descripcion' WHERE id_servicio='$id_servicio'";
        }

        $resultado = mysqli_query($conn, $sql);

        if ($resultado) {
            echo "<script>alert('Servicio actualizado correctamente');</script>";
            echo "<script>window.location.href='./servicios.php';</script>"; // Redirigir a la página de administración de servicios
            exit;
        } else {
            echo "<p>Error al actualizar el servicio</p>";
        }
    }

    $sql_select = "SELECT * FROM servicios WHERE id_servicio='$id_servicio'";
    $resultado_select = mysqli_query($conn, $sql_select);

    if (mysqli_num_rows($resultado_select) > 0) {
        $servicio = mysqli_fetch_assoc($resultado_select);
    } else {
        echo "<p>Servicio no encontrado</p>";
        exit;
    }

    // Cerrar la conexión
    mysqli_close($conn);
} else {
    echo "<p>ID de servicio inválido</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Servicio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #007bff;
        }

        label {
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="file"] {
            margin-bottom: 15px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        img {
            max-width: 200px;
            height: auto;
            margin-bottom: 15px;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Actualizar Servicio</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $id_servicio; ?>" method="post" enctype="multipart/form-data">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($servicio['nombre']); ?>"><br>
            
            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" value="<?php echo htmlspecialchars($servicio['precio']); ?>"><br>
            
            <label for="descripcion">Descripción:</label><br>
            <textarea id="descripcion" name="descripcion"><?php echo htmlspecialchars($servicio['descripcion']); ?></textarea><br>
            
            <label for="imagen">Imagen:</label><br>
            <img src="../../img/<?php echo htmlspecialchars($servicio['imagen']); ?>" alt="Imagen Actual"><br>
            <input type="file" id="imagen" name="imagen"><br>
            
            <input type="submit" value="Actualizar">
        </form>
    </div>
</body>

</html>
