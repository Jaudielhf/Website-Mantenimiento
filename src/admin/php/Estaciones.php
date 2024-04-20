<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../../../bootstrap-5.3.3-dist/css/bootstrap.css">
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
                                echo "<td>" . $fila['id_estaciones'] . "</td>";
                                echo "<td>" . $fila['nombre'] . "</td>";
                                echo "<td>";
                                echo "<button class='btn btn-danger eliminar mb-2' data-id='" . $fila['id_estaciones'] . "'>Eliminar</button>";
                                echo "<form action='actualizar_estaciones.php' method='post'>";
                                echo "<input type='hidden' name='id_estaciones' value='" . $fila['id_estaciones'] . "'>";
                                echo "<td>";
                                echo "<button type='submit' class='btn btn-primary' name='actualizar'>Actualizar</button>";
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
                        <div class="card card-body" style="width: 300px;">
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
   
</body>

</html>