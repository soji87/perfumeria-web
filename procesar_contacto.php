<?php
// Incluir el archivo de conexion
require_once "conexion.php";

// Verificamos si el formulario fue enviado con Post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Función para limpiar los datos de entrada y prevenir inyecciones
    function limpiarDato($dato) {
        $dato = trim($dato); // Elimina espacios en blanco
        $dato = stripslashes($dato); // Elimina barras invertidas
        $dato = htmlspecialchars($dato, ENT_QUOTES, 'UTF-8'); // Convierte caracteres especiales
        return $dato;
    }

    // Captura y limpia los datos del formulario
    $nombre = limpiarDato($_POST["nombre"]); // Sanitizamos la entrada
    $email = limpiarDato($_POST["email"]);
    $mensaje = limpiarDato($_POST["mensaje"]);
    $captcha_usuario = limpiarDato($_POST["captcha"]); // Respuesta del usuario
    $captcha_valido = limpiarDato($_POST["captcha_valido"]); // Resultado correcto del CAPTCHA

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

    // Validación del CAPTCHA
    if ($captcha_usuario != $captcha_valido) {
        die("Error: El CAPTCHA no es correcto.");
    }

    // Preparar la consulta SQL para evitar inyecciones
    $stmt = $conexion->prepare("INSERT INTO mensajes (nombre, email, mensaje) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $mensaje);

    // Ejecutar la consulta y verificar resultado
    if ($stmt->execute()) {
        header("Location: contacto_exitoso.html");
        exit();
    } else {
        die("Error al guardar el mensaje: " . $stmt->error);
    }

    // Cerrar conexión
    $stmt->close();
    $conexion->close();
} else {
    header("Location: contacto.html");
    exit();
}
?>