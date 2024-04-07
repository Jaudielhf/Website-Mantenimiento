<?php


$conn = new mysqli("localhost", "root", "", "mantenimiento");

$conn->set_charset('utf8');
// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



?>