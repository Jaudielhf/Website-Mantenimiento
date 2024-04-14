<?php
// Verificar si se ha enviado un formulario de actualización de cita
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar_cita'])) {
    // Verificar si se ha enviado el ID de la cita y otros datos necesarios
    if (
        isset($_POST['id_cita']) &&
        isset($_POST['id_servicio']) &&
        isset($_POST['fecha']) &&
        isset($_POST['horario']) &&
        isset($_POST['descripcion'])
    ) {
        // Obtener los datos enviados por el formulario
        $id_cita = $_POST['id_cita'];
        $id_servicio = $_POST['id_servicio'];
        $fecha = $_POST['fecha'];
        $horario = $_POST['horario'];
        $descripcion = $_POST['descripcion'];

        // Realizar la actualización en la base de datos
        require_once "../../MYSQL/conexion.php"; // Incluir archivo de conexión

        // Preparar consulta SQL para actualizar la cita
        $sql = "UPDATE citas SET 
                id_servicio = '$id_servicio',
                fecha = '$fecha',
                horario = '$horario',
                descripcion = '$descripcion'
                WHERE id_cita = '$id_cita'";

        // Ejecutar la consulta de actualización
        if (mysqli_query($conn, $sql)) {
            // Si la actualización fue exitosa, redirigir a la página de ver citas
            header("Location: ver_citas.php");
            exit;
        } else {
            // Si ocurrió un error durante la actualización, mostrar mensaje de error
            echo "Error al actualizar la cita: " . mysqli_error($conn);
        }
    } else {
        // Si faltan datos necesarios en el formulario, mostrar mensaje de error
        echo "Por favor complete todos los campos.";
    }
} else {
    // Si no se envió el formulario correctamente, redirigir a la página de ver citas
    header("Location: ver_citas.php");
    exit;
}
?>
