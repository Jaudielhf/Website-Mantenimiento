<?php
require_once "./superior_usr.php";
// Establecer conexión con la base de datos
require_once "../../MYSQL/conexion.php";

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $sql = "SELECT 
        c.id_cita,
        c.horario AS hora,
        c.fecha AS fechas, 
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
        LEFT(c.descripcion, 256) AS descripcion_cita
    FROM 
        mantenimiento.citas AS c
    JOIN 
        mantenimiento.servicios AS s ON c.id_servicio = s.id_servicio
    JOIN 
        mantenimiento.usuarios AS u ON c.id_usuario = u.id_usuario
    JOIN 
        mantenimiento.empleados AS e ON c.id_empleado = e.id_empleado
    WHERE 
        u.username='$username'
    ORDER BY 
        c.descripcion DESC 
    LIMIT 1000";

    $resultado = mysqli_query($conn, $sql);

    if (!$resultado) {
        // Manejar el error de la consulta
        echo "Error en la consulta: " . mysqli_error($conn);
    }
} else {
    echo "<a class='nav-link' href='./../login/sign.php'>Iniciar sesión</a>";
}
?>

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
    <div class="container mt-4">
        <h1>VENTANA DE ADMINISTRACION DE CITAS</h1>
        <div class="row">
            <div class="col-md-6 ">
                <nav class="navbar bg-body-tertiary ">
                    <div class="container-fluid">
                        <form class="d-flex" role="search" method="post" action="busqueda_cita.php">
                            
                            <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" name="id_cita">
                            <button class="btn btn-outline-success" type="submit">Buscar</button>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row mt-5">
        
        
            <div class="col-sm-6 col-md-12">
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
                            <th scope="col">Fecha de la cita</th>

                            <th scope="col">Hora de la cita</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Verificar si la consulta devuelve algún resultado
                        if ($resultado && mysqli_num_rows($resultado) > 0) {
                            // Iterar sobre cada fila de resultados
                            while ($fila = mysqli_fetch_assoc($resultado)) {

                                echo "<tr>";
                                echo "<th scope='row'>" . $idCita = $fila['id_cita'] . "</th>";
                                echo "<td>" . $nombre_usuario = $fila['nombre_usuario'] . "</td>";
                                echo "<td>" . $apellidos = $fila['apellido_paterno'] . " " . $fila['apellido_materno'] . "</td>";
                                echo "<td>" . $correo = $fila['email_usuario'] . "</td>";
                                echo "<td>" . $telefono = $fila['telefono_usuario'] . "</td>"; //Corregido el acceso al campo de teléfono
                                echo "<td>" . $nombre_empleado = $fila['nombre_empleado'] . "</td>";
                                echo "<td>" . $nombre_servicio = $fila['nombre_servicio'] . "</td>";
                                echo "<td>" . $precio = $fila['precio_servicio'] . "</td>";
                                echo "<td>" . $descripcion = $fila['descripcion_cita'] . "</td>";
                                echo "<td>" . $fecha = $fila['fechas'] . "</td>";
                                echo "<td>" . $horario = $fila['hora'] . "</td>";
                                echo "<td>";
                                echo "<form method='post' action='eliminar_cita.php'>";
                                echo "<input type='hidden' name='id_cita' value='" . $fila['id_cita'] . "'>";
                                echo "<button type='submit' name='eliminar_cita' class='btn btn-danger eliminar mb-2' onclick='return confirm(\"¿Estás seguro de eliminar esta cita?\");'>Eliminar</button>";
                                echo "</form>";
                                echo "<form method='post' action='actualizar_cita.php'>";
                                echo "<input type='hidden' name='id_cita' value='" . $fila['id_cita'] . "'>";
                                echo "<button type='submit' name='actualizar_cita' class='btn btn-success'>Actualizar</button>";
                                echo "</form>";
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
           
        </div>
    </div>

</body>

</html>