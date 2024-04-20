<?php
// Verificar si se ha enviado una imagen
if (isset($_FILES['imagen'])) {
    // Conectar a la base de datos
    require_once "../../MYSQL/conexion.php";

    // Obtener información sobre la imagen
    $nombre_imagen = $_FILES['imagen']['name'];
    $extension = pathinfo($nombre_imagen, PATHINFO_EXTENSION); // Obtener la extensión del archivo

    // Mover la imagen al directorio de destino
    $directorio_destino = '../../img/';
    $ruta_destino = $directorio_destino . $nombre_imagen;
    move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_destino);

    // Obtener información adicional del formulario
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $anticipo=$_POST['anticipo'];
    $descripcion = $_POST['descripcion'];

    // Insertar la información en la base de datos
    $sql = "INSERT INTO servicios (nombre, precio, descripcion, imagen, anticipo) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sdssd", $nombre, $precio, $descripcion, $nombre_imagen, $anticipo);
    mysqli_stmt_execute($stmt);

    // Verificar si la inserción fue exitosa
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<script>alert('Servicio registrado correctamente');</script>";
            echo "<script>window.location.href='./servicios.php';</script>";
    } else {
        echo "Error al guardar la información en la base de datos.";
    }

    // Cerrar la conexión y liberar los recursos
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
