<?php
$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "abogalink";

$conexion = new mysqli($servidor, $usuario, $password, $base_datos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
// echo "Conexión exitosa"; // Puedes activarlo para hacer pruebas
?>