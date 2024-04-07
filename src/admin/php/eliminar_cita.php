<?php
require_once "../../MYSQL/conexion.php";
require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['eliminar_cita'])) {
    $id_cita = $_POST['id_cita'];

    // Consultar la información de la cita antes de eliminarla
    $consulta_cita = "SELECT u.email AS email_usuario
                      FROM mantenimiento.citas AS c
                      JOIN mantenimiento.usuarios AS u ON c.id_usuario = u.id_usuario
                      WHERE c.id_cita = $id_cita";

    $resultado = mysqli_query($conn, $consulta_cita);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $email_usuario = $fila['email_usuario'];

        // Eliminar la cita
        $eliminar_cita = "DELETE FROM mantenimiento.citas WHERE id_cita = $id_cita";
        $resultado_eliminacion = mysqli_query($conn, $eliminar_cita);

        if ($resultado_eliminacion) {
            // Enviar correo electrónico al usuario notificando la eliminación
            $mail = new PHPMailer(true);
            try {
                // Configurar el servidor SMTP y enviar el correo
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'cesarneri803@gmail.com';
                $mail->Password = 'kyoi thod ximj mipk';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                // Configurar el mensaje de correo
                $mail->setFrom('cesarneri803@gmail.com', 'Mantenimiento y Reparaciones');
                $mail->addAddress($email_usuario);
                $mail->Subject = 'Cita cancelada';
                $mail->Body = 'Tu cita ha sido cancelada por el administrador, puedes agendar otra en cualquier momento';

                $mail->send();
                echo 'Correo enviado correctamente';
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
