<?php
// Iniciar sesión (si no lo has hecho aún)
session_start();

// Verificar si el nombre de usuario/empleado está almacenado en la variable de sesión
if (isset($_SESSION['username'])) {
    // Obtener el nombre de usuario de la sesión
    $username = $_SESSION['username'];
    // Incluir el archivo de conexión a la base de datos
    require_once "../../MYSQL/conexion.php";

    // Consulta SQL para obtener los datos del usuario
    $sql = "SELECT * FROM usuarios WHERE username='$username'";
    $resultado = mysqli_query($conn, $sql);

    // Verificar si se obtuvieron resultados
    if ($resultado && mysqli_num_rows($resultado) > 0) {
        // Obtener los datos del usuario de la fila resultante
        $fila = mysqli_fetch_assoc($resultado);
        $id_usuario = $fila['id_usuario']; // Asegúrate de que este sea el nombre correcto del campo en tu tabla
        $username = $fila['username'];
        $password=$fila['password'];
        $nombre = $fila['nombre'];
        $apellidoP = $fila['apellido_pat'];
        $apellidoM = $fila['apellido_mat'];
        $email = $fila['email'];
        $telefono = $fila['telefono'];

        // Incluir el encabezado
        require_once "./superior_usr.php";
    } else {
        echo "No se encontraron datos del usuario.";
    }

    // Liberar el resultado y cerrar la conexión
    mysqli_free_result($resultado);
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../bootstrap-5.3.3-dist/css/bootstrap.css">
   
   <script src="../../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <title>Editar Usuario</title>
</head>

<body>
<div class="container mt-4">
    <h1 class="text-center mb-4">Modificar Datos</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="actualizar_usuario.php" method="post">
                <!-- Input oculto para enviar el id_usuario -->
                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $password ?>">
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="apellidoP" class="form-label">Apellido Paterno</label>
                    <input type="text" class="form-control" id="apellidoP" name="apellidoP" value="<?php echo $apellidoP; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="apellidoM" class="form-label">Apellido Materno</label>
                    <input type="text" class="form-control" id="apellidoM" name="apellidoM" value="<?php echo $apellidoM; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono; ?>" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>

</html>
<?php
 }else {
    // Si el usuario no ha iniciado sesión, redirigirlo a la página de inicio de sesión
    header("Location: ./../login/sign.php");
    exit();
}
?>
