<?php
session_start();
require '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idCliente = $_SESSION['id'];
  $idAbogado = $_POST['id_abogado'];
  $descripcion = $_POST['descripcion'];
  $fecha = date('Y-m-d');

  try {
    // Insertar en la tabla de solicitudes
    $sqlSolicitud = "INSERT INTO solicitudes (id_cliente, id_abogado, estado, fecha) VALUES (?, ?, 'pendiente', ?)";
    $stmtSolicitud = $conexion->prepare($sqlSolicitud);
    $stmtSolicitud->execute([$idCliente, $idAbogado, $fecha]);
    $idSolicitud = $conexion->lastInsertId();

    // Insertar en la tabla de asesorías
    $sqlAsesoria = "INSERT INTO asesorias (id_solicitud, descripcion, estado, fecha_solicitud) VALUES (?, ?, 'pendiente', ?)";
    $stmtAsesoria = $conexion->prepare($sqlAsesoria);
    $stmtAsesoria->execute([$idSolicitud, $descripcion, $fecha]);

    header("Location: ver_solicitudes.php");
    exit;
  } catch (Exception $e) {
    echo "Error al procesar la solicitud: " . $e->getMessage();
  }
}
?>