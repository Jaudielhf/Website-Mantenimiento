<?php
require_once "../../MYSQL/conexion.php";
require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['eliminar_cita'])) {
    $id_cita = $_POST['id_cita'];

    // Consultar la información de la cita antes de eliminarla
    $consulta_cita = "SELECT c.id_usuario, u.email AS email_usuario
                      FROM mantenimiento.citas AS c
                      JOIN mantenimiento.usuarios AS u ON c.id_usuario = u.id_usuario
                      WHERE c.id_cita = $id_cita";

    $resultado = mysqli_query($conn, $consulta_cita);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $id_usuario = $fila['id_usuario'];
        $email_usuario = $fila['email_usuario'];

        // Eliminar la cita
        $eliminar_cita = "DELETE FROM mantenimiento.citas WHERE id_cita = $id_cita";
        $resultado_eliminacion = mysqli_query($conn, $eliminar_cita);

        if ($resultado_eliminacion) {
            // Enviar correo electrónico al administrador notificando la cancelación de la cita
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
                $mail->Subject = 'Cita cancelada por el Usuario';
                $mail->Body = "El usuario ID: $id_usuario ha cancelado su cita.<br><br>
                               Por favor, revise la sección de citas en el sistema para más detalles.";

                $mail->send();
                echo 'Correo enviado correctamente';
                header("Location: ver_citas.php");
            } catch (Exception $e) {
                echo "Error al enviar el correo: {$mail->ErrorInfo}";
            }
        } else {
            echo "Error al eliminar la cita: " . mysqli_error($conn);
        }
    } else {
        echo "No se encontró la información de la cita";
    }
} else {
    echo "Acceso no autorizado";
}
?>
