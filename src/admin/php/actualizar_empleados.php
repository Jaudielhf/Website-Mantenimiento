<?php
require_once "./superior.php";
require_once "../../MYSQL/conexion.php";

$id_empleado = isset($_REQUEST['id_empleado']) ? mysqli_real_escape_string($conn, $_REQUEST['id_empleado']) : '';

if (isset($_POST['guardar_actualizacion'])) {

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conn, $_POST['nombre']) : '';
    $apellido_pat = isset($_POST['apellido_pat']) ? mysqli_real_escape_string($conn, $_POST['apellido_pat']) : '';
    $apellido_mat = isset($_POST['apellido_mat']) ? mysqli_real_escape_string($conn, $_POST['apellido_mat']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $telefono = isset($_POST['tel']) ? mysqli_real_escape_string($conn, $_POST['tel']) : '';
    $fecha_inicio = isset($_POST['fecha_inicio']) ? mysqli_real_escape_string($conn, $_POST['fecha_inicio']) : '';
    $fecha_fin = isset($_POST['fecha_fin']) ? mysqli_real_escape_string($conn, $_POST['fecha_fin']) : '';
    $hora_inicio = isset($_POST['hora_inicio']) ? mysqli_real_escape_string($conn, $_POST['hora_inicio']) : '';
    $hora_fin = isset($_POST['hora_fin']) ? mysqli_real_escape_string($conn, $_POST['hora_fin']) : '';

    $sql_update = "UPDATE empleados SET 
                   nombre = '$nombre', 
                   apellido_pat = '$apellido_pat', 
                   apellido_mat = '$apellido_mat', 
                   email = '$email', 
                   telefono = '$telefono' 
                   WHERE id_empleado = '$id_empleado'";

    $sql_update_horario = "UPDATE admin_empleados SET 
                           fecha_inicio = '$fecha_inicio', 
                           fecha_fin = '$fecha_fin', 
                           hora_inicio = '$hora_inicio', 
                           hora_fin = '$hora_fin' 
                           WHERE id_empleado = '$id_empleado'";

    $result_update = mysqli_query($conn, $sql_update);
    $result_update_horario = mysqli_query($conn, $sql_update_horario);

    if ($result_update && $result_update_horario) {
        echo '<script>';
        echo 'alert("¡Datos actualizados correctamente!");';
        echo 'window.location.href = "admin-empleados.php";';
        echo '</script>';
    } else {
        echo "<div class='container mt-4'><p>Ocurrió un error al actualizar los datos.</p></div>";
    }
}

$sql = "SELECT e.*, a.fecha_inicio, a.fecha_fin, a.hora_inicio, a.hora_fin 
        FROM empleados e 
        LEFT JOIN admin_empleados a ON e.id_empleado = a.id_empleado
        WHERE e.id_empleado = '$id_empleado'";

$resultado = mysqli_query($conn, $sql);

if ($empleado = mysqli_fetch_assoc($resultado)) {
?>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-4">
    <div class="row">
        <div class="col">
            <h1 class="mb-4">Editar Empleado</h1>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="hidden" name="id_empleado" value="<?php echo htmlspecialchars($id_empleado); ?>">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($empleado['nombre']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="apellido_pat" class="form-label">Apellido Paterno</label>
                    <input type="text" class="form-control" id="apellido_pat" name="apellido_pat" value="<?php echo htmlspecialchars($empleado['apellido_pat']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="apellido_mat" class="form-label">Apellido Materno</label>
                    <input type="text" class="form-control" id="apellido_mat" name="apellido_mat" value="<?php echo htmlspecialchars($empleado['apellido_mat']); ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($empleado['email']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="tel" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" id="tel" name="tel" value="<?php echo htmlspecialchars($empleado['telefono']); ?>">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo htmlspecialchars($empleado['fecha_inicio']); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fecha_fin" class="form-label">Fecha Fin</label>
                        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php echo htmlspecialchars($empleado['fecha_fin']); ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="hora_inicio" class="form-label">Hora Inicio</label>
                        <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" value="<?php echo htmlspecialchars($empleado['hora_inicio']); ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="hora_fin" class="form-label">Hora Fin</label>
                        <input type="time" class="form-control" id="hora_fin" name="hora_fin" value="<?php echo htmlspecialchars($empleado['hora_fin']); ?>">
                    </div>
                </div>
                <button type="submit" name="guardar_actualizacion" class="btn btn-primary">Guardar Cambios</button>
            </form>
        </div>
    </div>
</div>

<?php
} else {
    echo "<div class='container mt-4'><p>No se encontró el empleado con ID: " . $id_empleado . "</p></div>";
}
mysqli_close($conn);
?>
