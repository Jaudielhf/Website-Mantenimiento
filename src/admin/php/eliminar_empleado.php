<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_empleado'])) {
    require_once "../../MYSQL/conexion.php";
    
    $id_empleado = $_POST['id_empleado'];
    
    $sql_delete_admin_empleados = "DELETE FROM admin_empleados WHERE id_empleado = '$id_empleado'";
    
    if (mysqli_query($conn, $sql_delete_admin_empleados)) {
        $sql_delete_empleado = "DELETE FROM empleados WHERE id_empleado = '$id_empleado'";
        
        if (mysqli_query($conn, $sql_delete_empleado)) {

            echo json_encode(array("status" => "success", "message" => "Empleado eliminado correctamente"));
            
        } else {
            echo json_encode(array("status" => "error", "message" => "Error al eliminar empleado: " . mysqli_error($conn)));
        }
    } else {
        echo json_encode(array("status" => "error", "message" => "Error al eliminar registros relacionados en admin_empleados: " . mysqli_error($conn)));
    }
} else {
    header("Location: admin-empleados.php");
    exit();
}
?>
