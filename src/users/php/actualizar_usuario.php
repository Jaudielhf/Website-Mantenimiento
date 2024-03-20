<?php
// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir los datos del formulario
    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $apellidoP = $_POST['apellidoP'];
    $apellidoM = $_POST['apellidoM'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    // Conectar a la base de datos y ejecutar la consulta para actualizar los datos del usuario
    // Aquí debes establecer la conexión a tu base de datos y ejecutar la consulta SQL para actualizar los datos del usuario utilizando el id_usuario recibido
    require_once "../../MYSQL/conexion.php";

    $sql = "UPDATE usuarios SET nombre='$nombre', apellido_pat='$apellidoP', apellido_mat='$apellidoM', email='$email', telefono='$telefono' WHERE id_usuario=$id_usuario";

    if (mysqli_query($conn, $sql)) {
        // Redirigir de vuelta a la página de edición con un mensaje de éxito
        header("Location: editar_usuario.php?success=1");
        exit();
    } else {
        echo "Error al actualizar los datos del usuario: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
