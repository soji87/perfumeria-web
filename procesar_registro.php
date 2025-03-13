<?php
// Incluir el archivo de conexión
require_once "conexion.php";

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash de la contraseña

    // Validar que el email no esté registrado
    $sql_verificar = "SELECT id FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql_verificar);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        die("Error: El correo ya está registrado.");
    }

    // Insertar usuario en la base de datos
    $sql = "INSERT INTO usuarios (nombre, email, contraseña) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $nombre, $email, $password);

    if ($stmt->execute()) {
        echo "Registro exitoso. <a href='index.html'>Iniciar sesión</a>";
    } else {
        echo "Error en el registro.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Acceso no autorizado.";
}
?>