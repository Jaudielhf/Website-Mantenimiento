<?php
   require_once "../../MYSQL/conexion.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_estaciones'])) {
    // Obtener el ID del registro a eliminar desde la solicitud POST
    $id = $_POST['id_estaciones'];

    // Consulta SQL para eliminar el registro con el ID proporcionado
    $sql = "DELETE FROM estaciones WHERE id_estaciones = $id";

    // Ejecutar la consulta
    if (mysqli_query($conn, $sql)) {
        // Si se elimina correctamente, enviar una respuesta de éxito al cliente
        http_response_code(200);
        echo "Registro eliminado correctamente.";
    } else {
        // Si hay un error al eliminar el registro, enviar una respuesta de error al cliente
        http_response_code(500);
        echo "Error al eliminar el registro.";
    }
} else {
    // Si la solicitud no es de tipo POST o falta el ID del registro, enviar una respuesta de error al cliente
    http_response_code(400);
    echo "Solicitud no válida.";
}
?>
