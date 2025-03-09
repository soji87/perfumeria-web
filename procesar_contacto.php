<?php
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

    // Evitar SPAM (ejemplo con una lista de palabras prohibidas)
    $palabras_prohibidas = ["http://", "https://", "www.", "viagra", "casino"];
    foreach ($palabras_prohibidas as $palabra) {
        if (stripos($mensaje, $palabra) !== false){
            die("Error: No se permiten mensajes con contenido sospechoso.");
        }
    }

    // Validación del CAPTCHA
    if ($captcha_usuario != $captcha_valido) {
        die("Error: El CAPTCHA no es correcto.");
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