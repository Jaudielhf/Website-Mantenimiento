<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../../../bootstrap-5.3.3-dist/css/bootstrap.css">
    <script src="./../../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <script src="../js/script.js"></script>
    <title>Empleados</title>
</head>

<body>
    <?php
    require_once "./superior.php";
    // Establecer conexión con la base de datos
    require_once "../../MYSQL/conexion.php";

    // Consulta SQL para obtener los datos de la tabla
    $sql = "SELECT * FROM empleados";
    $resultado = mysqli_query($conn, $sql);

    ?>
    <div class="container mt-4">
        <h1>VENTANA DE ADMINISTRACION DE EMPLEADOS</h1>
        <div class="row mt-5">
            <div class="col-sm-4 col-md-10">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido Paterno</th>
                            <th scope="col">Apellido Materno</th>
                            <th scope="col">Correo Electronico</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Horario</th>
                            <th scope="col">Dias laborables</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Verificar si la consulta devuelve algún resultado
                        if (mysqli_num_rows($resultado) > 0) {
                            // Iterar sobre cada fila de resultados
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                echo "<tr>";
                                echo "<th scope='row'>" . $fila['id_empleado'] . "</th>";
                                echo "<td>" . $fila['nombre'] . "</td>";
                                echo "<td>" . $fila['apellido_pat'] . "</td>";
                                echo "<td>" . $fila['apellido_mat'] . "</td>";
                                echo "<td>" . $fila['email'] . "</td>";
                                echo "<td>" . $fila['telefono'] . "</td>";
                                $consulta = "SELECT * FROM admin_empleados WHERE id_empleado=" . $fila['id_empleado'] . ";";
                                $result = mysqli_query($conn, $consulta);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo "<td>" . $row['hora_inicio'] . "--" . $row['hora_fin'] . "</td>";
                                        echo "<td>" . $row['fecha_inicio'] . "--" . $row['fecha_fin'] . "</td>";
                                    }
                                }

                                echo "<td>";
                                echo "<button class='btn btn-danger eliminar mb-2' data-id='" . $fila['id_empleado'] . "'>Eliminar</button>";
                                echo "<button class='btn btn-warning mb-2'>Actualizar</button>";
                                echo "</td>";
                                echo "<td>
                                <a href='./asignar_datetime.php?id=" . $fila['id_empleado'] . "' class='btn btn-success'  >Horario</a>
                                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No se encontraron resultados.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="col-9 col-md-2 ">
                <p>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                        Agregar Empleado
                    </button>
                </p>
                <div style="min-height: 120px;">
                    <div class="collapse collapse-horizontal" id="collapseWidthExample">
                        <div class="card card-body" style="width: 300px;">
                        <form action="" method="post">
                    <div class="row g-3">

                        <div class="col ">
                            <input type="text" class="form-control" placeholder="Nombre" aria-label="First name" name="nombre">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Apellido Paterno" aria-label="Last name" name="apellido_pat">
                        </div>
                    </div>
                    <div class="row g-3 mt-2">
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Apellido Materno" aria-label="Last name" name="apellido_mat">
                        </div>
                    </div>
                    <div class="row g-3 mt-2">
                        <div class="col">
                            <input type="email" class="form-control" placeholder="Correo Electronico" name="email">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Nombre de Usuario" name="username">
                        </div>
                    </div>
                    <div class="row g-3 mt-2">
                        <div class="col">
                            <input type="password" class="form-control" placeholder="Contraseña" name="pass">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" placeholder="Telefono" name="tel">
                        </div>
                    </div>

                    <div class="row g-3 mt-3">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Agregar</button>

                        </div>
                    </div>
                </form>

                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $apellidoP = $_POST['apellido_pat'];
        $apellidoM = $_POST['apellido_mat'];
        $Username = $_POST['username'];
        $correo = $_POST['email'];
        $contraseña = $_POST['pass'];
        $telefono = $_POST['tel'];

        $sql = "INSERT INTO empleados (nombre, apellido_pat, apellido_mat, email, username, password, telefono) VALUES ('$nombre', '$apellidoP', '$apellidoM', '$correo', '$Username', '$contraseña', '$telefono')";

        $resultado = mysqli_query($conn, $sql);
        if ($resultado) {
            echo "<script>alert('Empleado registrado correctamente');</script>";
            echo "<script>window.location.href='./admin-empleados.php';</script>";
        } else {
            echo "<p>Error al registrar usuario</p>";
        }
        $conn->close();
    }
    ?>
</body>

</html>