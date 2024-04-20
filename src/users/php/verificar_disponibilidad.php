<?php
// Incluir el archivo de conexión a la base de datos
require_once "../../MYSQL/conexion.php";

// Obtener la fecha y hora seleccionadas del cuerpo de la solicitud POST
$fechaSeleccionada = $_POST['fecha'];
$horaSeleccionada = $_POST['hora'];

// Consulta SQL para verificar si hay una cita programada para la fecha y hora seleccionadas
$sql = "SELECT COUNT(*) AS num_citas FROM citas WHERE fecha = '$fechaSeleccionada' AND horario = '$horaSeleccionada'";
$resultado = mysqli_query($conn, $sql);

// Verificar si se encontraron citas programadas para la fecha y hora seleccionadas
if ($resultado) {
    $fila = mysqli_fetch_assoc($resultado);
    $numCitas = $fila['num_citas'];

    // Crear un array para almacenar la respuesta JSON
    $response = array();

    // Verificar si hay citas programadas en la fecha y hora seleccionadas
    if ($numCitas > 0) {
        // Indicar que la fecha y hora seleccionadas no están disponibles
        $response['disponible'] = false;
    } else {
        // Indicar que la fecha y hora seleccionadas están disponibles
        $response['disponible'] = true;
    }

    // Enviar la respuesta JSON al cliente
    echo json_encode($response);
} else {
    // Manejar el caso de error en la consulta SQL
    $response['error'] = 'Error al verificar la disponibilidad en la base de datos';
    echo json_encode($response);
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
