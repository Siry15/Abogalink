<?php
session_start();
require '../db.php';

if (!isset($_SESSION['id'])) {
    die("Acceso denegado. Debes iniciar sesión.");
}

// Obtener los abogados verificados
$sql = "SELECT id, nombre_completo, especialidad FROM usuarios WHERE rol = 'abogado' AND verificado = 1";
$stmt = $conexion->prepare($sql);
$stmt->execute();
$abogados = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Ver Abogados</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #0d1117;
      color: white;
      overflow-x: hidden;
    }

    body::before {
      content: "";
      position: fixed;
      top: 50%;
      left: 50%;
      width: 300px;
      height: 300px;
      background-image: url('../assets/logo.png');
      background-size: contain;
      background-repeat: no-repeat;
      opacity: 0.03;
      z-index: 0;
      transform: translate(-50%, -50%);
      animation: flotar 8s ease-in-out infinite;
    }

    @keyframes flotar {
      0%, 100% { transform: translate(-50%, -50%) translateY(0); }
      50% { transform: translate(-50%, -50%) translateY(-15px); }
    }

    .container {
      z-index: 1;
      background: #161b22;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 30px rgba(0,0,0,0.5);
      animation: aparecer 1.5s ease;
    }

    @keyframes aparecer {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    h2 {
      text-shadow: 1px 1px 3px black;
      animation: fadeInDown 1s ease-in-out;
    }

    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .list-group-item {
      background-color: #21262d;
      color: #c9d1d9;
      margin-bottom: 10px;
      border: 1px solid #30363d;
      transition: transform 0.3s, background-color 0.3s;
    }

    .list-group-item:hover {
      background-color: #238636;
      color: white;
      transform: scale(1.02);
    }

    .btn-outline-light:hover {
      background-color: #0072ff;
      border-color: #0072ff;
    }
  </style>
</head>
<body>

<div class="container mt-5">
  <h2><i class="bi bi-people-fill"></i> Abogados Disponibles</h2>
  <div class="list-group mt-4">
    <?php foreach ($abogados as $abogado): ?>
      <a href="solicitar_asesoria.php?id_abogado=<?= $abogado['id'] ?>" class="list-group-item list-group-item-action">
        <i class="bi bi-person-circle"></i> <?= $abogado['nombre_completo'] ?> <br>
        <small><i class="bi bi-award-fill"></i> <?= $abogado['especialidad'] ?></small>
      </a>
    <?php endforeach; ?>
  </div>
  <a href="dashboard.php" class="btn btn-outline-light mt-4"><i class="bi bi-house-door"></i> Volver al Panel</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>