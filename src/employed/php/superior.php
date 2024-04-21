<?php
session_start();

if (!isset($_SESSION['id_empleado'])) {
    header("Location: ../../login/login.php");
    exit();
}

require_once "../../MYSQL/conexion.php";

$id_empleado = $_SESSION['id_empleado'];
$sql = "SELECT nombre FROM empleados WHERE id_empleado = $id_empleado";
$resultado = mysqli_query($conn, $sql);

if (mysqli_num_rows($resultado) == 1) {
    $empleado = mysqli_fetch_assoc($resultado);
    $nombreEmpleado = $empleado['nombre'];
} else {
    $nombreEmpleado = "Nombre de Empleado Desconocido";
}

?>

<div class="container-fluid">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../dashboard-emp.php">Inicio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item">
                        <a class="nav-link" href="./citas_completo.php">Citas</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Administrar
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./admin-user.php">Usuarios</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="./servicios.php">Servicios</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./php/pago.php">Realizar Pago</a>
                    </li>
                </ul>
                <div class="navbar-nav">
                    <div class="nav-item">
                        <?php
                        echo "<p class='nav-link'>Bienvenido, $nombreEmpleado</p>";
                        ?>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link" href="../../login/logout.php">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
