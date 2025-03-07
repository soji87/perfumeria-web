<?php
// Verificamos si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST["nombre"]); // Sanitizamos la entrada
    $email = htmlspecialchars($_POST["email"]);
    $mensaje = htmlspecialchars($_POST["mensaje"]);

    // Mostramos los datos (luego esto se enviará por email o se guardará en una BBDD)
    echo "<h1>Mensaje Recibido</h1>";
    echo "<p><strong>Nombre: </strong> $nombre</p>";
    echo "<p><strong>Correo Electrónico: </strong> $email</p>";
    echo "<p><strong>Mensaje: </strong> $mesaje</p>";
}else{
    echo "<h1>Error</h1><p>Acceso no permitido.</p>";
}
?>