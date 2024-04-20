<?php
require_once "../../MYSQL/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar que se ha recibido el nombre de la estación
    if (!empty($_POST['nombre'])) {
        $nombre_estacion = $_POST['nombre'];

        // Preparar la consulta SQL con un marcador de posición para el id_estaciones
        $sql = "INSERT INTO estaciones (nombre) VALUES (?)";

        // Preparar la declaración para ejecutar la consulta
        $stmt = mysqli_prepare($conn, $sql);

        // Vincular parámetros y ejecutar la consulta
        mysqli_stmt_bind_param($stmt, "s", $nombre_estacion);
        $resultado = mysqli_stmt_execute($stmt);

        // Verificar si la consulta se ejecutó con éxito
        if ($resultado) {
            echo "<script>alert('Estación registrada correctamente');</script>";
            echo "<script>window.location.href='./Estaciones.php';</script>";
        } else {
            echo "<p>Error al registrar la estación</p>";
        }
    } else {
        echo "<p>Nombre de estación vacío</p>";
    }
} else {
    echo "<p>Error al registrar la estación</p>";
}
?>
