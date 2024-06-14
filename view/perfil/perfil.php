<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: /appdb/view/auth.php');
    exit();
}

// Incluir archivo de configuración de la base de datos y la clase User
require_once '../../config/dbct.php';
require_once '../../models/user.php';

// Crear una instancia de la clase User pasándole tu conexión PDO
$userModel = new User($pdo); // Suponiendo que $pdo es tu instancia de PDO

// Obtener los datos del usuario basado en $_SESSION['user_id']
$userData = $userModel->getById($_SESSION['user_id']);

// Verificar si se encontró la información del usuario
if (!$userData) {
    die("Error: No se encontró información del usuario.");
}

// Extraer los datos del usuario
$nombre = $userData['nombre'];
$apellido = $userData['apellido'];
$email = $userData['email'];
$rol = $userData['rol']; // Ajusta según la estructura real de tu base de datos

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <!-- Estilos CSS -->
    <link rel="stylesheet" href="/appdb/public/css/perfil.css">
</head>
<body>
    <div class="container">
        <div class="avatar">
            <img src="/appdb/public/imgs/icon/avatar.png" alt="Avatar">
        </div>
        <div class="user-details">
            <h2><?php echo htmlspecialchars($nombre . ' ' . $apellido); ?></h2>
            <p>Correo Electrónico: <?php echo htmlspecialchars($email); ?></p>
            <p class="role">Rol: <?php echo htmlspecialchars(ucfirst($rol)); ?></p>
        </div>
    </div>
</body>
</html>
