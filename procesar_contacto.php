<?php
// Verificamos si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura los datos del formulario
    $nombre = trim($_POST["nombre"]); // Sanitizamos la entrada
    $email = trim($_POST["email"]);
    $mensaje = trim($_POST["mensaje"]);

    // Validaciones en el servidor
    if (strlen($nombre) < 3 ) {
        die("Error: El nombre debe tener al menos 3 caracteres.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Error: Correo electrónico no valido.");
    }

    if (strlen($mensaje) < 10){
        die("Error: El mensaje debe tener al menos 10 caracteres.");
    }

    // Formato del mensaje a guardar
    $registro = "Nombre: $nombre | Email: $email | Mensaje: $mensaje" . PHP_EOL;

    // Guardar en un archivo de texto (puede cambiarse a base de datos más adelante)
    file_put_contents("mensaje.txt", $registro, FILE_APPEND);

    // Redirigir a una página de confirmación
    header("Location: contacto_exitoso.html");
    exit();
} else {
    // Si se intenta acceder al script sin formulario, redirige al inicio
    header("Location: contacto.html");
    exit();
}
?>