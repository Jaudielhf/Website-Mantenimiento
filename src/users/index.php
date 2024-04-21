<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Agregamos FontAwesome para los iconos -->
  <script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>

  <title>Inicio</title>
  <style>
    .vr {
      border-left: 1px solid #ffffff;
      height: 40px;
      margin: 0 10px;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="./index.php">Inicio</a>
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
          <li class="nav-item">
            <a class="nav-link"  href="./php/ver_citas.php">ver citas</a>
          </li>
         
        </ul>
        <div class="navbar-nav">
          <?php
          session_start();

          if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            echo "<div class='nav-item'>
                    <a class='nav-link' href='./php/editar_usuario.php'>Bienvenido, $username</a>
                  </div>
                  <div class='vr'></div>
                  <div class='nav-item'>
                    <a class='nav-link' href='../login/logout.php'>Cerrar sesión</a>
                  </div>";
          } else {
            echo "<div class='nav-item'>
                    <a class='nav-link' href='./../login/sign.php'>Iniciar sesión</a>
                  </div>";
          }
          ?>
        </div>
      </div>
    </div>
  </nav>

  <div class="fondo">
    <div class="container text-center">
      <div class="row fila ">
        <div class="fondo-texto">
          <div class="col-6">
            <h1 class="display-1">AGENDE SU CITA </h1>
          </div>
          <div class="col-8">
            <p>Bienvenido a nuestra plataforma de agendamiento de citas para reparación y mantenimiento de equipos de cómputo. En nuestra página, puedes fácilmente programar citas en diferentes ubicaciones, obtener información sobre nuestros servicios y ver tus citas programadas. Nuestro equipo de expertos está listo para atenderte y resolver cualquier problema que tengas con tus equipos informáticos. ¡Agenda tu cita hoy mismo y deja que nosotros nos encarguemos del resto!</p>
          </div>
        </div>
        <div class="col-12">
          <a href="./php/citas.php" class="btn btn-primary">Agendar Cita</a>
        </div>
      </div>
    </div>
  </div>

  <hr>

  <div class="container">
    <div class="row text-center">
      <h1 class="">Nuestros Servicios</h1>

      <?php
      require_once('../MYSQL/conexion.php');
      $sql = "SELECT * FROM servicios LIMIT 4";
      $resultado = mysqli_query($conn, $sql);

      if (mysqli_num_rows($resultado) > 0) {
        while ($row = mysqli_fetch_array($resultado)) {
          echo "<div class='card mt-4'>";
          echo "<div class='image'>
                  <img src='../img/" . $row['imagen'] . "' class='image' alt='...'>
                </div>";
          echo "<div class='content'>";
          echo "<a href='#'>";
          echo "<span class='title'>" . $row['nombre'] . "</span>";
          echo "</a>";
          echo "<p class='desc'>" . $row['descripcion'] . "</p>";
          echo "<a class='action' href='./php/citas.php'>Agendar cita<span aria-hidden='true'>→</span></a>";
          echo "</div>";
          echo "</div>";
        }
      }
      ?>
    </div>
  </div>

  <?php
  require_once("./php/inferior.php");
  ?>
</body>

</html>
