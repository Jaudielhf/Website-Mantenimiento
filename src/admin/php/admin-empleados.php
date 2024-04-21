<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <link rel="stylesheet" href="./../../../bootstrap-5.3.3-dist/css/bootstrap.css">
    <script src="./../../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
</head>

<body>
    <?php
    require_once "./superior.php";
    require_once "../../MYSQL/conexion.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar_empleado'])) {
        $id_empleado = $_POST['id_empleado'];
        $sql_delete = "DELETE FROM empleados WHERE id_empleado = '$id_empleado'";
        if (mysqli_query($conn, $sql_delete)) {
            echo "<script>alert('Empleado eliminado correctamente');</script>";
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        } else {
            echo "<script>alert('Error al eliminar empleado');</script>";
        }
    }

    $sql = "SELECT e.*, a.fecha_inicio, a.fecha_fin, a.hora_inicio, a.hora_fin 
            FROM empleados e 
            LEFT JOIN admin_empleados a ON e.id_empleado = a.id_empleado";
    $resultado = mysqli_query($conn, $sql);
    ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <div class="container mt-4">
        <h1 class="mb-4">VENTANA DE ADMINISTRACION DE EMPLEADOS</h1>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellido Paterno</th>
                                <th scope="col">Apellido Materno</th>
                                <th scope="col">Correo Electrónico</th>
                                <th scope="col">Teléfono</th>
                                <th scope="col">Fecha Inicio</th>
                                <th scope="col">Fecha Fin</th>
                                <th scope="col">Hora Inicio</th>
                                <th scope="col">Hora Fin</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($resultado) > 0) {
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    echo "<tr>";
                                    echo "<td>" . $fila['id_empleado'] . "</td>";
                                    echo "<td>" . $fila['nombre'] . "</td>";
                                    echo "<td>" . $fila['apellido_pat'] . "</td>";
                                    echo "<td>" . $fila['apellido_mat'] . "</td>";
                                    echo "<td>" . $fila['email'] . "</td>";
                                    echo "<td>" . $fila['telefono'] . "</td>";
                                    echo "<td>" . $fila['fecha_inicio'] . "</td>";
                                    echo "<td>" . $fila['fecha_fin'] . "</td>";
                                    echo "<td>" . $fila['hora_inicio'] . "</td>";
                                    echo "<td>" . $fila['hora_fin'] . "</td>";
                                    echo "<td>";
                                    echo "<form method='post' action='eliminar_empleado.php'>";
                                    echo "<input type='hidden' name='id_empleado' value='" . $fila['id_empleado'] . "'>";
                                    echo "<button type='submit' name='eliminar_empleado' class='btn btn-danger eliminar mb-2' onclick='return confirm(\"¿Estás seguro de eliminar este empleado?\");'>";
                                    echo "<i class='fas fa-trash'></i>";
                                    echo "</button>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<form method='get' action='actualizar_empleados.php'>";
                                    echo "<input type='hidden' name='id_empleado' value='" . $fila['id_empleado'] . "'>";
                                    echo "<button type='submit' name='actualizar-empleado' class='btn btn-info actualizar mb-2' onclick='return confirm(\"¿Estás seguro de actualizar este empleado?\");'>";
                                    echo "<i class='fas fa-edit'></i>";
                                    echo "</button>";
                                    echo "</form>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
    <h1 class="mb-4">Agregar Nuevo Empleado</h1>
    <div class="row">
        <div class="col">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="apellido_pat" class="form-label">Apellido Paterno</label>
                    <input type="text" class="form-control" id="apellido_pat" name="apellido_pat" required>
                </div>
                <div class="mb-3">
                    <label for="apellido_mat" class="form-label">Apellido Materno</label>
                    <input type="text" class="form-control" id="apellido_mat" name="apellido_mat">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Nombre de Usuario</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="pass" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="pass" name="pass" required>
                </div>
                <div class="mb-3">
                    <label for="tel" class="form-label">Teléfono</label>
                    <input type="tel" class="form-control" id="tel" name="tel">
                </div>
                <div class="mb-3">
                    <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                    <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_fin" class="form-label">Fecha Fin</label>
                    <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                </div>
                <div class="mb-3">
                    <label for="hora_inicio" class="form-label">Hora Inicio</label>
                    <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required>
                </div>
                <div class="mb-3">
                    <label for="hora_fin" class="form-label">Hora Fin</label>
                    <input type="time" class="form-control" id="hora_fin" name="hora_fin">
                </div>
                <button type="submit" name="agregar_empleado" class="btn btn-primary">Agregar Empleado</button>
            </form>
        </div>
    </div>
</div>

</body>

</html>
<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $apellidoP = $_POST['apellido_pat'];
        $apellidoM = $_POST['apellido_mat'];
        $Username = $_POST['username'];
        $correo = $_POST['email'];
        $contraseña = $_POST['pass'];
        $telefono = $_POST['tel'];
        $fechaInicio = $_POST['fecha_inicio'];
        $fechaFin = $_POST['fecha_fin'];
        $horaInicio = $_POST['hora_inicio'];
        $horaFin = $_POST['hora_fin'];

        $sql = "INSERT INTO empleados (nombre, apellido_pat, apellido_mat, email, username, password, telefono) VALUES ('$nombre', '$apellidoP', '$apellidoM', '$correo', '$Username', '$contraseña', '$telefono')";

        $resultado = mysqli_query($conn, $sql);

        if ($resultado) {

            $idEmpleado = mysqli_insert_id($conn);

            $sqlHorarios = "INSERT INTO admin_empleados (fecha_inicio, fecha_fin, hora_inicio, hora_fin, id_empleado) 
                            VALUES ('$fechaInicio', '$fechaFin', '$horaInicio', '$horaFin', '$idEmpleado')";

            $resultadoHorarios = mysqli_query($conn, $sqlHorarios);

            if ($resultadoHorarios) {
                echo "<script>alert('Empleado registrado correctamente con horarios');</script>";
                echo "<script>window.location.href='./admin-empleados.php';</script>";
            } else {
                echo "<p>Error al registrar horarios del empleado</p>";
            }
        } else {
            echo "<p>Error al registrar empleado</p>";
        }

        mysqli_close($conn);
    }
?>


<style>
    body {
        background-color: #f8f9fa;
    }

    h1,
    h2 {
        color: #007bff;
    }

    .btn-danger,
    .btn-warning {
        font-weight: bold;
    }
</style>


