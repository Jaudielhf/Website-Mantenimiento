<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../../../bootstrap-5.3.3-dist/css/bootstrap.css">
    <script src="./../../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <title>Document</title>
</head>

<body>
    <?php
    require_once "../../MYSQL/conexion.php";
    require_once('./superior.php');
    if (isset($_GET['id'])) {
        $id_empleado = $_GET['id'];
        $consulta = "SELECT * FROM empleados WHERE id_empleado='$id_empleado'";
        $resultado = mysqli_query($conn, $consulta);
    }
    ?>
    <div class="container text-center">
        <?php
        if (mysqli_num_rows($resultado) > 0) {
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $id_empleado = $fila['id_empleado'];
                $nombre = $fila['nombre'];
                $apellido_pat = $fila['apellido_pat'];
                $apellido_mat = $fila['apellido_mat'];

        ?>
        <?php
                echo "<h1>Asignar horarios de trabajo a: " . $fila['nombre'] . " " . $fila['apellido_pat'] . " " . $fila['apellido_mat'] . "</h1>";
            }
        } else {
            $error;
        }
        ?>
        <div class="row">
            <div class="col">
                <div class="container">

                    <form action="" method="post">

                        <div class="row g-3 mt-2">
                        <div class="col-12">
                            <input type="text" name="id_empleado" hidden value="<?php echo"$id_empleado" ?>">
                        </div>
                            <div class="col-6">
                                <label for="">HORARIO ENTRADA</label>
                                <input type="time" class="form-control" placeholder="Hora Entrada" name="Entrada" step="1">
                            </div>
                            <div class="col-6">
                                <label for="">HORARIO SALIDA</label>
                                <input type="time" class="form-control" placeholder="Hora Salida" name="Salida" step="1">
                            </div>
                        </div>
                        <div class="row g-3 mt-2">
                            <div class="col-6">
                                <label for="">FECHA INICIO</label>
                                <input type="date" class="form-control" name="fecha_in">
                            </div>
                            <div class="col-6">
                                <label for="">FECHA FIN</label>
                                <input type="date" class="form-control" name="fecha_out">
                            </div>
                        </div>
                        <div class="row g-3 mt-3">
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Agregar</button>

                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $hora_in=$_POST['Entrada'];
        $hora_out=$_POST['Salida'];
        $fecha_in=$_POST['fecha_in'];
        $fecha_out=$_POST['fecha_out'];
        $id_empleado=$_POST['id_empleado'];

        //$consulta = "INSERT INTO admin_empleados (fecha_inicio, fecha_fin, hora_inicio, hora_fin, id_empleado) VALUES ('$fecha_in', '$fecha_out', '$hora_in', '$hora_out', '$id_empleado')";
        $consulta="UPDATE admin_empleados SET fecha_inicio='$fecha_in', fecha_fin='$fecha_out', hora_inicio='$hora_in', hora_fin='$hora_out' WHERE id_empleado = '$id_empleado'";
        $resultado = mysqli_query($conn, $consulta);
        if ($resultado) {
            echo "<script>alert('Horario agregado correctamente');</script>";
            echo "<script>window.location.href='./admin-empleados.php';</script>";
        } else {
            echo "<script>alert('Error al agregar horario');</script>";
        }

}

    ?>
</body>

</html>