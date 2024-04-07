<?php
require_once "../../MYSQL/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_user'];
    $id_servicio = $_POST['servicio'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $id_empleado = $_POST['empleado'];
    $descripcion = $_POST['descripcion'];

    $sql_count_citas = "SELECT COUNT(*) AS num_citas FROM citas WHERE fecha = '$fecha'";
    $result_count_citas = mysqli_query($conn, $sql_count_citas);

    if ($result_count_citas) {
        $row_count_citas = mysqli_fetch_assoc($result_count_citas);
        $num_citas = $row_count_citas['num_citas'];

        $sql_limit_citas = "SELECT max_citas_por_dia FROM configuracion_citas WHERE id = 1";
        $result_limit_citas = mysqli_query($conn, $sql_limit_citas);

        if ($result_limit_citas) {
            $row_limit_citas = mysqli_fetch_assoc($result_limit_citas);
            $max_citas_por_dia = $row_limit_citas['max_citas_por_dia'];

            if ($num_citas >= $max_citas_por_dia) {

                echo "<script>alert('Se ha alcanzado el límite de citas para esta fecha. Por favor, elige otra fecha.');</script>";
            } else {
                $sql_insert_cita = "INSERT INTO citas (id_usuario, id_servicio, fecha, horario, id_empleado, descripcion) VALUES ('$id_usuario', '$id_servicio', '$fecha', '$hora', '$id_empleado', '$descripcion')";
                $resultado = mysqli_query($conn, $sql_insert_cita);

                if ($resultado) {
                    echo "<script>alert('Cita agregada correctamente');</script>";
                    echo "<script>window.location.href='./ver_citas.php';</script>";
                } else {
                    echo "<script>alert('Error al agregar cita');</script>";
                }
            }
        } else {
            echo "<script>alert('Error al obtener el límite de citas por día.');</script>";
        }
    } else {
                echo "<script>alert('Error al verificar las citas existentes.');</script>";
    }
}
?>
