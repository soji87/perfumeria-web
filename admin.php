<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

// Incluir el archivo de conexión a la base de datos
require_once "conexion.php";

// Obtener todos los mensajes
$sql = "SELECT * FROM mensajes ORDER BY fecha DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="Width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Panel de Administración - Mensajes de Contactos</h1>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Mensaje</th>
            <th>Fecha</th>
            <th>Acción</th>
        </tr>
        <?php while ($fila = $resultado->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $fila["id"]; ?></td>
                <td><?php echo htmlspecialchars($fila["nombre"]); ?></td>
                <td><?php echo htmlspecialchars($fila["email"]); ?></td>
                <td><?php echo nl2br(htmlspecialchars($fila["mensaje"])); ?></td>
                <td><?php echo $fila["fecha"]; ?></td>
                <td>
                    <a href="eliminar_mensaje.php?id=<?php echo $fila['id']; ?>" onclick="return confirm('¿Seguro que deseas eliminar este mensaje?')">🗑 Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>
<?php
// Cerrar conexión
$conexion->close();
?>
