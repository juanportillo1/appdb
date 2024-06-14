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
    <style>
        .menu-item {
            display: flex;
            align-items: center;
        }
        .menu-item img {
            margin-right: 8px; /* Espacio entre el icono y el texto */
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>Logo</h2>
        
        <ul>
            <li><a href="/appdb/view/dashboard/view_user.php">
                <div class="menu-item">
                    <img src="/appdb/public/imgs/icon/user-interface.png" height="25" width="25"/>
                    <span>Inicio Usuario</span>
                </div>
            </a></li>
            <li><a href="/appdb/view/dashboard/view_admin.php">
                <div class="menu-item">
                    <img src="/appdb/public/imgs/icon/administrador.png" height="25" width="25"/>
                    <span>Inicio Admin</span>
                </div>
            </a></li>
            <li>
                <a href="#" onclick="toggleSubmenu('product')">
                    <div class="menu-item">
                        <img src="/appdb/public/imgs/icon/producto.png" height="25" width="25"/>
                        <span>Productos</span>
                    </div>
                </a>
                <ul id="product" class="submenu">
                    <li><a href="/appdb/view/product/add_product.php" onclick="loadContent('/appdb/view/product/add_product.php')">
                        <div class="menu-item">
                            <img src="/appdb/public/imgs/icon/agregar-producto.png" height="25" width="25"/>
                            <span>Agregar Producto</span>
                        </div>
                    </a></li>
                    <li><a href="/appdb/view/product/list_product.php" onclick="loadContent('/appdb/view/product/list_product.php')">
                        <div class="menu-item">
                            <img src="/appdb/public/imgs/icon/ver-producto.png" height="25" width="25"/>
                            <span>Ver Productos</span>
                        </div>
                    </a></li>
                </ul>
            </li>
            <li>
                <a href="#" onclick="toggleSubmenu('user')">
                    <div class="menu-item">
                        <img src="/appdb/public/imgs/icon/agregar-usuario.png" height="25" width="25"/>
                        <span>Usuarios</span>
                    </div>
                </a>
                <ul id="user" class="submenu">
                    <li><a href="/appdb/view/user/add_user.php" onclick="loadContent('/appdb/view/user/add_user.php')">
                        <div class="menu-item">
                            <img src="/appdb/public/imgs/icon/agregar-usuarios.png" height="25" width="25"/>
                            <span>Agregar Usuario</span>
                        </div>
                    </a></li>
                    <li><a href="/appdb/view/user/list_user.php" onclick="loadContent('/appdb/view/user/list_user.php')">
                        <div class="menu-item">
                            <img src="/appdb/public/imgs/icon/ver-usuarios.png" height="25" width="25"/>
                            <span>Ver Usuarios</span>
                        </div>
                    </a></li>
                </ul>
            </li>
            <li>
                <a style="cursor: pointer;" onclick="loadContent('/appdb/view/perfil/perfil.php')">
                    <div class="menu-item">
                        <img src="/appdb/public/imgs/icon/administrador-perfil.png" height="25" width="25"/>
                        <span>Perfil Admin</span>
                    </div>
                </a>
                <ul id="admin" class="submenu">
                    <!-- Añadir opciones del perfil del administrador aquí si es necesario -->
                </ul>
            </li>
        </ul>
        
        <ul>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <li><a href="/appdb/view/auth.php">Ingresar</a></li>
            <?php else: ?>
                <li><a href="/appdb/controllers/userController.php?action=logout">
                    <div class="menu-item">
                        <img src="/appdb/public/imgs/icon/cerrar-sesion.png" height="25" width="25"/>
                        <span>Cerrar Sesión</span>
                    </div>
                </a></li>
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
