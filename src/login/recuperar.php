<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../vendor/autoload.php';

// Verifica si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener la dirección de correo electrónico del formulario
    $email = $_POST['email'];

    // Realizar la conexión a la base de datos (usando la conexión existente)
    $conn = new mysqli("localhost", "root", "", "mantenimiento");

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Configurar codificación UTF-8 para la conexión
    $conn->set_charset('utf8');

    // Consultar la contraseña del usuario basada en el correo electrónico
    $sql = "SELECT password FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        // Obtener la contraseña del resultado de la consulta
        $row = $result->fetch_assoc();
        $userPassword = $row['password'];

        // Configura PHPMailer para enviar correo a través de Gmail
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'cesarneri803@gmail.com'; // Tu dirección de correo de Gmail
            $mail->Password = 'kyoi thod ximj mipk'; // Tu contraseña de Gmail
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Configurar remitente y destinatario
            $mail->setFrom('cesarneri803@gmail.com', 'Mantenimiento y Reparaciones ');
            $mail->addAddress($email);

            // Contenido del correo con la contraseña del usuario
            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de Contraseña';
            $mail->Body = 'Hola, has solicitado recuperar tu contraseña. Tu contraseña es: ' . $userPassword . '. <a href="https://tuweb.com/reset-password.php?email=' . urlencode($email) . '">';

            // Enviar correo
            $mail->send();

            echo 'Se ha enviado un correo electrónico con instrucciones para restablecer tu contraseña.';
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    } else {
        echo "No se encontró ningún usuario con ese correo electrónico.";
    }

    // Cerrar conexión a la base de datos
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button>
        <a href="login.php">Regresar</a>
    </button>
</body>
</html>
<style>
    button {
            background-color: #007bff;
            color: white;
            text-align: center;
            text-decoration: none;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
</style>