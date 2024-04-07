<?php
require_once "../../MYSQL/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['max_citas'])) {
    $max_citas = $_POST['max_citas'];

    // Actualizar el valor en la tabla configuracion_citas
    $sql_update = "UPDATE configuracion_citas SET max_citas_por_dia = $max_citas WHERE id = 1";

    if (mysqli_query($conn, $sql_update)) {
        echo "Límite de citas actualizado correctamente.";
    } else {
        echo "Error al actualizar el límite de citas: " . mysqli_error($conn);
    }
}
?>
