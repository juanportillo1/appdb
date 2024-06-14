<?php
require_once '../../config/dbct.php';
require_once '../../models/user.php';

session_start();

$userModel = new User($pdo);

// Verificar si el usuario está autenticado y es un administrador
if (!isset($_SESSION['user_id']) || $_SESSION['user_rol'] != 'admin') {
    header('Location: /appdb/view/dashboard/view_user.php');
    exit();
}

if (!isset($_GET['id'])) {
    echo "ID de usuario no proporcionado.";
    exit();
}

$user_id = $_GET['id'];
$user = $userModel->getById($user_id);

if (!$user) {
    echo "Usuario no encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Usuario</title>
    <link rel="stylesheet" href="/appdb/public/css/auth.css">
</head>
<body>
    <div class="container">
        <h1>Actualizar Usuario</h1>

        <div id="form-register" class="form-content">
            <form id="update-user-form" action="/appdb/controllers/userController.php?action=update" method="post">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id_usuario']); ?>">

                <label for="register_nombre">Nombre:</label>
                <input type="text" id="register_nombre" name="nombre" value="<?php echo htmlspecialchars($user['nombre']); ?>" required>

                <label for="register_apellido">Apellido:</label>
                <input type="text" id="register_apellido" name="apellido" value="<?php echo htmlspecialchars($user['apellido']); ?>" required>

                <label for="register_email">Email:</label>
                <input type="email" id="register_email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                <label for="register_password">Contraseña:</label>
                <input type="password" id="register_password" name="password" placeholder="Dejar en blanco para mantener la misma">

                <label for="register_rol">Rol:</label>
                <select id="register_rol" name="rol" required>
                    <option value="admin" <?php echo $user['rol'] == 'admin' ? 'selected' : ''; ?>>Administrador</option>
                    <option value="user" <?php echo $user['rol'] == 'user' ? 'selected' : ''; ?>>Usuario</option>
                </select>

                <input type="submit" value="Actualizar Usuario">
            </form>
        </div>
    </div>

    <script src="/appdb/public/js/view_admin.js"></script>
</body>
</html>
