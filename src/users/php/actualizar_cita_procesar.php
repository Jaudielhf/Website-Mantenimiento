<?php
// Verificar si se ha enviado un formulario de actualización de cita
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar_cita'])) {
    // Verificar si se ha enviado el ID de la cita y otros datos necesarios
    if (
        isset($_POST['id_cita']) &&
        isset($_POST['id_servicio']) &&
        isset($_POST['fecha']) &&
        isset($_POST['horario']) &&
        isset($_POST['anticipo']) &&
        isset($_POST['descripcion'])
    ) {
        // Obtener los datos enviados por el formulario
        $id_cita = $_POST['id_cita'];
        $id_servicio = $_POST['id_servicio'];
        $fecha = $_POST['fecha'];
        $horario = $_POST['horario'];
        $anticipo = $_POST['anticipo'];
        $descripcion = $_POST['descripcion'];

        // Realizar la actualización en la base de datos
        require_once "../../MYSQL/conexion.php"; // Incluir archivo de conexión

        // Validar disponibilidad de la cita actualizada
        $sql_check_cita = "SELECT * FROM citas 
                           WHERE fecha = '$fecha' 
                           AND horario = '$horario' 
                           AND id_cita != '$id_cita'"; // Excluir la cita actualizada

        $result_check_cita = mysqli_query($conn, $sql_check_cita);

        if (mysqli_num_rows($result_check_cita) > 0) {
            // Ya existe otra cita a la misma fecha y hora
            echo "<script>alert('Ya existe una cita agendada con esta fecha y hora. Por favor, elige otra fecha u hora');";
            echo "window.location.href='./ver_citas.php';</script>";
        } else {
            // No hay conflicto de horario, proceder con la actualización
            $sql_update_cita = "UPDATE citas SET 
                                id_servicio = '$id_servicio',
                                fecha = '$fecha',
                                horario = '$horario',
                                descripcion = '$descripcion',
                                anticipo = '$anticipo'
                                WHERE id_cita = '$id_cita'";

            // Ejecutar la consulta de actualización
            if (mysqli_query($conn, $sql_update_cita)) {
                // Si la actualización fue exitosa, redirigir a la página de ver citas
                header("Location: ver_citas.php");
                exit;
            } else {
                // Si ocurrió un error durante la actualización, mostrar mensaje de error
                echo "Error al actualizar la cita: " . mysqli_error($conn);
            }
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
