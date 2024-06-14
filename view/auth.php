<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login y Registro de Usuarios</title>
    <link rel="stylesheet" href="/appdb/public/css/auth.css">
</head>
<body>
    <div class="container">
        <h1>Login y Registro de Usuarios</h1>
        <?php if (isset($_GET['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
        <?php if (isset($_GET['success'])): ?>
            <p class="success"><?php echo htmlspecialchars($_GET['success']); ?></p>
        <?php endif; ?>
        <div class="tab-buttons">
            <button id="login-btn" class="tab-button">Login</button>
            <button id="register-btn" class="tab-button">Registro</button>
        </div>
        
        <div id="login-form" class="form-container">
            <form action="/appdb/controllers/userController.php?action=login" method="post">
                <label for="login_email">Email:</label>
                <input type="email" id="login_email" name="email" required>
                
                <label for="login_password">Contraseña:</label>
                <input type="password" id="login_password" name="password" required>
                
                <button type="submit">Login</button>
            </form>
        </div>
        
        <div id="register-form" class="form-container" style="display:none;">
            <form action="/appdb/controllers/userController.php?action=register" method="post">
                <label for="register_nombre">Nombre:</label>
                <input type="text" id="register_nombre" name="nombre" required>
                
                <label for="register_apellido">Apellido:</label>
                <input type="text" id="register_apellido" name="apellido" required>
                
                <label for="register_email">Email:</label>
                <input type="email" id="register_email" name="email" required>
                
                <label for="register_password">Contraseña:</label>
                <input type="password" id="register_password" name="password" required>

                <label style="color: red;">mostrar solo en administrador</label>
                <label for="register_rol">Rol:</label>
                <select id="register_rol" name="rol" required>
                    <option value="usuario">Usuario</option>
                    <option value="admin">Admin</option>
                </select>
                
                <button type="submit">Registrar</button>
            </form>
        </div>
    </div>

    <script src="/appdb/public/js/auth.js"></script>
</body>
</html>
