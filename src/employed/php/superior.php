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
                        <a class="nav-link" href="./citas.php">Citas</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Administrar
                        </a>
                        <ul class="dropdown-menu">
                            
                            <li><a class="dropdown-item" href="./admin-user.php">Usuarios</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Servicios</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="navbar-nav">
                    <div class="nav-item">
                        <?php
                        // Iniciar sesión (si no lo has hecho aún)
                        session_start();

                        // Verificar si el nombre de usuario/empleado está almacenado en la variable de sesión
                        if (isset($_SESSION['username'])) {
                            $username = $_SESSION['username'];
                            echo "<p class='nav-link'>Bienvenido, $username</p>";
                        } else {
                            echo "<a class='nav-link' href=''>Iniciar sesión</a>";
                        }
                        ?>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link" href="../../login/logout.php">Cerrar sesión</a>
                    </div>
                </div>
            </div>
    </nav>