<?php
session_start();
require 'db.php';
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $correo = $_POST['correo'] ?? '';
  $clave = $_POST['clave'] ?? '';

  $sql = "SELECT * FROM usuarios WHERE correo = ?";
  $stmt = $conexion->prepare($sql);
  $stmt->execute([$correo]);
  $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

  if (is_array($usuario) && password_verify($clave, $usuario['clave'])) {
    if ($usuario['rol'] === 'admin') {
      $_SESSION['id'] = $usuario['id'];
      $_SESSION['nombre'] = $usuario['nombre_completo'];
      $_SESSION['rol'] = $usuario['rol'];
      header("Location: admin/panel.php");
      exit;
    } elseif ($usuario['estado'] !== 'activo') {
      $mensaje = "Usuario inhabilitado.";
    } elseif ($usuario['rol'] === 'abogado' && !$usuario['verificado']) {
      $mensaje = "Tu cuenta de abogado aún no ha sido verificada.";
    } else {
      $_SESSION['id'] = $usuario['id'];
      $_SESSION['nombre'] = $usuario['nombre_completo'];
      $_SESSION['rol'] = $usuario['rol'];
      $_SESSION['id_usuario'] = $usuario['id'];

      switch ($usuario['rol']) {
        case 'cliente':
          header("Location: cliente/dashboard.php");
          break;
        case 'abogado':
          header("Location: abogado/dashboard.php");
          break;
      }
      exit;
    }
  } else {
    $mensaje = "Credenciales incorrectas.";
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login - AbogaLink</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Estilo personalizado -->
  <style>
    body {
      margin: 0;
      background: url('logo.png') no-repeat center center fixed;
      background-size: cover;
      height: 100vh;
      color: white;
      font-family: 'Segoe UI', sans-serif;
      animation: fadeInBody 2s ease-in;
    }

    .overlay {
      background-color: rgba(0, 0, 0, 0.6);
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      z-index: -1;
    }

    @keyframes fadeInBody {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes slideDown {
      from { transform: translateY(-50px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    .container {
      padding-top: 15vh;
      animation: slideDown 1s ease-out;
    }

    .login-card {
      background-color: rgba(15, 15, 30, 0.9);
      padding: 2rem;
      border-radius: 15px;
      box-shadow: 0 0 25px rgba(255, 0, 0, 0.4);
      transition: all 0.5s ease;
    }

    h2 {
      text-shadow: 2px 2px 5px #000;
      font-weight: bold;
      color: #ff0033;
    }

    .form-control, .btn {
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #ff0033;
      box-shadow: 0 0 10px #ff0033;
    }

    .btn-login {
      background-color: #001f3f;
      color: #fff;
      font-weight: bold;
      border: none;
    }

    .btn-login:hover {
      background-color: #ff0033;
      color: #fff;
    }

    .btn-outline-light:hover {
      background-color: #fff;
      color: #000;
    }

    label {
      color: #ddd;
      font-weight: 500;
    }

    .form-icon {
      position: absolute;
      left: 15px;
      top: 10px;
      color: #aaa;
    }

    .input-group .form-control {
      padding-left: 2.5rem;
    }

    .alert {
      background-color: rgba(255, 193, 7, 0.8);
      border: none;
      color: #000;
    }

    @media (max-width: 768px) {
      .container {
        padding-top: 10vh;
      }
    }
  </style>
</head>
<body>

  <div class="overlay"></div>

  <div class="container">
    <h2 class="text-center mb-4">Bienvenido a <span style="color:white;">Aboga</span><strong style="color:red;">Link</strong></h2>

    <?php if ($mensaje): ?>
      <div class="alert text-center"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>

    <form method="POST" class="login-card mx-auto" style="max-width: 400px;">
      <div class="mb-3 position-relative">
        <label for="correo">Correo</label>
        <div class="input-group">
          <span class="form-icon"><i class="bi bi-envelope-fill"></i></span>
          <input type="email" name="correo" class="form-control" required>
        </div>
      </div>

      <div class="mb-4 position-relative">
        <label for="clave">Contraseña</label>
        <div class="input-group">
          <span class="form-icon"><i class="bi bi-lock-fill"></i></span>
          <input type="password" name="clave" class="form-control" required>
        </div>
      </div>

      <button type="submit" class="btn btn-login w-100">Iniciar Sesión</button>
    </form>

    <div class="text-center mt-3">
      <a href="index.php" class="btn btn-outline-light"><i class="bi bi-arrow-left-circle"></i> Volver al inicio</a>
    </div>
  </div>

</body>
</html>