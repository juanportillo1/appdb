<?php
session_start();

// Verificar si el usuario está autenticado y es un administrador
if (!isset($_SESSION['user_id']) || $_SESSION['user_rol'] != 'admin') {
    header('Location: /appdb/view/dashboard/view_user.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="/appdb/public/css/view_admin.css">
</head>
<body>
    <div class="sidebar">
        <h2>Logo</h2>
        
        <ul>
            <li><a href="/appdb/view/dashboard/view_user.php">Inicio Usuario</a></li>
            <li><a href="/appdb/view/dashboard/view_admin.php">Inicio Admin</a></li>
            <li>
                <a href="#" onclick="toggleSubmenu('product')">Productos</a>
                <ul id="product" class="submenu">
                    <li><a href="/appdb/view/product/add_product.php" onclick="loadContent('/appdb/view/product/add_product.php')">Agregar Producto</a></li>
                    <li><a href="/appdb/view/product/list_product.php" onclick="loadContent('/appdb/view/product/list_product.php')">Ver Productos</a></li>
                </ul>
            </li>
            <li>
                <a href="#" onclick="toggleSubmenu('user')">Usuarios</a>
                <ul id="user" class="submenu">
                    <li><a href="/appdb/view/user/add_user.php" onclick="loadContent('/appdb/view/user/add_user.php')">Agregar Usuario</a></li>
                    <li><a href="/appdb/view/user/list_user.php" onclick="loadContent('/appdb/view/user/list_user.php')">Ver usuarios</a></li>                
                </ul>
            </li>
            <li>
                <a href="#" onclick="toggleSubmenu('admin')">Perfil Admin</a>
                <ul id="admin" class="submenu">
                    <!-- Añadir opciones del perfil del administrador aquí si es necesario -->
                </ul>
            </li>
        </ul>
        <ul style="list-style-type: none; padding: 0; margin-top: 20px;">
            <?php if (!isset($_SESSION['user_id'])): ?>
                <li><a href="/appdb/view/auth.php">Ingresar</a></li>
            <?php else: ?>
                <li><a href="/appdb/controllers/userController.php?action=logout">Cerrar Sesión</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="content" id="main-content">
    <?php 
        $path = realpath(dirname(__FILE__) . '/../product/view_product.php'); 
        if (file_exists($path)) {
            include $path; 
        } else {
            echo 'El archivo no se encontró en la ruta: ' . $path;
        }
        ?>
    </div>

    <script src="/appdb/public/js/view_admin.js"></script>
</body>
</html>
