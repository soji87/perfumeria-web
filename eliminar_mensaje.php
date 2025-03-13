<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("Location: login_admin.php");
    exit();
}

// Incluir la conexión
require_once "conexion.php";

// Verificar si hay un ID Válido en la URL
if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
    $id = $_GET["id"];

    // Preparar la consulta para eliminar el mensaje
    $stmt = $conexion->prepare("DELETE FROM mensajes WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Ejecutar la eliminación y redirigir
    if ($stmt->execute()) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error al eliminar el mensaje.";
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "ID inválido.";
}
?>