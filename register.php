<?php
require 'db.php';
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nombre = $_POST['nombre'];
  $cedula = $_POST['cedula'];
  $correo = $_POST['correo'];
  $telefono = $_POST['telefono'];
  $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);
  $rol = $_POST['rol'];
  $verificado = ($rol === 'abogado') ? 0 : 1;

  $sql = "INSERT INTO usuarios (nombre_completo, cedula, correo, telefono, clave, rol, verificado) 
          VALUES (?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conexion->prepare($sql);

  try {
    $stmt->execute([$nombre, $cedula, $correo, $telefono, $clave, $rol, $verificado]);
    $mensaje = "¡Registro exitoso! Espera aprobación si eres abogado.";
  } catch (PDOException $e) {
    $mensaje = "Error: " . $e->getMessage();
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro - AbogaLink</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>

  <style>
    html, body {
      margin: 0;
      padding: 0;
      height: 100%;
      background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
      font-family: 'Segoe UI', sans-serif;
      color: white;
    }

    .overlay {
      background: rgba(0, 0, 0, 0.6);
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 100%;
      z-index: -1;
    }

    .wrapper {
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .form-box {
      background: rgba(0, 0, 0, 0.85);
      border-radius: 15px;
      padding: 35px;
      max-width: 600px;
      width: 100%;
      animation: fadeIn 1s ease-in-out;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
    }

    .form-control, .form-select {
      background-color: #99b2fd;
      color: black;
      border: none;
    }

    .form-control:focus, .form-select:focus {
      background-color: rgba(70, 85, 161, 0.95);
      color: white;
      border: 2px solid #dc3545;
    }

    .btn-custom {
      background-color: #dc3545;
      color: white;
      font-weight: bold;
      border: none;
      transition: all 0.3s ease;
    }

    .btn-custom:hover {
      background-color: #c82333;
      transform: scale(1.03);
      box-shadow: 0 0 10px rgba(255, 0, 0, 0.4);
    }

    .alert {
      font-weight: bold;
      text-align: center;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>

<div class="overlay"></div>

<div class="wrapper">
  <div class="form-box">
    <h2 class="text-center mb-4"><i class="fas fa-user-plus me-2"></i>Registro de Usuario</h2>

    <?php if ($mensaje): ?>
      <div class="alert alert-info"><?= $mensaje ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label>Nombre completo</label>
        <input type="text" name="nombre" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Cédula</label>
        <input type="text" name="cedula" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Correo electrónico</label>
        <input type="email" name="correo" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Teléfono</label>
        <input type="text" name="telefono" class="form-control">
      </div>
      <div class="mb-3">
        <label>Contraseña</label>
        <input type="password" name="clave" class="form-control" required>
      </div>
      <div class="mb-3">
        <label>Rol</label>
        <select name="rol" class="form-select" required>
          <option value="cliente">Cliente</option>
          <option value="abogado">Abogado</option>
        </select>
      </div>
      <button type="submit" class="btn btn-custom w-100"><i class="fas fa-user-check me-1"></i>Registrarse</button>
    </form>

    <div class="text-center mt-3">
      <a href="index.php" class="btn btn-outline-light"><i class="fas fa-arrow-left me-1"></i>Volver al inicio</a>
    </div>
  </div>
</div>

</body>
</html>