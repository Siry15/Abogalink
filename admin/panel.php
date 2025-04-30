<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
  header("Location: ../login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Administrativo - AbogaLink</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
  <h1 class="mb-4">Panel del Administrador</h1>

  <div class="row g-4">
    <div class="col-md-4">
      <a href="verificar_abogados.php" class="btn btn-light w-100">Verificar Abogados</a>
    </div>
    <div class="col-md-4">
      <a href="usuarios.php" class="btn btn-light w-100">Usuarios (Habilitar/Inhabilitar)</a>
    </div>
    <div class="col-md-4">
      <a href="estadisticas.php" class="btn btn-light w-100">Estadísticas</a>
    </div>
    <div class="col-md-4">
      <a href="historial.php" class="btn btn-light w-100">Historial</a>
    </div>
    <div class="col-md-4">
      <a href="normas.php" class="btn btn-light w-100">Normas del Sistema</a>
    </div>
    <div class="col-md-4">
      <a href="../logout.php" class="btn btn-outline-danger w-100">Cerrar Sesión</a>
    </div>
  </div>
</div>

</body>
</html>