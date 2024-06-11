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
    <title>Registro de Usuarios</title>
    <link rel="stylesheet" href="/appdb/public/css/auth.css">
</head>
<body>
    <div class="container">
        <h1>Registro de Usuarios</h1>

        <div id="form-register" class="form-content">
            <form action="/appdb/controllers/userController.php?action=register" method="post">
                <label for="register_nombre">Nombre:</label>
                <input type="text" id="register_nombre" name="nombre" required>
                
                <label for="register_apellido">Apellido:</label>
                <input type="text" id="register_apellido" name="apellido" required>
                
                <label for="register_email">Email:</label>
                <input type="email" id="register_email" name="email" required>
                
                <label for="register_password">Contraseña:</label>
                <input type="password" id="register_password" name="password" required>
                
                <label for="register_rol">Rol:</label>
                <select id="register_rol" name="rol" required>
                    <option value="usuario">Usuario</option>
                    <option value="admin">Admin</option>
                </select>
                
                <button type="submit">Registrar</button>
            </form>
        </div>
    </div>
</body>
</html>
