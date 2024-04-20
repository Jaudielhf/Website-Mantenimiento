<?php
require_once "../../MYSQL/conexion.php";
require_once "../../../vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_user'];
    $id_servicio = $_POST['servicio'];
    $id_estaciones=$_POST['estaciones'];
    $id_estaciones = $_POST['estaciones'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $id_empleado = $_POST['empleado'];
    $descripcion = $_POST['descripcion'];

    $inicio_jornada = strtotime(date('Y-m-d 07:00:00', strtotime($fecha)));
    $fin_jornada = strtotime(date('Y-m-d 17:00:00', strtotime($fecha)));
    $fecha_hora_cita = strtotime("$fecha $hora");

    if ($fecha_hora_cita < $inicio_jornada || $fecha_hora_cita > $fin_jornada) {
        echo "<script>alert('La hora de la cita está fuera del horario laboral (7am - 5pm).');</script>";
        echo "<script>window.location.href='./ver_citas.php';</script>";
        exit;
    }
    $sql_check_cita_otros_usuarios = "SELECT * FROM citas 
                                       WHERE fecha = '$fecha' 
                                         AND horario = '$hora' 
                                         AND id_empleado = '$id_empleado' 
                                         AND id_usuario != '$id_usuario'";

    $result_check_cita_otros_usuarios = mysqli_query($conn, $sql_check_cita_otros_usuarios);

    if (mysqli_num_rows($result_check_cita_otros_usuarios) > 0) {
        echo "<script>alert('Otro usuario tiene una cita agendada a esta fecha y hora con este empleado. Por favor, elige otra fecha u hora.');";
        echo "window.location.href='./ver_citas.php';</script>";
        exit;
    }

    $sql_check_cita_empleado = "SELECT * FROM citas 
                                WHERE fecha = '$fecha' 
                                  AND horario = '$hora' 
                                  AND id_empleado = '$id_empleado'";

    $result_check_cita_empleado = mysqli_query($conn, $sql_check_cita_empleado);

    if (mysqli_num_rows($result_check_cita_empleado) > 0) {
        echo "<script>alert('Ya tienes una cita agendada a esta fecha y hora con el mismo empleado. Por favor, elige otra fecha u hora.');";
        echo "window.location.href='./ver_citas.php';</script>";
        exit;
    }

    $sql_check_cita_usuario = "SELECT * FROM citas 
                               WHERE fecha = '$fecha' 
                                 AND horario = '$hora' 
                                 AND id_usuario = '$id_usuario'";

    $result_check_cita_usuario = mysqli_query($conn, $sql_check_cita_usuario);

    if (mysqli_num_rows($result_check_cita_usuario) > 0) {
        echo "<script>alert('Ya tienes una cita agendada a esta fecha y hora con otro empleado. Por favor, elige otra fecha u hora.');";
        echo "window.location.href='./ver_citas.php';</script>";
        exit;
    }

    $sql_insert_cita = "INSERT INTO citas (id_usuario, id_servicio, fecha, horario, id_empleado, id_estaciones, id_estaciones, descripcion) 
                        VALUES ('$id_usuario', '$id_servicio', '$fecha', '$hora', '$id_empleado', $id_estaciones, $id_estaciones, '$descripcion')";

    if (mysqli_query($conn, $sql_insert_cita)) {
        
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'cesarneri803@gmail.com';
            $mail->Password = 'kyoi thod ximj mipk';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('cesarneri803@gmail.com', 'Mantenimiento y Reparaciones');
            $mail->addAddress('cesarneri803@gmail.com', 'Administrador');
            $mail->isHTML(true);
            $mail->Subject = 'Nueva cita agendada';

            $loginUrl = 'http://localhost/Mantenimiento-pagina-Web/src/admin/php/citas.php';
            $mail->Body = "Se ha agendado una nueva cita:<br><br>
                           Usuario: $id_usuario<br>
                           Fecha: $fecha<br>
                           Hora: $hora<br>
                           Descripción: $descripcion<br><br>
                           Por favor, inicia sesión <a href='$loginUrl'>aquí</a> para revisar las citas.";

            $mail->send();
            echo "<script>alert('Cita agregada correctamente');</script>";
            echo "<script>window.location.href='./ver_citas.php';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Error al enviar notificación al administrador');</script>";
            echo "<script>window.location.href='./ver_citas.php';</script>";
        }
    } else {
        echo "<script>alert('Error al agregar cita');</script>";
        echo "<script>window.location.href='./ver_citas.php';</script>";
    }
} else {
    echo "<script>alert('Acceso no autorizado');</script>";
    echo "<script>window.location.href='./ver_citas.php';</script>";
}
?>
