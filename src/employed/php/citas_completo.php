<?php
require_once "./superior.php";
require_once "../../MYSQL/conexion.php";

if (!isset($_SESSION['id_empleado'])) {
    header("Location: ../../login/login.php");
    exit();
}

$id_empleado = $_SESSION['id_empleado'];

$buscar = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['buscar'])) {
    $buscar = trim($_POST['buscar']);
}

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
        LEFT(c.descripcion, 256) AS descripcion_cita,
        c.anticipo
    FROM 
        mantenimiento.citas AS c
    JOIN 
        mantenimiento.servicios AS s ON c.id_servicio = s.id_servicio
    JOIN 
        mantenimiento.usuarios AS u ON c.id_usuario = u.id_usuario
    JOIN 
        mantenimiento.empleados AS e ON c.id_empleado = e.id_empleado
    WHERE 
        c.id_empleado = $id_empleado";

// Agregar condiciones de búsqueda si se proporciona un término de búsqueda
if (!empty($buscar)) {
    $buscar = mysqli_real_escape_string($conn, $buscar);
    $sql .= " AND (c.id_cita = '$buscar' OR c.fecha = '$buscar')";
}

$sql .= " ORDER BY c.descripcion DESC LIMIT 1000";

// Ejecutar la consulta
$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./../../../bootstrap-5.3.3-dist/css/bootstrap.css">
    <script src="./../../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
</head>

<body>
    <div class="container mt-4">
        <h1>VENTANA DE ADMINISTRACION DE CITAS</h1>
        <div class="row">
            <div class="col-md-6">
                <nav class="navbar bg-body-tertiary">
                    <div class="container-fluid">
                        <form class="d-flex" method="post" action="citas.php">
                            <input class="form-control me-2" type="search" placeholder="Buscar por ID de Cita o Fecha" aria-label="Search" name="buscar" value="<?php echo htmlspecialchars($buscar); ?>">
                            <button class="btn btn-outline-success" type="submit">Buscar</button>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-sm-12">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Folio</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Correo Electrónico</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Empleado</th>
                            <th scope="col">Servicio</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Anticipo</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Fecha de la cita</th>
                            <th scope="col">Hora de la cita</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Mostrar las filas de la tabla con las citas
                        if ($resultado && mysqli_num_rows($resultado) > 0) {
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                // Mostrar cada fila de cita como una fila de la tabla HTML
                                echo "<tr>";
                                // Mostrar los datos de cada cita en las celdas correspondientes
                                echo "<td>" . $fila['id_cita'] . "</td>";
                                echo "<td>" . $fila['nombre_usuario'] . "</td>";
                                echo "<td>" . $fila['apellido_paterno'] . " " . $fila['apellido_materno'] . "</td>";
                                echo "<td>" . $fila['email_usuario'] . "</td>";
                                echo "<td>" . $fila['telefono_usuario'] . "</td>";
                                echo "<td>" . $fila['nombre_empleado'] . "</td>";
                                echo "<td>" . $fila['nombre_servicio'] . "</td>";
                                echo "<td>$" . $fila['precio_servicio'] . "</td>";
                                echo "<td>$" . $fila['anticipo'] . "</td>";
                                echo "<td>" . $fila['descripcion_cita'] . "</td>";
                                echo "<td>" . $fila['fechas'] . "</td>";
                                echo "<td>" . $fila['hora'] . "</td>";
                                echo "<td>";
                                echo "<form method='post' action='confirmar_cita.php'>";
                                echo "<input type='hidden' name='id_cita' value='" . $fila['id_cita'] . "'>";
                                echo "<button type='submit' name='confirmar_cita' class='btn btn-success confirmar-btn' data-cita-id='" . $fila['id_cita'] . "'>";
                                echo "<i class='fas fa-check'></i>";
                                echo "</button>";
                                echo "</form>";

                                echo "<form method='post' action='eliminar_cita.php'>";
                                echo "<input type='hidden' name='id_cita' value='" . $fila['id_cita'] . "'>";
                                echo "<button type='submit' name='eliminar_cita' class='btn btn-danger' onclick='return confirm(\"¿Estás seguro de eliminar esta cita?\");'>";
                                echo "<i class='fas fa-trash-alt'></i>";
                                echo "</button>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='13'>No se encontraron resultados.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const confirmButtons = document.querySelectorAll('.confirmar-btn');

            confirmButtons.forEach(button => {
                const citaId = button.dataset.citaId;
                const confirmado = localStorage.getItem(`confirmado_${citaId}`);

                if (confirmado === 'true') {
                    button.style.display = 'none';
                }

                button.addEventListener('click', function() {
                    localStorage.setItem(`confirmado_${citaId}`, 'true');
                    button.style.display = 'none';
                });
            });
        });
    </script>
</body>

</html>
