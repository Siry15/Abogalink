<?php
session_start();
if (!isset($_SESSION['id']) || $_SESSION['rol'] !== 'cliente') {
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel del Cliente - AbogaLink</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      position: relative;
      background-color: #0d1117;
      color: white;
      overflow-x: hidden;
      z-index: 1;
    }

    body::before {
      content: "";
      position: fixed;
      top: 50%;
      left: 50%;
      width: 350px;
      height: 350px;
      background-image: url('../assets/logo.png');
      background-repeat: no-repeat;
      background-size: contain;
      background-position: center;
      transform: translate(-50%, -50%);
      opacity: 0.06;
      z-index: 0;
      pointer-events: none;
      filter: drop-shadow(0 0 10px rgba(255,255,255,0.1));
      animation: flotar 10s ease-in-out infinite;
    }

    @keyframes flotar {
      0% { transform: translate(-50%, -50%) translateY(0px); }
      50% { transform: translate(-50%, -50%) translateY(-15px); }
      100% { transform: translate(-50%, -50%) translateY(0px); }
    }

    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 240px;
      height: 100vh;
      background-color: #121b2c;
      padding-top: 80px;
      transform: translateX(-260px);
      transition: transform 0.4s ease;
      z-index: 1000;
    }

    .sidebar.active {
      transform: translateX(0);
    }

    .sidebar .btn {
      margin-bottom: 12px;
      text-align: left;
      color: white;
      background-color: transparent;
      border: none;
      font-size: 16px;
      width: 100%;
    }

    .sidebar .btn i {
      margin-right: 10px;
    }

    .toggle-btn {
      position: fixed;
      top: 20px;
      left: 20px;
      background-color: #1e3a5f;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 8px;
      z-index: 1100;
      transition: background-color 0.3s ease;
    }

    .toggle-btn:hover {
      background-color: #163050;
    }

    .logout-btn {
      position: fixed;
      top: 20px;
      right: 20px;
      background: linear-gradient(90deg, #ff4b2b, #ff416c);
      color: white;
      border: none;
      padding: 10px 18px;
      border-radius: 8px;
      font-weight: bold;
      display: flex;
      align-items: center;
      gap: 8px;
      text-decoration: none;
      box-shadow: 0 4px 15px rgba(255, 65, 108, 0.3);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      z-index: 1100;
    }

    .logout-btn:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 18px rgba(255, 65, 108, 0.5);
    }

    .main-content {
      margin-left: 0;
      padding: 80px 20px 20px 20px;
      text-align: center;
      transition: margin-left 0.4s ease;
      position: relative;
      z-index: 1;
    }

    .sidebar.active ~ .main-content {
      margin-left: 260px;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 200px;
        transform: translateX(-220px);
      }

      .sidebar.active ~ .main-content {
        margin-left: 0;
      }
    }

    /* Nueva animación para el contenido */
    .fade-in {
      animation: fadeIn 0.8s ease-out;
    }

    @keyframes fadeIn {
      0% { opacity: 0; transform: translateY(30px); }
      100% { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

<!-- Botón de menú -->
<button class="toggle-btn" onclick="toggleSidebar()">
  <i class="bi bi-list"></i> Menú
</button>

<!-- Botón de cerrar sesión -->
<a href="../logout.php" class="logout-btn">
  <i class="bi bi-box-arrow-right"></i> Salir
</a>

<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <a href="ver_abogados.php" class="btn"><i class="bi bi-person-lines-fill"></i> Solicitar Asesoría</a>
  <a href="ver_solicitudes.php" class="btn"><i class="bi bi-card-list"></i> Mis Solicitudes</a>
  <a href="citas.php" class="btn"><i class="bi bi-calendar-event"></i> Ver Citas</a>
  <a href="normas.php" class="btn"><i class="bi bi-journal-text"></i> Normas</a>
  <a href="documentos.php" class="btn"><i class="bi bi-folder2-open"></i> Documentos</a>
  <a href="chat.php" class="btn"><i class="bi bi-chat-dots"></i> Chat</a>
  <a href="videollamada.php" class="btn"><i class="bi bi-camera-video"></i> Videollamada</a>
  <a href="ver_caso.php" class="btn"><i class="bi bi-briefcase"></i> Ver Caso</a>
</div>

<!-- Contenido principal -->
<div class="main-content fade-in" id="mainContent">
  <h1>Bienvenido, <?= $_SESSION['nombre'] ?></h1>
  <p>Estás en tu panel de cliente de AbogaLink.</p>
</div>

<script>
  function toggleSidebar() {
    document.getElementById('sidebar').classList.toggle('active');
    document.getElementById('mainContent').classList.toggle('shifted');
  }
</script>

</body>
</html>