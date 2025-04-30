<?php
session_start();
require '../db.php';

if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'admin') {
  header("Location: ../login.php");
  exit;
}

// Verificar abogado por ID (cuando se hace clic en el botón)
if (isset($_GET['verificar'])) {
  $id_abogado = $_GET['verificar'];
  $sql = "UPDATE usuarios SET verificado = 1 WHERE id = ? AND rol = 'abogado'";
  $stmt = $conexion->prepare($sql);
  $stmt->execute([$id_abogado]);
  header("Location: verificar_abogados.php");
  exit;
}

// Traer todos los abogados no verificados
$sql = "SELECT * FROM usuarios WHERE rol = 'abogado' AND verificado = 0";
$stmt = $conexion->query($sql);
$abogados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Verificar Abogados - Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">

<div class="container mt-5">
  <h2 class="mb-4">Verificación de Abogados Pendiente</h2>

  <?php if (empty($abogados)): ?>
    <div class="alert alert-success">No hay abogados pendientes de verificación.</div>
  <?php else: ?>
    <table class="table table-striped table-dark">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Especialidad</th>
          <th>Acción</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($abogados as $abogado): ?>
        <tr>
          <td><?= htmlspecialchars($abogado['nombre_completo']) ?></td>
          <td><?= htmlspecialchars($abogado['correo']) ?></td>
          <td><?= htmlspecialchars($abogado['especialidad']) ?></td>
          <td>
            <a href="?verificar=<?= $abogado['id'] ?>" class="btn btn-success btn-sm">Verificar</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>

  <a href="panel.php" class="btn btn-outline-light mt-3">Volver al panel</a>
</div>

</body>
</html>