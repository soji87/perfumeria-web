<?php
$servidor = "localhost";
$usuario = "root"; // Cambiar si tienes un usuario distinto en MYSQL
$contraseña = ""; // Por defecto, en XAMPP no tiene contraseña
$base_datos = "perfumeria_web";

// Crear conexión
$conexion = new mysqli($servidor, $usuario, $contraseña, $base_datos);

// Comprobar conexión
if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
} else {
    echo "Conexión exitosa a la base de datos";
}
?>