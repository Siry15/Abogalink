<?php
session_start();
require '../db.php';

if (!isset($_SESSION['id'])) {
    die("Acceso denegado. Debes iniciar sesión.");
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_abogado'])) {
    try {
        $idCliente = $_SESSION['id'];
        $idAbogado = $_POST['id_abogado'];
        $descripcion = $_POST['descripcion'];
        $fecha = date('Y-m-d');

        // Insertar en solicitudes
        $stmtSolicitud = $conexion->prepare("INSERT INTO solicitudes (id_cliente, id_abogado, estado, fecha) VALUES (?, ?, 'pendiente', ?)");
        $stmtSolicitud->execute([$idCliente, $idAbogado, $fecha]);
        $idSolicitud = $conexion->lastInsertId();

        // Insertar en asesorías
        $stmtAsesoria = $conexion->prepare("INSERT INTO asesorias (id_solicitud, cliente_id, abogado_id, descripcion, estado, fecha_solicitud) VALUES (?, ?, ?, ?, 'pendiente', ?)");
        $stmtAsesoria->execute([$idSolicitud, $idCliente, $idAbogado, $descripcion, $fecha]);

        $mensaje = "¡Solicitud enviada con éxito!";
    } catch (Exception $e) {
        $mensaje = "Error al procesar la solicitud.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Solicitar Asesoría</title>
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

    h2, h4 {
      text-shadow: 1px 1px 3px black;
      animation: fadeInDown 1s ease-in-out;
    }

    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .form-control {
      background-color: #0d1117;
      color: white;
      border: 1px solid #333;
      transition: border-color 0.3s ease;
    }

    .form-control:focus {
      border-color: #4b9cd3;
      box-shadow: 0 0 0 0.2rem rgba(75, 156, 211, 0.3);
    }

    .btn-light {
      background: linear-gradient(135deg, #00c6ff, #0072ff);
      color: white;
      border: none;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .btn-light:hover {
      transform: scale(1.05);
      box-shadow: 0 0 10px rgba(0,114,255,0.4);
    }

    .btn-outline-light:hover {
      background-color: #0072ff;
      border-color: #0072ff;
    }

    .toast-container {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
    }

    .toast.show {
      animation: slidein 0.5s forwards;
    }

    @keyframes slidein {
      from { transform: translateX(100%); opacity: 0; }
      to { transform: translateX(0); opacity: 1; }
    }
  </style>
</head>
<body>

<?php if (!empty($mensaje)): ?>
  <div class="toast-container">
    <div class="toast align-items-center text-white bg-success border-0 show" role="alert">
      <div class="d-flex">
        <div class="toast-body"><i class="bi bi-check-circle-fill"></i> <?= $mensaje ?></div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  </div>
<?php endif; ?>

<div class="container mt-5">
  <h2><i class="bi bi-journal-text"></i> Solicitar Asesoría</h2>

  <?php if (isset($_GET['id_abogado'])): ?>
    <?php
      $id_abogado = $_GET['id_abogado'];
      $stmt = $conexion->prepare("SELECT nombre_completo FROM usuarios WHERE id = ?");
      $stmt->execute([$id_abogado]);
      $abogado = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <h4 class="mt-4"><i class="bi bi-person-badge"></i> Con <?= $abogado['nombre_completo'] ?></h4>
    <form method="POST" class="mt-3">
      <input type="hidden" name="id_abogado" value="<?= $id_abogado ?>">
      <div class="mb-3">
        <label class="form-label">Motivo de la asesoría</label>
        <textarea name="descripcion" class="form-control" rows="4" required></textarea>
      </div>
      <button type="submit" class="btn btn-light">
        <i class="bi bi-send-check-fill"></i> Enviar solicitud
      </button>
    </form>
  <?php else: ?>
    <p class="mt-3">Espere la respuesta a su solicitud.</p>
  <?php endif; ?>

  <a href="dashboard.php" class="btn btn-outline-light mt-4"><i class="bi bi-house-door"></i> Volver al menú</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>