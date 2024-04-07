<?php
// Verificar si se recibió un ID de empleado válido
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_empleado'])) {
    // Incluir archivo de conexión a la base de datos
    require_once "../../MYSQL/conexion.php";
    
    // Obtener el ID del empleado a eliminar
    $id_empleado = $_POST['id_empleado'];
    
    // Consulta SQL para eliminar registros relacionados en 'admin_empleados' primero
    $sql_delete_admin_empleados = "DELETE FROM admin_empleados WHERE id_empleado = '$id_empleado'";
    
    // Ejecutar la consulta para eliminar registros en 'admin_empleados'
    if (mysqli_query($conn, $sql_delete_admin_empleados)) {
        // Ahora que los registros relacionados han sido eliminados, proceder con la eliminación del empleado
        $sql_delete_empleado = "DELETE FROM empleados WHERE id_empleado = '$id_empleado'";
        
        // Ejecutar la consulta para eliminar al empleado
        if (mysqli_query($conn, $sql_delete_empleado)) {
            // Empleado eliminado correctamente
            echo json_encode(array("status" => "success", "message" => "Empleado eliminado correctamente"));
        } else {
            // Error al eliminar empleado
            echo json_encode(array("status" => "error", "message" => "Error al eliminar empleado: " . mysqli_error($conn)));
        }
    } else {
        // Error al eliminar registros relacionados en 'admin_empleados'
        echo json_encode(array("status" => "error", "message" => "Error al eliminar registros relacionados en admin_empleados: " . mysqli_error($conn)));
    }
} else {
    // Redireccionar si se accede directamente a este archivo sin una solicitud POST válida
    header("Location: index.php"); // Cambia 'index.php' al nombre de tu página principal
    exit();
}
?>
