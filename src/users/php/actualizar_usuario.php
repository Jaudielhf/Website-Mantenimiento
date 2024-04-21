<?php
require_once "./superior_usr.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $apellidoP = $_POST['apellidoP'];
    $apellidoM = $_POST['apellidoM'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];

    require_once "../../MYSQL/conexion.php";

    $sql = "UPDATE usuarios SET nombre='$nombre', apellido_pat='$apellidoP', apellido_mat='$apellidoM', email='$email', telefono='$telefono' WHERE id_usuario=$id_usuario";

    if (mysqli_query($conn, $sql)) {

        header("Location: ../index.php");
        exit();
    } else {
        echo "Error al actualizar los datos del usuario: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
