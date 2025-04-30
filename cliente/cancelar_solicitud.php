<?php
session_start();
require '../db.php';

if (!isset($_SESSION['id'])) {
    die("Acceso denegado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_solicitud'])) {
    $idCliente = $_SESSION['id'];
    $idSolicitud = $_POST['id_solicitud'];

    try {
        // Verificar que la solicitud pertenece al cliente que está logueado
        $stmt = $conexion->prepare("SELECT * FROM solicitudes WHERE id = ? AND id_cliente = ?");
        $stmt->execute([$idSolicitud, $idCliente]);
        $solicitud = $stmt->fetch();

        if ($solicitud) {
            // Actualizar estado a "cancelada"
            $update = $conexion->prepare("UPDATE solicitudes SET estado = 'cancelada' WHERE id = ?");
            $update->execute([$idSolicitud]);

            // Opcional: también puedes actualizar la asesoría
            $update2 = $conexion->prepare("UPDATE asesorias SET estado = 'cancelada' WHERE id_solicitud = ?");
            $update2->execute([$idSolicitud]);
        }
    } catch (Exception $e) {
        echo "Error al cancelar: " . $e->getMessage();
        exit;
    }
}

// Redirigir de nuevo a ver_solicitudes
header("Location: ver_solicitudes.php");
exit;