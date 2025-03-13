<?php
$sevidor = "localhost";
$usuario = "root"; // Cambiar si tienes un usuario distinto en MYSQL
$clave = ""; // Por defecto, en XAMPP no tiene contraseña
$baseDatos = "perfumeria";

// Crear conexión
$conexion = new mysqli($servidor, $usuario, $clave, $baseDatos);

// Comprobar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>