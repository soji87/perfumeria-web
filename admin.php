<?php
session_start();

// Verificar si el usuario es un administrador autenticado
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] !== true) {
    header("Location: login_admin.php");
    exit();
}

// Incluir el archivo de conexión a la base de datos
require_once "conexion.php";

// Preparar y ejecutar la consulta de manera segura
$stmt = $conexion->prepare("SELECT id, nombre, email, mensaje, fecha FROM mensajes ORDER BY fecha DESC");
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="admin-panel">

    <header>
        <h1>Panel de Administración - Mensajes de Contacto</h1>
        <a href="logout.php" class="logout-button">Cerrar sesión</a>
    </header>

    <table>
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
                <td><?php echo htmlspecialchars($fila["id"]); ?></td>
                <td><?php echo htmlspecialchars($fila["nombre"]); ?></td>
                <td><?php echo htmlspecialchars($fila["email"]); ?></td>
                <td><?php echo nl2br(htmlspecialchars($fila["mensaje"])); ?></td>
                <td><?php echo htmlspecialchars($fila["fecha"]); ?></td>
                <td>
                    <a href="eliminar_mensaje.php?id=<?php echo $fila['id']; ?>" 
                        onclick="return confirm('¿Seguro que deseas eliminar este mensaje?')">🗑 Eliminar
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>

</body>
</html>

<?php
// Cerrar conexión
$stmt->close();
$conexion->close();
?>
