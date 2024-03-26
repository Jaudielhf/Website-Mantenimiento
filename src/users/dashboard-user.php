<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">
  <script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>

  <title>Inicio</title>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="./dashboard-user.php">Inicio</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="./php/ubicaciones.php">Ubicaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./php/citas.php">Agendar</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Servicios
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Mantenimiento</a></li>
              <li><a class="dropdown-item" href="#">Reparacion</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Tutoriales</a></li>
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
              echo "<a class='nav-link' href='./php/editar_usuario.php'>Bienvenido, $username</a>";
            } else {
              echo "<a class='nav-link' href='./../login/sign.php'>Iniciar sesión</a>";
            }
            ?>
          </div>
          <div class="nav-item">

            <a class="nav-link" href="./../login/logout.php">Cerrar sesión</a>
          </div>
        </div>
      </div>

    </div>
  </nav>
  <div class="fondo">
    <div class="container text-center">
      <div class="row fila ">
        <div class="col-6">
          <h1 class="display-1">AGENDE SU CITA </h1>
        </div>
        <div class="col-8">
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam esse a sapiente, praesentium quae dignissimos ullam deleniti, alias repellendus laudantium iusto corporis impedit sunt dolorem aut voluptatum, officia itaque dicta.</p>
        </div>
        <div class="col-12">
          <a href="./php/citas.php" class="btn btn-primary">Agendar Cita</a>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row text-center ">
      <h1 class="">Nuestros Servicios</h1>

      <?php

      require_once('../MYSQL/conexion.php');
      $sql = "SELECT * FROM servicios";
      $resultado = mysqli_query($conn, $sql);

      if (mysqli_num_rows($resultado) > 0) {
        while ($row = mysqli_fetch_array($resultado)) {


          echo "<div class='card mt-5'>";
          echo "<div class='image'>
                <img src='../img/". $row['imagen']. "' class='image' alt='...'>
    
          </div>";
          echo "<div class='content'>";
          echo "<a href='#'>";
          echo "<span class='title'>"
            . $row['nombre'] .
            "</span>";
          echo "</a>";

          echo "<p class='desc'>"
            . $row['descripcion'] .
            "</p>";

          echo "<a class='action' href='#'>";
          echo "Agendar cita";
          echo "<span aria-hidden='true'>";
          echo "→";
          echo "</span>";
          echo "</a>";
          echo " </div>";
          echo "</div>";
        }
      }

      ?>


    </div>
  </div>



</body>

</html>