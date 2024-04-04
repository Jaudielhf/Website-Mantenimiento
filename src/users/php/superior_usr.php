<nav class="navbar navbar-expand-lg bg-body-tertiary ">
  <div class="container-fluid">
    <a class="navbar-brand" href="../index.php">Inicio</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./ubicaciones.php">Ubicaciones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="citas.php">Agendar</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Servicios
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Mantenimiento</a></li>
            <li><a class="dropdown-item" href="#">Reparacion</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="./ver_citas.php">Ver citas</a></li>
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
              echo "<a class='nav-link' href='./editar_usuario.php'>Bienvenido, $username</a>
              </div>
              <div class='vr'></div>
              <div class='nav-item'>
    
                <a class='nav-link' href='../../login/logout.php'>Cerrar sesión</a>
              </div>
              ";
            } else {
              echo "<a class='nav-link' href='../../login/sign.php'>Iniciar sesión</a>";
            }
            ?>
         
        </div>
    </div>
  </div>
</nav>
