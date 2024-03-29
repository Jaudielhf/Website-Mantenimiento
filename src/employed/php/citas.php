<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../../../bootstrap-5.3.3-dist/css/bootstrap.css">
    <script src="./../../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <title>Citas</title>
</head>

<body>
    <?php
    require_once "./superior.php";
    // Establecer conexión con la base de datos
    require_once "../../MYSQL/conexion.php";

    $sql = "SELECT 
    c.id_cita, 
    c.id_servicio, 
    s.nombre AS nombre_servicio, 
    s.precio AS precio_servicio,
    c.id_usuario, 
    u.nombre AS nombre_usuario, 
    u.apellido_pat AS apellido_paterno, 
    u.apellido_mat AS apellido_materno, 
    u.email AS email_usuario, 
    u.telefono AS telefono_usuario,
    c.id_empleado, 
    e.nombre AS nombre_empleado, 
    c.subtotal, 
    c.total, 
    LEFT(c.descripcion, 256) AS descripcion_cita
FROM 
    mantenimiento.citas AS c
JOIN 
    mantenimiento.servicios AS s ON c.id_servicio = s.id_servicio
JOIN 
    mantenimiento.usuarios AS u ON c.id_usuario = u.id_usuario
JOIN 
    mantenimiento.empleados AS e ON c.id_empleado = e.id_empleado
ORDER BY 
    c.descripcion DESC 
LIMIT 1000;
";
    $resultado = mysqli_query($conn, $sql);
    ?>
    <div class="container mt-4">
        <h1>VENTANA DE ADMINISTRACION DE CITAS</h1>
        <div class="row mt-5">
            <div class="col-sm-6 col-md-8">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>

                            <th scope="col">Folio</th>
                            <!-- informacion del usuario-->
                            <th scope="col">Nombre</th>
                            <th scope="col">apellidos</th>
                            <th scope="col">Correo Electronico</th>
                            <th scope="col">Telefono</th>
                            <!-- informacion del empleado-->
                            <th scope="col">Empleado</th>
                            <!--informacion del Servicio-->
                            <th scope="col">Servicio</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Total</th>
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
                                echo "<th scope='row'>" . $idCita=$fila['id_cita'] . "</th>";
                                echo "<td>" . $nombre_usuario=$fila['nombre_usuario'] . "</td>";
                                echo "<td>" . $apellidos =$fila['apellido_paterno']. " " . $fila['apellido_materno'] . "</td>";
                                echo "<td>" . $correo=$fila['email_usuario'] . "</td>";
                                echo "<td>" . $telefono= $fila['email_usuario'] . "</td>";
                                echo "<td>" . $nombre_empleado= $fila['nombre_empleado'] . "</td>";
                                echo "<td>" . $nombre_servicio= $fila['nombre_servicio'] . "</td>";
                                echo "<td>" . $precio= $fila['precio_servicio'] . "</td>";
                                echo "<td>" . $descripcion= $fila['descripcion_cita'] . "</td>";
                                echo "<td>" . $total= $fila['total'] . "</td>";
                                echo "<td>";
                                echo "<button class='btn btn-danger eliminar mb-2' data-id='" . $idCita=$fila['id_cita'] . "'>Eliminar</button>";
                                echo "<button>Actualizar</button>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>No se encontraron resultados.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

</body>

</html>