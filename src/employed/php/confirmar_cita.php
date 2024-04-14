<?php
// Establecer conexión con la base de datos
require_once "../../MYSQL/conexion.php";

require_once __DIR__ . '/../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Verifica si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirmar_cita'])) {
    $id_cita = $_POST['id_cita'];

    // Realiza la consulta para obtener los detalles de la cita
    $sql = "SELECT 
                c.id_cita,
                c.horario AS hora,
                c.fecha AS fechas, 
                c.id_servicio, 
                s.nombre AS nombre_servicio, 
                s.precio AS precio_servicio,
                c.id_usuario, 
                u.nombre AS nombre_usuario, 
                u.apellido_pat AS apellido_paterno, 
                u.apellido_mat AS apellido_materno, 
                u.email AS email, 
                u.telefono AS telefono_usuario,
                c.id_empleado, 
                e.nombre AS nombre_empleado, 
                LEFT(c.descripcion, 256) AS descripcion_cita
            FROM 
                mantenimiento.citas AS c
            JOIN 
                mantenimiento.servicios AS s ON c.id_servicio = s.id_servicio
            JOIN 
                mantenimiento.usuarios AS u ON c.id_usuario = u.id_usuario
            JOIN 
                mantenimiento.empleados AS e ON c.id_empleado = e.id_empleado
            WHERE 
                c.id_cita = $id_cita";

    $resultado = mysqli_query($conn, $sql);

    if ($resultado && mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);

        // Detalles de la cita
        $nombre_usuario = $fila['nombre_usuario'];
        $email_usuario = $fila['email'];
        $fecha_cita = $fila['fechas'];
        $hora_cita = $fila['hora'];
        $nombre_servicio = $fila['nombre_servicio'];
        $descripcion_cita = $fila['descripcion_cita'];

        // Configura PHPMailer para enviar el correo de confirmación
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP (usando Gmail como ejemplo)
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'cesarneri803@gmail.com'; // Tu dirección de correo de Gmail
            $mail->Password = 'kyoi thod ximj mipk'; // Tu contraseña de Gmail
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Configurar remitente y destinatario
            $mail->setFrom('mantenimientoyreparaciones123@gmail.com', 'Mantenimiento y Reparaciones');
            $mail->addAddress($email_usuario, $nombre_usuario);

            // Contenido del correo de confirmación
            $mail->isHTML(true);
            $mail->Subject = 'Confirmación de cita';
            $mail->Body = "Estimado $nombre_usuario,<br><br>Su cita para el servicio '$nombre_servicio' ha sido confirmada.<br>Fecha: $fecha_cita<br>Hora: $hora_cita<br>Descripción: $descripcion_cita<br><br>Gracias por confiar en nosotros.";

            // Enviar correo
            $mail->send();

            echo "Correo de confirmación enviado a $email_usuario";
        } catch (Exception $e) {
            echo "Error al enviar el correo de confirmación: {$mail->ErrorInfo}";
        }
    } else {
        echo "No se encontró la cita.";
    }
} else {
    echo "Acceso no autorizado.";
}
?>
