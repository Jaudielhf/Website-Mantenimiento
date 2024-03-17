<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Sign Up</title>
</head>
<body>
    <?php
    require_once "../MYSQL/conexion.php";

        // Inicializar variables para almacenar mensajes de error
$error = "";

// Procesar el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta SQL para verificar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
    $resultado = mysqli_query($conn, $sql);

    // Verificar si se encontró un usuario con las credenciales proporcionadas
    if (mysqli_num_rows($resultado) == 1) {
        // Iniciar sesión y redirigir a la página de inicio
        session_start();
        $_SESSION['username'] = $username;
        header("Location: ../users/dashboard-user.php"); // Cambiar 'index.php' por la página a la que quieres redirigir
        exit();
    } else {
        $error = "Nombre de usuario o contraseña incorrectos";
    }
}

// Cerrar la conexión
$conn->close();
?>

  
    <div class="login-box">
        <p>Login</p>
        <form method="post">
          <div class="user-box">
            <input required="" name="username" type="text">
            <label>Username</label>
          </div>
          <div class="user-box">
            <input required="" name="password" type="password">
            <label>Password</label>
          </div>
          <a href="#">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <button type="submit">Submit</button>
          </a>
        </form>
        <p>Don't have an account? <a href="./sign.php" class="a2">Sign up!</a></p>
      </div>

</body>
</html>