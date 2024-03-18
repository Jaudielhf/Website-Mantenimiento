<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../bootstrap-5.3.3-dist/css/bootstrap.css">
   
    <script src="../../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
   
    <title>Agendar</title>
</head>

<body>
    <?php
    require_once "./superior_usr.php";
    ?>

    <div class="container">
        <div class="row align-items-start">
            <div class="col">
                <div class="container ">
                    <h2>
                        Agendar Cita
                    </h2>
                    <form method="POST" action="php/agendar.php" class="row g-3">
                        <div class="input-group">
                            <span class="input-group-text">Nombre completo</span>
                            <input type="text" aria-label="Nombre" class="form-control">
                            <input type="text" aria-label="Apellido Paterno" class="form-control">
                            <input type="text" aria-label="Apellido Materno" class="form-control">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Correo Electronico" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text" id="basic-addon2">Correo</span>
                        </div>
                        <div class="input-group mb-2">
                            <input type="tel" name="" id="" placeholder="Telefono" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
                        <div class="form-group">
                            <label for="hora">Hora</label>
                            <input type="time" class="form-control" id="hora" name="hora" required>
                        </div>

                        <div class="form-group">
                            <label for="tipo">Tipo de Servicio</label>
                            <select class="form-select" aria-label="Default select example" name="tipo" required>
                                <option selected>Selecciona un tipo de servicio</option>
                                <option value="1">Mantenimiento Preventivo</option>
                                <option value="2">Mantenimiento Correctivo</option>
                                <option value="3">Reparacion</option>
                                <option value="4">Actualizacion</option>
                                <option value="5">Ensamblaje</option>
                            </select>
                        </div>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Escriba una breve Descripcion para la cita" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Escriba una breve Descripcion para la cita</label>
                        </div>

                        <div class="d-grid gap-2 d-md-block">
                        <button type="submit" class="btn btn-outline-success">Enviar</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
</body>

</html>