<?php
require_once("../../MYSQL/conexion.php");
// Obtener el ID del servicio desde la solicitud POST
$servicioId = $_POST['servicio_id'];

// Consultar la base de datos para obtener el anticipo correspondiente al servicio seleccionado
$sql = "SELECT anticipo FROM servicios WHERE id_servicio = $servicioId";

$resultado = mysqli_query($conn, $sql);

if ($resultado) {
    $fila = mysqli_fetch_assoc($resultado);
    $anticipo = $fila['anticipo'];

    // Devolver el anticipo como respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode(['anticipo' => $anticipo]);

    // Liberar el resultado
    mysqli_free_result($resultado);
} else {
    // Manejar cualquier error de consulta
    echo "Error al ejecutar la consulta: " . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>