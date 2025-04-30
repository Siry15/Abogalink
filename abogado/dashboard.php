<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'abogado') {
  header("Location: ../login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel del Abogado - AbogaLink</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
  <h1 class="mb-4">Bienvenido, Dr. <?= $_SESSION['nombre'] ?></h1>

  <div class="row g-4">
    <div class="col-md-4">
      <a href="asesorias.php" class="btn btn-light w-100">Ver Asesorías</a>
    </div>
    <div class="col-md-4">
      <a href="documentos.php" class="btn btn-light w-100">Documentos del Cliente</a>
    </div>
    <div class="col-md-4">
      <a href="agenda.php" class="btn btn-light w-100">Citas Pendientes</a>
    </div>
    <div class="col-md-4">
      <a href="precios.php" class="btn btn-light w-100">Enviar Precios</a>
    </div>
    <div class="col-md-4">
      <a href="normas.php" class="btn btn-light w-100">Normas del Sistema</a>
    </div>
    <div class="col-md-4">
      <a href="chat.php" class="btn btn-light w-100">Chat con Cliente</a>
    </div>
    <div class="col-md-4">
      <a href="videollamada.php" class="btn btn-light w-100">Videollamada</a>
    </div>
    <div class="col-md-4">
      <a href="../logout.php" class="btn btn-outline-danger w-100">Cerrar Sesión</a>
    </div>
  </div>
</div>

</body>
</html>