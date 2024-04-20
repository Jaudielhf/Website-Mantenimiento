<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../../../bootstrap-5.3.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="./../../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>

    <title>Servicios | ADMINISTRACION</title>
</head>

<body>
    <?php
    require_once "./superior.php";
    // Establecer conexión con la base de datos
    require_once "../../MYSQL/conexion.php";

    // Consulta SQL para obtener los datos de la tabla
    $sql = "SELECT * FROM Estaciones";
    $resultado = mysqli_query($conn, $sql);

    ?>
    <div class="container mt-4">
        <h1>VENTANA DE ADMINISTRACIÓN DE ESTACIONES</h1>
        <div class="row mt-5">
            <div class="col-sm-4 col-md-10">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col" colspan="2">Acciones</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Verificar si la consulta devuelve algún resultado
                        if (mysqli_num_rows($resultado) > 0) {
                            // Iterar sobre cada fila de resultados
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                echo "<tr>";
                                echo "<td>" . $fila['id_estaciones'] . "</td>";
                                echo "<td>" . $fila['nombre'] . "</td>";
                                echo "<td>";
                                echo "<button class='btn btn-danger eliminar mb-2' data-id='" . $fila['id_estaciones'] . "'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3' viewBox='0 0 16 16'>
                                <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5'/>
                                </svg>
                                </button>";
                                echo "<form action='actualizar_estaciones.php' method='post'>";
                                echo "<input type='hidden' name='id_estaciones' value='" . $fila['id_estaciones'] . "'>";
                                echo "<td>";
                                echo "<button type='submit' class='btn btn-warning' name='actualizar'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-square' viewBox='0 0 16 16'>
                                <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
                                <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
                                </svg>
                                </button>";
                                echo "</td>";
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
            <script>
                // Script para manejar el evento clic en el botón Eliminar
                document.addEventListener('DOMContentLoaded', function() {
                    // Seleccionar todos los botones de clase 'eliminar'
                    var botonesEliminar = document.querySelectorAll('.eliminar');

                    // Agregar un evento clic a cada botón Eliminar
                    botonesEliminar.forEach(function(boton) {
                        boton.addEventListener('click', function() {
                            // Obtener el ID del registro a eliminar desde el atributo data-id del botón
                            var id = this.getAttribute('data-id');

                            // Confirmar si el usuario realmente quiere eliminar el registro
                            if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
                                // Si confirma, enviar una solicitud al servidor para eliminar el registro
                                eliminarRegistro(id);
                            }
                        });
                    });

                    // Función para enviar una solicitud al servidor para eliminar el registro
                    function eliminarRegistro(id_estaciones) {
                        // Enviar una solicitud AJAX al servidor para eliminar el registro
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', './del_estaciones.php', true);
                        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                        xhr.onload = function() {
                            // Manejar la respuesta del servidor
                            if (xhr.status == 200) {
                                // Recargar la página después de eliminar el registro
                                location.reload();
                            } else {
                                // Mostrar un mensaje de error si hay un problema al eliminar el registro
                                alert('Error al eliminar el registro.');
                            }
                        };
                        // Enviar el ID del registro como datos de formulario
                        xhr.send('id_estaciones=' + id_estaciones);
                    }


                });
            </script>
            <div class="col-9 col-md-2 ">
                <p>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                        Agregar Estaciones
                    </button>
                </p>
                <div style="min-height: 120px;">
                    <div class="collapse collapse-horizontal" id="collapseWidthExample">
                        <div class=" card-body" style="width: 300px;">
                            <form action="add_estaciones.php" method="post" enctype="multipart/form-data">
                                <div class="row g-3">

                                    <div class="col ">
                                        <input type="text" class="form-control" placeholder="Estacion" aria-label="First name" name="nombre">
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
        require_once("./inferior.php");
        ?>
</body>

</html>