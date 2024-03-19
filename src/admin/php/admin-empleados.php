<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bootstrap-5.3.3-dist/css/bootstrap.css">
    <script src="/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
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
            <div class="col-sm-6 col-md-8">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido Paterno</th>
                            <th scope="col">Apellido Materno</th>
                            <th scope="col">Correo Electronico</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
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
                                    echo "<td>";
                                    echo "<button>Eliminar</button>";
                                    echo "<button>Actualizar</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>No se encontraron resultados.</td></tr>";
                            }
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-6 col-md-4">
                <form action="">
                    <form class="row g-3">
                        <div class="row g-3 mb-2">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Nombre" aria-label="First name">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Apellido Paterno" aria-label="Last name">
                            </div>
                        </div>
                        <div class="row g-3 ">
                        <div class="col-md-6 mt-4">
                            <input type="text" class="form-control" id="inputPassword4" placeholder="Apellido Materno" aria-label="Last name">
                        </div>
                        </div>
                        <div class="col-12 mt-4">
                            <input type="email" class="form-control" id="inputAddress" placeholder="Correo Electronico">
                        </div>
                        <div class="col-12 mt-4">
                            <input type="text" class="form-control" id="inputAddress2" placeholder="Nombre de Usuario">
                        </div>
                        <div class="col-md-6 mt-4">
                            <input type="password" class="form-control" id="inputCity" placeholder="contraseña">
                        </div>
                        <div class="col-md-4 mt-4">
                        <input type="text" class="form-control" id="inputCity" placeholder="Telefono">
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </form>

                </form>
            </div>
        </div>
    </div>
</body>

</html>