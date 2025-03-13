<?php
$servidor = "localhost";
$usuario = "root"; // Cambiar si tienes un usuario distinto en MYSQL
$contraseña = ""; // Por defecto, en XAMPP no tiene contraseña
$base_datos = "perfumeria_web";

// Crear conexión
$conn = new mysqli($servidor, $usuario, $contraseña, $base_datos);

// Comprobar conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
} else {
    echo "Conexión exitosa a la base de datos";
}
?>