<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Sig In</title>
</head>
<body>
<?php
require_once "../MYSQL/conexion.php";

// Función para verificar la validez del correo electrónico utilizando la API de ZeroBounce
function verifyEmail($email) {
    $api_key = 'b6739a02ebaa4452b254a0fa540de5f3'; // Reemplazar 'your_api_key' con tu clave API de ZeroBounce
    $url = "https://api.zerobounce.net/v2/validate?api_key=$api_key&email=".urlencode($email);

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
        ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        // Si hay un error al realizar la solicitud HTTP, devuelve null
        return null;
    } else {
        // Decodificar la respuesta JSON
        $data = json_decode($response, true);
        // Verificar el resultado de la verificación
        if (isset($data['status']) && $data['status'] === 'valid') {
            return true; // La dirección de correo electrónico es válida
        } else {
            return false; // La dirección de correo electrónico es inválida
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['Nombre'];
    $apellidoP = $_POST['Apellido_Pat'];
    $apellidoM = $_POST['Apellido_Mat'];
    $Username = $_POST['Username'];
    $correo = $_POST['Email'];
    $contraseña = $_POST['Password'];
    $telefono = $_POST['Telefono'];

    // Realizar la verificación de la dirección de correo electrónico
    $isEmailValid = verifyEmail($correo);

    if ($isEmailValid === true) {
        // Si la dirección de correo electrónico es válida, continuar con el procesamiento de los datos
        // Verificar si el usuario ya existe en la base de datos
        $consulta = "SELECT * FROM usuarios WHERE username = '$Username'";
        $resultado = mysqli_query($conn, $consulta);
        if ($resultado && mysqli_num_rows($resultado) > 0) {
            echo "<script>alert('Usuario existente');</script>";
        } else {
            // Insertar el nuevo usuario en la base de datos
            $sql = "INSERT INTO usuarios (nombre, apellido_pat, apellido_mat, email, username, password, telefono) VALUES ('$nombre', '$apellidoP', '$apellidoM', '$correo', '$Username', '$contraseña', '$telefono')";
            $resultado = mysqli_query($conn, $sql);
            if ($resultado) {
                echo "<script>alert('Usuario registrado correctamente');</script>";
                echo "<script>window.location.href='./login.php';</script>";
            } else {
                echo "<script>alert('Error al registrar usuario');</script>";
            }
        }
    } elseif ($isEmailValid === false) {
        // Si la dirección de correo electrónico es inválida, mostrar un mensaje de error
        echo "<script>alert('La dirección de correo electrónico no es válida');</script>";
    } else {
        // Si no se pudo determinar la validez de la dirección de correo electrónico, mostrar un mensaje de error
        echo "<script>alert('No se pudo determinar la validez de la dirección de correo electrónico');</script>";
    }
}
$conn->close();
?>




    <div class="login-box sign">
        <p>Sign Up</p>
        <form method="post">
          <div class="user-box">
            <input required="" name="Nombre" type="text">
            <label>Nombre</label>
          </div>
          <div class="user-box">
            <input required="" name="Apellido_Pat" type="text">
            <label>Apellido Paterno</label>
          </div>
          <div class="user-box">
          <input required="" name="Apellido_Mat" type="text">
            <label>Apellido Materno</label>
          </div>
          <div class="user-box">
            <input required="" name="Username" type="text">
            <label>Username</label>
          </div>
          <div class="user-box">
            <input required="" name="Email" type="text">
            <label>Email</label>
          </div>
          <div class="user-box">
            <input required="" name="Password" type="password">
            <label>Password</label>
          </div>
          <div class="user-box">
            <input required="" name="Telefono" type="text">
            <label>Telefono</label>
          </div>
          
          <a href="#" type="submit">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <button type="submit">Submit</button>
          </a>
        </form>
        
        <p>Iniciar sesion <a href="./login.php" class="a2">Login</a></p>
      </div>

</body>
</html>