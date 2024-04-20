<?php
require_once "./superior.php";
require_once "../../MYSQL/conexion.php";


    $sql = "SELECT 
        c.id_cita,
        c.horario AS hora,
        c.fecha AS fechas,  
        c.id_servicio, 
        s.nombre AS nombre_servicio, 
        s.precio AS precio_servicio,
        s.anticipo as anticipo_servicio,
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

    ORDER BY 
        c.descripcion DESC 
    LIMIT 1000";

    // Ejecutar consulta SQL
    $resultado = mysqli_query($conn, $sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <link rel="stylesheet" href="./../../../bootstrap-5.3.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> 
    <script src="./../../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
</head>

<body>
    <div class="container mt-4">
        <h1>VENTANA DE ADMINISTRACIÓN DE CITAS</h1>
        <div class="row">
            <div class="col-md-6">
                <nav class=" bg-body-tertiary">
                    <div class="container-fluid">
                        <form class="d-flex" method="post" action="citas.php">
                            <input class="form-control me-2" type="search" placeholder="Buscar por ID de Cita o Fecha" aria-label="Search" name="buscar">
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
                        if ($resultado && mysqli_num_rows($resultado) > 0) {
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                echo "<tr>";
                                echo "<td>" . $fila['id_cita'] . "</td>";
                                echo "<td>" . $fila['nombre_usuario'] . "</td>";
                                echo "<td>" . $fila['apellido_paterno'] . " " . $fila['apellido_materno'] . "</td>";
                                echo "<td>" . $fila['email_usuario'] . "</td>";
                                echo "<td>" . $fila['telefono_usuario'] . "</td>";
                                echo "<td>" . $fila['nombre_empleado'] . "</td>";
                                echo "<td>" . $fila['nombre_servicio'] . "</td>";
                                echo "<td>$" . $fila['precio_servicio'] . "</td>";
                                echo "<td>$ " . $fila['anticipo_servicio'] . "</td>";
                                echo "<td>" . $fila['descripcion_cita'] . "</td>";
                                echo "<td>" . $fila['fechas'] . "</td>";
                                echo "<td>" . $fila['hora'] . "</td>";
                                echo "<td>";
                                echo "<form method='post' action='confirmar_cita.php'>";
                                echo "<input type='hidden' name='id_cita' value='" . $fila['id_cita'] . "'>";
                                echo "<button type='submit' id='Confirmar' name='confirmar_cita' class='btn btn-success'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>
                                <path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5z'/>
                                <path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0'/>
                                </svg>
                                </button>";
                                echo "</form>";
                                echo "<form method='post' action='eliminar_cita.php'>";
                                echo "<input type='hidden' name='id_cita' value='" . $fila['id_cita'] . "'>";
                                echo "<button type='submit' name='eliminar_cita' class='btn btn-danger eliminar mb-2' onclick='return confirm(\"¿Estás seguro de eliminar esta cita?\");'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3' viewBox='0 0 16 16'>
                                <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5'/>
                                </svg>
                                </button>";
                                echo "</form>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='12'>No se encontraron resultados.</td></tr>";
                        }
                        ?>
                        <script>
                            document.getElementById("Confirmar").addEventListener().click(function(){
                                
                            });
                        </script>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
    require_once "./inferior.php";
    ?>
</body>

</html>
