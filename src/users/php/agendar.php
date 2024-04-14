<?php
require_once "../../MYSQL/conexion.php";
require_once "../../../vendor/autoload.php"; // Asegúrate de la ruta correcta al autoload de PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_POST['id_user'];
    $id_servicio = $_POST['servicio'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $id_empleado = $_POST['empleado'];
    $descripcion = $_POST['descripcion'];

    // Insertar la cita en la base de datos
    $sql_insert_cita = "INSERT INTO citas (id_usuario, id_servicio, fecha, horario, id_empleado, descripcion) 
                        VALUES ('$id_usuario', '$id_servicio', '$fecha', '$hora', '$id_empleado', '$descripcion')";

    if (mysqli_query($conn, $sql_insert_cita)) {
        // Cita agregada correctamente

        // Envío de correo de notificación al administrador
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'cesarneri803@gmail.com'; // Correo del administrador
            $mail->Password = 'kyoi thod ximj mipk'; // Contraseña del correo del administrador
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('cesarneri803@gmail.com', 'Mantenimiento y Reparaciones');
            $mail->addAddress('cesarneri803@gmail.com', 'Administrador'); // Correo del administrador
            $mail->isHTML(true);
            $mail->Subject = 'Nueva cita agendada';
            
            // Generar el enlace de inicio de sesión para el administrador
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

