<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../bootstrap-5.3.3-dist/css/bootstrap.css">
    <script src="../../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>

    <title>Agendar</title>
</head>
<script>
    function mostrarToast() {
        // Obtener el elemento del toast
        var toast = document.getElementById("miToast");
        // Establecer su estilo para que sea visible
        toast.style.display = "block";
        // Inicializar el toast de Bootstrap para que funcione correctamente
        var toastEl = new bootstrap.Toast(toast);
        // Mostrar el toast
        toastEl.show();
    }
</script>

<body onload="mostrarToast()">
    <?php
    require_once "./superior_usr.php";
    require_once "../../MYSQL/conexion.php";
    ?>
    <div class="container">
        <div class="row align-items-start">
            <div class="col">
                <div class="container ">
                    <h2>
                        Agendar Cita
                    </h2>
                    <?php


                    if (isset($_SESSION['username'])) {
                        $username = $_SESSION['username'];

                        $sql = "SELECT * FROM usuarios WHERE username = '$username'";
                        $resultado = mysqli_query($conn, $sql);


                    ?>
                        <form method="POST" action="agendar.php" class="row g-3">

                            <?php

                            if (mysqli_num_rows($resultado) > 0) {
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    echo "
                           <div class='input-group'>
                            <span class='input-group-text'>Nombre completo</span>
                            <input type='text' aria-label='Nombre' class='form-control' hidden value='" . $fila['id_usuario'] . "' name='id_user'>
                            <input type='text' aria-label='Nombre' class='form-control' value='" . $fila['nombre'] . "' readonly>
                            <input type='text' aria-label='Apellido Paterno' class='form-control'  value='" . $fila['apellido_pat'] . "' readonly>
                            <input type='text' aria-label='Apellido Materno' class='form-control' value='" . $fila['apellido_mat'] . "' readonly>
                        </div>
                        <div class='input-group mb-3'>
                            <input type='text' class='form-control' placeholder='Correo Electronico' aria-label='Recipient's username' aria-describedby='basic-addon2' value='" . $fila['email'] . "' readonly>
                            <span class='input-group-text' id='basic-addon2'>Correo</span>
                        </div>
                        <div class='input-group mb-2'>
                            <input type='tel' placeholder='Telefono' class='form-control' aria-label='Recipient's username' aria-describedby='basic-addon2' value='" . $fila['telefono'] . "' readonly>
                        </div>
                        ";
                                }
                            }
                            ?>
                        <?php
                    } else {
                        echo "
                            <div class='input-group'>
                            
                            <span class='input-group-text'>Nombre completo</span>
                            
                            <input type='text' aria-label='Nombre' class='form-control'>
                            <input type='text' aria-label='Apellido Paterno' class='form-control'>
                            <input type='text' aria-label='Apellido Materno' class='form-control'>
                        </div>
                        <div class='input-group mb-3'>
                            <input type='text' class='form-control' placeholder='Correo Electronico' aria-label='Recipient's username' aria-describedby='basic-addon2'>
                            <span class='input-group-text' id='basic-addon2'>Correo</span>
                        </div>
                        <div class='input-group mb-2'>
                            <input type='tel' placeholder='Telefono' class='form-control' aria-label='Recipient's username' aria-describedby='basic-addon2'>
                        </div>
                            ";
                    }
                        ?>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" id="fecha" name="fecha" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="hora">Hora</label>
                                <input type="time" class="form-control" id="hora" name="hora" required>
                            </div>
                        </div>


                        <div class="col-6">
                            <div class="form-group">
                                <label for="tipo">Tipo de Servicio</label>
                                <select class="form-select" aria-label="Default select example" name="servicio" required>
                                    <option selected>Selecciona un tipo de servicio</option>
                                    <?php

                                    $sql = "SELECT * FROM servicios";

                                    $resultado = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($resultado) > 0) {

                                        while ($fila = mysqli_fetch_assoc($resultado)) {
                                    ?>

                                            <option value="<?php echo $fila['id_servicio']; ?>"><?php echo $fila['nombre']; ?></option>

                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="empleado">Empleado</label>
                                <?php
                                
                                require_once "../../MYSQL/conexion.php";
                                // Obtener la fecha y hora actual
                                date_default_timezone_set('America/Mexico_City');

                                $fecha_actual = date("Y-m-d");
                                $hora_actual = date("H:i:s");
                                
                                // Consultar empleados disponibles
                                $sql = "SELECT e.id_empleado, e.nombre
        FROM empleados e
        INNER JOIN admin_empleados ae ON e.id_empleado = ae.id_empleado
        WHERE '$fecha_actual' BETWEEN ae.fecha_inicio AND ae.fecha_fin AND
              '$hora_actual' BETWEEN ae.hora_inicio AND ae.hora_fin";


                                $resultado = mysqli_query($conn, $sql);

                                ?>

                                <select class="form-select" aria-label="Default select example" name="empleado" required>
                                    <option selected>Seleccione un empleado para la cita</option>

                                    <?php
                                    if (mysqli_num_rows($resultado) > 0) {
                                        while ($fila = mysqli_fetch_array($resultado)) {
                                    ?>
                                            <option value="<?php echo $fila['id_empleado']; ?>"><?php echo $fila['nombre']; ?></option>
                                    <?php
                                        }
                                    } else {
                                        echo '<option value="" disabled>No hay empleados disponibles en este momento.</option>';
                                    }
                                    ?>

                                </select>

                            </div>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" name="descripcion" placeholder="Escriba una breve Descripcion para la cita" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Escriba una breve Descripcion para la cita</label>
                        </div>

                        <?php


                        // Verificar si el nombre de usuario/empleado está almacenado en la variable de sesión
                        if (isset($_SESSION['username'])) {
                            $username = $_SESSION['username'];
                            echo "
                            <div class='d-grid gap-2 d-md-block'>
                            <!-- Button trigger modal -->
                            <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                                Agendar cita
                            </button>

                            <!-- Modal -->
                            <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h1 class='modal-title fs-5' id='exampleModalLabel'>!Atencion¡</h1>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                            Esta a punto de agendar una cita, antes de enviar, favor de verificar sus datos para mejorar la experiencia en la estacion de servicio seleccionada
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                                            <button type='submit' class='btn btn-outline-success'>Enviar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                            ";
                        } else {
                            echo "
                            <div class='d-grid gap-2 d-md-block'>
                            <!-- Button trigger modal -->
                            <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                                Agendar cita
                            </button>

                            <!-- Modal -->
                            <div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                <div class='modal-dialog'>
                                    <div class='modal-content'>
                                        <div class='modal-header'>
                                            <h1 class='modal-title fs-5' id='exampleModalLabel'>!Atencion¡</h1>
                                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                        </div>
                                        <div class='modal-body'>
                                            Para agendar una cita, es necesario tener una cuenta en el sistema, registrate, es gratis
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                                            <a href='./../../login/sign.php' class='btn btn-outline-success'>Registrarse</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                            ";
                        }


                        ?>

                        
                        </form>
                </div>
            </div>
        </div>
        <div id="miToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="..." class="rounded me-2" alt="...">
                <strong class="me-auto">Atencion</strong>
                <small>Ahora</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Para agendar una cita es necesario dejar un anticipo, para garantizar la cita, y si se requiere comprar respuestos necesarios
            </div>
        </div>
</body>

</html>