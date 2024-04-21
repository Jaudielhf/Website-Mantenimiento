<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Sig In</title>
</head>
<body>
<?php
require_once "../MYSQL/conexion.php";

function isUsernameTaken($username, $conn) {
    $username = mysqli_real_escape_string($conn, $username);
    $consulta = "SELECT * FROM usuarios WHERE username = '$username'";
    $resultado = mysqli_query($conn, $consulta);
    return ($resultado && mysqli_num_rows($resultado) > 0);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['Nombre'];
    $apellidoP = $_POST['Apellido_Pat'];
    $apellidoM = $_POST['Apellido_Mat'];
    $Username = $_POST['Username'];
    $correo = $_POST['Email'];
    $contraseña = $_POST['Password'];
    $telefono = $_POST['Telefono'];

    $correo = mysqli_real_escape_string($conn, $correo);
    $consultaEmail = "SELECT * FROM usuarios WHERE email = '$correo'";
    $resultadoEmail = mysqli_query($conn, $consultaEmail);

    if (mysqli_num_rows($resultadoEmail) > 0) {
        echo "<script>alert('Este correo electrónico ya está registrado. Por favor, intenta con otro.');</script>";
    } elseif (isUsernameTaken($Username, $conn)) {
        echo "<script>alert('Este nombre de usuario ya está en uso. Por favor, elige otro.');</script>";
    } else {
      
        $nombre = mysqli_real_escape_string($conn, $nombre);
        $apellidoP = mysqli_real_escape_string($conn, $apellidoP);
        $apellidoM = mysqli_real_escape_string($conn, $apellidoM);
        $Username = mysqli_real_escape_string($conn, $Username);
        $contraseña = mysqli_real_escape_string($conn, $contraseña);
        $telefono = mysqli_real_escape_string($conn, $telefono);

        $sql = "INSERT INTO usuarios (nombre, apellido_pat, apellido_mat, email, username, password, telefono) VALUES ('$nombre', '$apellidoP', '$apellidoM', '$correo', '$Username', '$contraseña', '$telefono')";
        $resultado = mysqli_query($conn, $sql);

        if ($resultado) {
            echo "<script>alert('Usuario registrado correctamente');</script>";
            echo "<script>window.location.href='./login.php';</script>";
        } else {
            echo "<script>alert('Error al registrar usuario');</script>";
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Sign In</title>
</head>
<body>

<div class="login-box sign">
    <p>Sign Up</p>
    <form method="post">
        <div class="user-box">
            <input required="" name="Nombre" type="text">
            <label>Nombre</label>
        </div>
        <div class="user-box">
            <input required="" name="Apellido_Pat" type="text">
            <label>Apellido Paterno</label>
        </div>
        <div class="user-box">
            <input required="" name="Apellido_Mat" type="text">
            <label>Apellido Materno</label>
        </div>
        <div class="user-box">
            <input required="" name="Username" type="text">
            <label>Username</label>
        </div>
        <div class="user-box">
            <input required="" name="Email" type="text">
            <label>Email</label>
        </div>
        <div class="user-box">
            <input required="" name="Password" type="password">
            <label>Password</label>
        </div>
        <div class="user-box">
            <input required="" name="Telefono" type="text">
            <label>Teléfono</label>
        </div>
        <button type="submit">Submit</button>
    </form>
    <p>Iniciar sesión <a href="./login.php" class="a2">Login</a></p>
</div>
</body>
</html>