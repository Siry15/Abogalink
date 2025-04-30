<?php
session_start();
require '../db.php';

if (empty($_SESSION['id_usuario'])) {
    header("Location: ../login.php");
    exit;
}

$id_cliente = $_SESSION['id_usuario'];

$stmt = $conexion->prepare("
    SELECT s.id, u.nombre_completo AS abogado, s.estado, s.fecha
    FROM solicitudes s
    JOIN asesorias a ON s.id = a.id_solicitud
    JOIN usuarios u ON a.abogado_id = u.id
    WHERE a.cliente_id = ?
");
$stmt->execute([$id_cliente]);
$solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Solicitudes - AbogaLink</title>
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
            background-color: #161b22;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 25px rgba(0,0,0,0.5);
            z-index: 1;
            animation: fadeIn 1.2s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            text-shadow: 1px 1px 4px black;
        }

        .table-dark {
            border-radius: 8px;
            overflow: hidden;
        }

        .btn-outline-light:hover {
            background-color: #238636;
            color: white;
        }

        .btn-danger:hover {
            background-color: #d7263d;
        }

        .text-success, .text-danger, .text-warning {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2><i class="bi bi-journal-check"></i> Estado de tus Solicitudes</h2>
    <table class="table table-dark table-hover mt-4">
        <thead>
            <tr>
                <th><i class="bi bi-calendar3"></i> Fecha</th>
                <th><i class="bi bi-person"></i> Abogado</th>
                <th><i class="bi bi-info-circle"></i> Estado</th>
                <th><i class="bi bi-gear"></i> Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($solicitudes as $solicitud): ?>
                <tr>
                    <td><?= htmlspecialchars($solicitud['fecha']) ?></td>
                    <td><?= htmlspecialchars($solicitud['abogado']) ?></td>
                    <td>
                        <?php
                        switch ($solicitud['estado']) {
                            case 'aceptada':
                                echo '<span class="text-success"><i class="bi bi-check-circle-fill"></i> Aceptada</span>';
                                break;
                            case 'rechazada':
                                echo '<span class="text-danger"><i class="bi bi-x-circle-fill"></i> Rechazada</span>';
                                break;
                            default:
                                echo '<span class="text-warning"><i class="bi bi-hourglass-split"></i> Pendiente</span>';
                        }
                        ?>
                    </td>
                    <td>
                        <?php if ($solicitud['estado'] === 'pendiente'): ?>
                            <form action="cancelar_solicitud.php" method="POST" onsubmit="return confirm('¿Seguro que quieres cancelar esta solicitud?');">
                                <input type="hidden" name="id_solicitud" value="<?= $solicitud['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Cancelar</button>
                            </form>
                        <?php else: ?>
                            <span class="text-muted"><i class="bi bi-dash-circle"></i> No disponible</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-outline-light mt-3"><i class="bi bi-arrow-left-circle"></i> Volver al Panel</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>