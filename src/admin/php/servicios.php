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
    $sql = "SELECT * FROM servicios";
    $resultado = mysqli_query($conn, $sql);

    ?>
    <div class="container mt-4">
        <h1>VENTANA DE ADMINISTRACION DE SERVICIOS</h1>
        <div class="row mt-5">
            <div class="col-sm-4 col-md-10">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripcion</th>
                            <th scope="col">Precio</th>
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
                                echo "<td>" . $fila['id_servicio'] . "</td>";
                                echo "<td><img src='../../img/" . $fila['imagen'] . "' alt='' width='80px'></td>";
                                echo "<td>" . $fila['nombre'] . "</td>";
                                echo "<td>" . $fila['descripcion'] . "</td>";
                                echo "<td>" . $fila['precio'] . "</td>";

                                echo "<td>";
                                echo "<button class='btn btn-danger eliminar mb-2' data-id='" . $fila['id_servicio'] . "'>Eliminar</button>";
                                echo "<button class='btn btn-warning mb-2'>Actualizar</button>";
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
                    function eliminarRegistro(id_servicio) {
                        // Enviar una solicitud AJAX al servidor para eliminar el registro
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', './del_servicio.php', true);
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
                        xhr.send('id_servicio=' + id_servicio);
                    }


                });
            </script>
            <div class="col-9 col-md-2 ">
                <p>
                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                        Agregar Servicio
                    </button>
                </p>
                <div style="min-height: 120px;">
                    <div class="collapse collapse-horizontal" id="collapseWidthExample">
                        <div class="card card-body" style="width: 300px;">
                            <form action="add_servicio.php" method="post" enctype="multipart/form-data">
                                <div class="row g-3">

                                    <div class="col ">
                                        <input type="text" class="form-control" placeholder="Servicio" aria-label="First name" name="nombre">
                                    </div>

                                </div>
                                <div class="row g-3 mt-2">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="Precio" aria-label="Last name" name="precio">
                                    </div>
                                </div>

                                <div class="row g-3 mt-2">
                                    <div class="form-floating">
                                        <textarea class="form-control" name="descripcion" placeholder="Escriba una breve Descripcion para la cita" id="floatingTextarea2" style="height: 100px"></textarea>
                                        <label for="floatingTextarea2">Descripcion</label>
                                    </div>
                                </div>
                                <div class="row g-3 mt-2">
                                    <div class="col">
                                        <div class="input-group mb-3">
                                            
                                            <input type="file" class="form-control" id="inputGroupFile01" name="imagen">
                                        </div>
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