<?php
$clave = "1234"; // Cambia aquí por la contraseña que TÚ quieras
$hash = password_hash($clave, PASSWORD_DEFAULT);
echo "Hash: " . $hash;