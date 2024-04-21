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
<?php
require_once "./superior_usr.php";
?>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }
        select, input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 100px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Editar Cita</h1>
        <?php
        require_once "../../MYSQL/conexion.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar_cita'])) {
            if (isset($_POST['id_cita'])) {
                $id_cita = $_POST['id_cita'];

                $sql = "SELECT * FROM citas WHERE id_cita = '$id_cita'";
                $resultado = mysqli_query($conn, $sql);

                if ($resultado && mysqli_num_rows($resultado) > 0) {
                    $cita = mysqli_fetch_assoc($resultado);
                    ?>
                    <form action="actualizar_cita_procesar.php" method="POST">
                        <input type="hidden" name="id_cita" value="<?php echo $cita['id_cita']; ?>">
                        
                        <label for="id_servicio">Servicio:</label>
                        <select name="id_servicio">
                            <?php
                            $sql_servicios = "SELECT * FROM servicios";
                            $resultado_servicios = mysqli_query($conn, $sql_servicios);

                            if ($resultado_servicios && mysqli_num_rows($resultado_servicios) > 0) {
                                while ($servicio = mysqli_fetch_assoc($resultado_servicios)) {
                                    $selected = ($cita['id_servicio'] == $servicio['id_servicio']) ? 'selected' : '';
                                    echo "<option value='{$servicio['id_servicio']}' $selected>{$servicio['nombre']}</option>";
                                }
                            }
                            ?>
                        </select>

                        <label for="fecha">Fecha:</label>
                        <input type="text" name="fecha" value="<?php echo $cita['fecha']; ?>">

                        <label for="horario">Hora:</label>
                        <input type="text" name="horario" value="<?php echo $cita['horario']; ?>">

                        <label for="horario">Anticipo:</label>
                        <input type="text" name="anticipo" value="<?php echo $cita['anticipo']; ?>" readonly>

                        <label for="descripcion">Descripción:</label>
                        <textarea name="descripcion"><?php echo $cita['descripcion']; ?></textarea>

                        <input type="submit" name="actualizar_cita" value="Actualizar Cita">
                    </form>
                    <?php
                } else {
                    echo "No se encontró la cita.";
                }
            } else {
                echo "ID de cita no especificado.";
            }
        }
        ?>
    </div>
</body>
</html>
