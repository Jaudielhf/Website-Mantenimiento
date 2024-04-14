<?php
require_once "../../MYSQL/conexion.php";

// Verificar si se recibió un ID de empleado válido en la URL
$id_empleado = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';

// Mensajes de depuración para verificar el ID del empleado
echo "ID Empleado: " . $id_empleado . "<br>";

// Consulta SQL para obtener los datos del empleado y sus horarios
$sql = "SELECT e.*, a.fecha_inicio, a.fecha_fin, a.hora_inicio, a.hora_fin 
        FROM empleados e 
        LEFT JOIN admin_empleados a ON e.id_empleado = a.id_empleado
        WHERE e.id_empleado = '$id_empleado'";

// Mensaje de depuración para verificar la consulta SQL
echo "Consulta SQL: " . $sql . "<br>";

// Ejecutar la consulta SQL
$resultado = mysqli_query($conn, $sql);

if ($empleado = mysqli_fetch_assoc($resultado)) {
    // Mostrar el formulario de edición con los datos del empleado
?>

<div class="container mt-4">
    <h1 class="mb-4">Editar Empleado</h1>
    <div class="row">
        <div class="col">
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
                <div class="mb-3">
                    <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="<?php echo htmlspecialchars($empleado['fecha_inicio']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_fin" class="form-label">Fecha Fin</label>
                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="<?php echo htmlspecialchars($empleado['fecha_fin']); ?>">
                </div>
                <div class="mb-3">
                    <label for="hora_inicio" class="form-label">Hora Inicio</label>
                    <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" value="<?php echo htmlspecialchars($empleado['hora_inicio']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="hora_fin" class="form-label">Hora Fin</label>
                    <input type="time" class="form-control" id="hora_fin" name="hora_fin" value="<?php echo htmlspecialchars($empleado['hora_fin']); ?>">
                </div>
                <button type="submit" name="guardar_actualizacion" class="btn btn-primary">Guardar Cambios</button>
            </form>
        </div>
    </div>
</div>

<?php
} else {
    // Mostrar un mensaje de error si no se encontró el empleado
    echo "<div class='container mt-4'><p>No se encontró el empleado con ID: " . $id_empleado . "</p></div>";
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
?>
