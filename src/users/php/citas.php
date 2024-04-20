<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../bootstrap-5.3.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="../../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <!-- Include the PayPal JavaScript SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=AWkwn-ZpT6B30b4VO--Hw0vxxfAjPiAaa390-0-FSFTdQF6YZUVbJeXcxGOhzkMrrEIwstluGw7Lu_d9&currency=MXN"></script>

    <title>Agendar</title>
</head>

<body">
    <?php
    require_once "./superior_usr.php";
    require_once "../../MYSQL/conexion.php";
    ?>
    <div class="container">
        <div class="row align-items-start">
            <div class="col-9">
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


                        <div class="col-4">
                            <div class="form-group">
                                <label for="tipo">Tipo de Servicio</label>
                                <select id="AnticipoServicio" class="form-select" aria-label="Default select example" name="servicio" required onchange="PagoAnticipo(this);">
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
                        <div class="col-4">
                            <div class="form-group">
                                <label for="estacion">Estaciones</label>
                                <Select class="form-select" aria-label="estaciones" name="estaciones" required>
                                    <option selected>Seleccione una estacion</option>
                                    <?php
                                    $consulta_estaciones = "SELECT * FROM estaciones";

                                    $resultado_estaciones = mysqli_query($conn, $consulta_estaciones);

                                    if (mysqli_num_rows($resultado_estaciones) > 0) {
                                        while ($fila = mysqli_fetch_array($resultado_estaciones)) {

                                    ?>
                                            <option value="<?php echo $fila['id_estaciones']; ?>"> <?php echo $fila['nombre'] ?></option>
                                    <?php

                                        }
                                    }
                                    ?>

                                </Select>
                            </div>
                        </div>
                        <div class="col-4">
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
                        <div class="form-group">
                            <label for="Anticipo">¿DESEA REALIZAR ANTICIPO?</label>
                            <select id="validarOpciones" class="form-select" aria-label="Default select example" name="Validar" required onchange="PagoAnticipo(this);">
                                <option selected>Selecciona una opción</option>
                                <option value="Si">Sí</option>
                                <option value="No">No</option>
                            </select>
                        </div>


                        <?php

                        //
                        if (isset($_SESSION['username'])) {
                            $username = $_SESSION['username'];
                            //consulta para el ticket
                            echo "
                            <div class='d-grid gap-2 d-md-block' >
                            <!-- Button trigger modal -->
                            <button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#exampleModal' >
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
                                        <div class='modal-footer' id='agendar'>";
                            while ($fila = mysqli_fetch_array($resultado)) {

                                echo "                
                                           <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                                           <input type='number' name='id' hidden  value='" . $fila['id_cita'] . "'>
                                            <button type='submit' hidden class='btn btn-outline-success' >ENVIAR</button>
                                        ";
                            }
                            echo "</div>
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

            <div class="col-3 text-center mt-5">

                <h3>AQUI PUEDE REALIZAR SU ANTICIPO DE LA CITA</h3>
                <div id="paypal-button-container"></div>


                <script>
                    // Función para verificar la disponibilidad de la fecha y hora seleccionadas
                    function verificarDisponibilidad() {
                        var fechaSeleccionada = document.getElementById("fecha").value;
                        var horaSeleccionada = document.getElementById("hora").value;

                        // Realizar una solicitud al servidor para verificar la disponibilidad en la base de datos
                        fetch('verificar_disponibilidad.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded'
                                },
                                body: 'fecha=' + encodeURIComponent(fechaSeleccionada) + '&hora=' + encodeURIComponent(horaSeleccionada)
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Si hay citas programadas para la fecha y hora seleccionadas, mostrar un mensaje de error
                                if (data.disponible === false) {
                                    alert('La fecha y hora seleccionadas ya están ocupadas. Por favor, elija otra.');
                                    // Limpiar los campos de fecha y hora seleccionados
                                    document.getElementById("fecha").value = "";
                                    document.getElementById("hora").value = "";
                                } else {
                                    alert("Horario disponible");


                                }
                            })
                            .catch(error => {
                                console.error('Error al verificar la disponibilidad:', error);
                                // Manejar el error de verificación de disponibilidad
                            });
                    }

                    function PagoAnticipoNoRequerido() {
                        console.log("Pago anticipo no requerido seleccionado");
                        // Restablecer el evento onchange para que RealizarAnticipo() se ejecute cuando cambie la selección
                        document.getElementById("validarOpciones").setAttribute("onchange", "RealizarAnticipo();");
                        // Restablecer el contenido del elemento con id "agendar"
                        document.getElementById("agendar").innerHTML = `
            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
            <button type='submit' class='btn btn-outline-success' onclick='verificarDisponibilidad();'>Enviar</button>
        `;
                        // Limpiar el contenedor de los botones de PayPal
                        document.getElementById("paypal-button-container").innerHTML = "";
                    }

                    function PagoAnticipo(selectElement) {
                        var realizarAnticipo = selectElement.value;
                        if (realizarAnticipo === "Si") {
                            var servicioId = document.getElementById("AnticipoServicio").value;
                            if (servicioId) {
                                fetch('obtener_anticipo.php', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/x-www-form-urlencoded'
                                        },
                                        body: 'servicio_id=' + encodeURIComponent(servicioId)
                                    })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Error al obtener el anticipo');
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        var anticipo = parseFloat(data.anticipo);
                                        if (!isNaN(anticipo)) {
                                            paypal.Buttons({
                                                style: {
                                                    color: 'blue',
                                                    shape: 'pill'
                                                },
                                                createOrder: function(data, actions) {
                                                    return actions.order.create({
                                                        purchase_units: [{
                                                            amount: {
                                                                currency_code: 'MXN',
                                                                value: anticipo.toFixed(2)
                                                            }
                                                        }]
                                                    })
                                                },
                                                onApprove: function(data, actions) {
                                                    actions.order.capture().then(function(detalles) {
                                                        if (detalles.status == "COMPLETED") {
                                                            var enviarCita = document.getElementById("agendar");
                                                            var codigoHtml = `
                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                                        <button type='submit' class='btn btn-outline-success' onclick='verificarDisponibilidad();'>Enviar</button>
                                    `;
                                                            enviarCita.innerHTML = codigoHtml;
                                                            // Peticion a servidor para enviar el ticket
                                                        }
                                                    });
                                                },
                                                onCancel: function(data) {
                                                    alert("Cancelado");
                                                    console.log(data);
                                                }
                                            }).render('#paypal-button-container');
                                        } else {
                                            console.error('El anticipo recibido no es un número válido:', data.anticipo);
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error al obtener el anticipo:', error.message);
                                        // Manejar el error al obtener el anticipo
                                    });
                            }
                        } else if (realizarAnticipo == "No") {
                            PagoAnticipoNoRequerido();
                        }
                    }
                </script>



            </div>

        </div>
    </div>
                    <?php
                    require_once("./inferior.php");
                    ?>
        </body>

</html>