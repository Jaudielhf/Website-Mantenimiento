<?php
            //insertar datos a la tabla cita
    require_once "../../MYSQL/conexion.php";          


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_usuario = $_POST['id_user'];
        $id_servicio = $_POST['servicio'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $id_empleado=$_POST['empleado'];
        $descripcion = $_POST['descripcion'];

        $sql = "INSERT INTO citas (id_usuario, id_servicio, fecha, horario, id_empleado, descripcion) VALUES ('$id_usuario', '$id_servicio', '$fecha', '$hora', '$id_empleado', '$descripcion')";
        $resultado = mysqli_query($conn, $sql);
        if($resultado){
            echo "<script>alert('Cita agregada correctamente');</script>";
            echo "<script>window.location.href='./ver_citas.php';</script>";
        }else{
            echo "<script>alert('Error al agregar cita');</script>";
        }
    }
?>