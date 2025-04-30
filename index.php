<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AbogaLink - Asesoría Legal en Línea</title>

  <!-- Favicon -->
  <link rel="icon" href="logo.png" type="image/png" />

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <style>
    body {
      background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
      color: white;
      font-family: 'Segoe UI', sans-serif;
      scroll-behavior: smooth;
    }

    .navbar {
      background-color: rgba(0, 0, 0, 0.85);
      backdrop-filter: blur(6px);
      transition: background-color 0.4s ease;
    }

    .hero-section {
      background: url('assets/img/legal-hero.jpg') no-repeat center center / cover;
      background-attachment: fixed;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      text-shadow: 2px 2px 5px black;
      position: relative;
    }

    .logo-animated {
      width: 120px;
      animation: zoomFade 2s ease forwards;
    }

    .hero-text {
      background-color: rgba(0, 0, 0, 0.65);
      padding: 2rem;
      border-radius: 15px;
      animation: fadeInUp 1.5s ease-out both;
      display: inline-block;
    }

    .btn-custom {
      margin: 0 10px;
      background-color: #dc3545;
      border: none;
      color: white;
      padding: 10px 20px;
      font-weight: bold;
      border-radius: 30px;
      transition: all 0.3s ease;
    }

    .btn-custom i {
      margin-right: 8px;
    }

    .btn-custom:hover {
      background-color: #bd2130;
      transform: scale(1.05);
      box-shadow: 0 0 10px rgba(255, 0, 0, 0.5);
    }

    .section {
      padding: 3rem 0;
    }

    .card {
      background-color: #1c2b36;
      color: white;
      border: none;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
    }

    footer {
      background-color: #111;
      color: #ccc;
      padding: 1rem;
      text-align: center;
    }

    img.rounded.shadow {
      transition: transform 0.3s ease-in-out;
    }

    img.rounded.shadow:hover {
      transform: scale(1.05);
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(40px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes zoomFade {
      0% {
        opacity: 0;
        transform: scale(0.7);
      }
      100% {
        opacity: 1;
        transform: scale(1);
      }
    }
  </style>
</head>
<body>

  <!-- NAV -->
  <nav class="navbar navbar-expand-lg navbar-dark shadow">
    <div class="container-fluid">
      <span class="navbar-text fs-4 text-white fw-bold">AbogaLink</span>
      <div class="ms-auto">
        <a href="login.php" class="btn btn-custom"><i class="fas fa-sign-in-alt"></i>Iniciar Sesión</a>
        <a href="register.php" class="btn btn-custom"><i class="fas fa-user-plus"></i>Registrarse</a>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero-section">
    <div class="hero-text">
      <img src="logo.png" alt="Logo AbogaLink" class="logo-animated mb-3" />
      <h1 class="display-5">Bienvenido a AbogaLink</h1>
      <p class="lead">Tu asesoría legal confiable, rápida y segura desde cualquier lugar.</p>
    </div>
  </section>

  <!-- MISIÓN, VISIÓN, QUIÉNES SOMOS -->
  <section class="container section text-center">
    <div class="row">
      <div class="col-md-4">
        <div class="card p-4">
          <h4 style="color:#dc3545;">Misión</h4>
          <p>Brindar asesoría legal en línea de calidad, con ética, rapidez y compromiso para garantizar justicia accesible a todos.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-4">
          <h4 style="color:#dc3545;">Visión</h4>
          <p>Ser la plataforma líder en asesoría legal virtual en Latinoamérica, promoviendo el acceso a la justicia desde cualquier dispositivo.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card p-4">
          <h4 style="color:#dc3545;">¿Quiénes Somos?</h4>
          <p>Un equipo de abogados, desarrolladores y visionarios comprometidos con la transformación digital del derecho.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- IMÁGENES TEMÁTICAS -->
  <section class="container section text-center">
    <h3 class="mb-4" style="color:#dc3545;">Nuestra Filosofía Legal</h3>
    <div class="row">
      <div class="col-md-4 mb-3">
        <img src="justicia1.jpg" class="img-fluid rounded shadow" alt="Justicia 1" />
      </div>
      <div class="col-md-4 mb-3">
        <img src="justicia2.webp" class="img-fluid rounded shadow" alt="Justicia 2" />
      </div>
      <div class="col-md-4 mb-3">
        <img src="justicia3.webp" class="img-fluid rounded shadow" alt="Justicia 3" />
      </div>
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    &copy; 2025 AbogaLink | Asesoría Legal en Línea
  </footer>

</body>
