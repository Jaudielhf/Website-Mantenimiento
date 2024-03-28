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