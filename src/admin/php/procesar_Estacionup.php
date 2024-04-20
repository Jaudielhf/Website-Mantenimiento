<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si se recibió un ID de usuario válido
    if (isset($_POST['id_estaciones']) && !empty($_POST['id_estaciones'])) {
        require_once "../../MYSQL/conexion.php"; // Incluir archivo de conexión a la base de datos

        // Recuperar los datos del formulario
        $id_estaciones = $_POST['id_estaciones'];
        $nombre = $_POST['nombre'];
    

        // Preparar la consulta SQL para actualizar el usuario
        $sql = "UPDATE estaciones SET nombre = '$nombre' 
                WHERE id_estaciones = '$id_estaciones'";

        // Ejecutar la consulta y verificar si fue exitosa
        if ($conn->query($sql) === TRUE) {
            // Redirigir a admin_user.php después de la actualización exitosa
            header("Location: Estaciones.php");
            exit; // Asegurarse de que el script se detenga después de la redirección
        } else {
            echo "<p class='text-danger'>Error al actualizar usuario: " . $conn->error . "</p>";
        }

        // Cerrar la conexión
        $conn->close();
    } else {
        echo "<p class='text-danger'>No se recibió un ID de usuario válido.</p>";
    }
} else {
    // Si no es una solicitud POST, redireccionar o mostrar un mensaje de error apropiado
    echo "<p class='text-danger'>Acceso denegado.</p>";
}
?>
