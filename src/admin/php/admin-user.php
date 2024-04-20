<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./../../../bootstrap-5.3.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="../js/script-admuser.js"></script>
    <script src="./../../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <title>Usuarios</title>
</head>

<body>
    <?php
    require_once "./superior.php";
    // Establecer conexión con la base de datos
    require_once "../../MYSQL/conexion.php";

    // Consulta SQL para obtener los datos de la tabla
    $sql = "SELECT * FROM usuarios";
    $resultado = mysqli_query($conn, $sql);

    ?>
    <div class="container m-4">
        <h1>VENTANA DE ADMINISTRACIÓN DE USUARIOS</h1>
        <div class="row mt-5">
            <div class="col-sm-6 col-md-9">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Apellido Paterno</th>
                            <th scope="col">Apellido Materno</th>
                            <th scope="col">Correo Electronico</th>
                            <th scope="col">Teléfono</th>
                            <th colspan="2" scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Verificar si la consulta devuelve algún resultado
                        if (mysqli_num_rows($resultado) > 0) {
                            // Iterar sobre cada fila de resultados
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                echo "<tr>";
                                echo "<th scope='row'>" . $fila['id_usuario'] . "</th>";
                                echo "<td>" . $fila['nombre'] . "</td>";
                                echo "<td>" . $fila['apellido_pat'] . "</td>";
                                echo "<td>" . $fila['apellido_mat'] . "</td>";
                                echo "<td>" . $fila['email'] . "</td>";
                                echo "<td>" . $fila['telefono'] . "</td>";
                                echo "<td>";
                                echo "<button class='btn btn-danger eliminar mb-2' data-id='".$fila['id_usuario'] ."'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash3' viewBox='0 0 16 16'>
                                <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5'/>
                                </svg>
                                </button>";
                                echo "<form action='actualizar_user.php' method='post'>";
                                echo "<input type='hidden' name='id_usuario' value='" . $fila['id_usuario'] . "'>";
                                echo "<td>";
                                echo "<button type='submit' class='btn btn-primary' name='actualizar'>
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

            <div class="col-4 col-md-3" >
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
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $apellidoP = $_POST['apellido_pat'];
        $apellidoM = $_POST['apellido_mat'];
        $Username = $_POST['username'];
        $correo = $_POST['email'];
        $contraseña = $_POST['pass'];
        $telefono = $_POST['tel'];
        $sql = "INSERT INTO usuarios (nombre, apellido_pat, apellido_mat, email, username, password, telefono) VALUES ('$nombre', '$apellidoP', '$apellidoM', '$correo', '$Username', '$contraseña', '$telefono')";

        $resultado = mysqli_query($conn, $sql);
        if ($resultado) {
            echo "<script>alert('Usuario registrado correctamente');</script>";
            echo "<script>window.location.href='./admin-user.php';</script>";
        } else {
            echo "<p>Error al registrar usuario</p>";
        }
        $conn->close();
    }
    ?>
      <?php
        require_once("./inferior.php");
        ?>
</body>

</html>
