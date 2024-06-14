<?php
session_start();

// Comprobar si el usuario está autenticado
$loggedIn = isset($_SESSION['user_id']);
$isAdmin = $loggedIn && $_SESSION['user_rol'] == 'admin';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard del Usuario</title>
    <link rel="stylesheet" href="/appdb/public/css/view_user.css">
</head>
<body>
    <div class="header">
        <img src="/appdb/public/imgs/shop.jpg" alt="Logo" class="logo">
        <h1>Productos Disponibles</h1>
        <nav class="nav">
            <ul>
                <li><a href="/appdb/view/dashboard/view_user.php">Inicio</a></li>
                <li><a href="#">Productos</a></li>
                <li><a href="#">Contacto</a></li>
                <li><a href="#">Carrito</a></li>
                <li><a href="/appdb/view/perfil/perfil.php">Perfil</a></li>
                <?php if (!$loggedIn): ?>
                    <li><a href="/appdb/view/auth.php">Ingresar</a></li>
                <?php else: ?>
                    <?php if ($isAdmin): ?>
                        <li><a href="/appdb/view/dashboard/view_admin.php">Administración</a></li>
                    <?php endif; ?>
                    <li><a href="/appdb/controllers/userController.php?action=logout&redirect=dashboard">Cerrar Sesión</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    <div class="content">
        <div class="product-list">
        <?php 
        $path = realpath(dirname(__FILE__) . '/../product/view_product.php'); 
        if (file_exists($path)) {
            include $path; 
        } else {
            echo 'El archivo no se encontró en la ruta: ' . $path;
        }
        ?>
        </div>
    </div>
</body>
</html>
