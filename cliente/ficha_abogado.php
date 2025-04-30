<?php
session_start();
require '../db.php';

if (!isset($_GET['id'])) {
    echo "Abogado no especificado.";
    exit;
}

$id_abogado = $_GET['id'];

$stmt = $conexion->prepare("SELECT * FROM abogados WHERE id = ?");
$stmt->execute([$id_abogado]);
$abogado = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$abogado) {
    echo "Abogado no encontrado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ficha del Abogado</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
  <h2>Ficha del Abogado</h2>

  <div class="card bg-secondary p-4 mb-4">
    <h4><?= htmlspecialchars($abogado['nombre']) ?></h4>
    <p><strong>Especialidad:</strong> <?= htmlspecialchars($abogado['especialidad']) ?></p>
    <p><strong>Correo:</strong> <?= htmlspecialchars($abogado['correo']) ?></p>
  </div>

  <form method="POST" action="solicitar_asesoria.php" class="bg-secondary p-4 rounded">
    <input type="hidden" name="id_abogado" value="<?= $abogado['id'] ?>">
    
    <div class="mb-3">
      <label for="descripcion" class="form-label">Descripción de la Asesoría:</label>
      <textarea name="descripcion" id="descripcion" class="form-control" rows="4" required></textarea>
    </div>

    <button type="submit" class="btn btn-light w-100">Solicitar Asesoría</button>
  </form>

  <a href="ver_abogados.php" class="btn btn-outline-light mt-3">Volver a la lista</a>
</div>

</body>
</html>