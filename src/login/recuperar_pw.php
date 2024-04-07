<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/sign.css">
    <title>Recuperar contraseña</title>
</head>
<body>
    <div class="login-box">
        <p>Recuperar contraseña</p>
        <form method="post" action="recuperar.php" onsubmit="return confirmSubmit()">
            <div class="user-box">
                <input id="email" name="email" type="email">
                <label>Correo Electrónico</label>
            </div>
            <button type="submit" onclick="showConfirmation()">Recuperar</button>
        </form>
    </div>

    <!-- Script JavaScript para mostrar la alerta -->
    <script>
        function showConfirmation() {
            // Mostrar una alerta con el mensaje deseado
            alert("Se enviará un correo electrónico con instrucciones para restablecer tu contraseña.");
        }

        function confirmSubmit() {
            // Solicitar confirmación al usuario antes de enviar el formulario
            return confirm("¿Estás seguro de que deseas recuperar la contraseña?");
        }
    </script>
</body>
</html>

