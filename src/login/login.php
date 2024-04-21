<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin23' && $password === 'admin') {
        $_SESSION['admin_authenticated'] = true;
        header("Location: ../admin/dashboard-admin.php");
        exit();
    } else {
        require_once "../MYSQL/conexion.php";

        $sql_empleado = "SELECT * FROM empleados WHERE username = '$username' AND password = '$password'";
        $result_empleado = mysqli_query($conn, $sql_empleado);

        if (mysqli_num_rows($result_empleado) == 1) {
            $empleado = mysqli_fetch_assoc($result_empleado);
            $_SESSION['id_empleado'] = $empleado['id_empleado'];

            header("Location: ../employed/dashboard-emp.php");
            exit();
        }

        $sql_usuario = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
        $result_usuario = mysqli_query($conn, $sql_usuario);

        if (mysqli_num_rows($result_usuario) == 1) {
            $usuario = mysqli_fetch_assoc($result_usuario);
            $_SESSION['username'] = $usuario['username'];
            $_SESSION['id_usuario'] = $usuario['id_usuario'];

            header("Location: ../users/index.php");
            exit();
        }

        $error = "Nombre de usuario o contraseña incorrectos";
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/sign.css">
    <title>Iniciar Sesión</title>
</head>
<body>
    <div class="login-box">
        <p>Login</p>
        <?php if (isset($error)) : ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="post">
            <div class="user-box">
                <input required="" name="username" type="text">
                <label>Username</label>
            </div>
            <div class="user-box">
                <input required="" name="password" type="password">
                <label>Password</label>
            </div>
            <button type="submit">Submit</button>
        </form>
        <p>Don't have an account? <a href="./sign.php" class="a2">Sign up!</a></p>
    </div>
</body>
</html>
