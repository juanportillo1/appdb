<?php
require_once '../config/dbct.php';
require_once '../models/user.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" || isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'register') {
        registerUser();
    } elseif ($action == 'login') {
        loginUser();
    } elseif ($action == 'logout') {
        logoutUser();
    } elseif ($action == 'list') {
        listUsers();
    } elseif ($action == 'delete') {
        deleteUser();
    } elseif ($action == 'update') {
        updateUser();
    }
}

function registerUser() {
    global $pdo;

    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $apellido = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    $rol = filter_input(INPUT_POST, 'rol', FILTER_SANITIZE_STRING);

    if (empty($nombre) || empty($apellido) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password) || empty($rol)) {
        die("Todos los campos son obligatorios y deben ser válidos.");
    }

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email");
    $stmt->execute(['email' => $email]);
    if ($stmt->fetchColumn() > 0) {
        die("El correo electrónico ya está registrado.");
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $user = new User($pdo);

    if ($user->register($nombre, $apellido, $email, $hashedPassword, $rol)) {
        echo "Registro exitoso.";
    } else {
        echo "Error en el registro.";
    }
}

function loginUser() {
    global $pdo;

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password)) {
        die("Email y contraseña son obligatorios.");
    }

    $user = new User($pdo);
    $userData = $user->login($email, $password);

    if ($userData) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = $userData['id_usuario'];
        $_SESSION['user_name'] = $userData['nombre'];
        $_SESSION['user_rol'] = $userData['rol'];

        if ($userData['rol'] == 'admin') {
            header('Location: /appdb/view/dashboard/view_admin.php');
        } else {
            header('Location: /appdb/view/dashboard/view_user.php');
        }
        exit();
    } else {
        header('Location: /appdb/view/auth.php?error=Email o contraseña incorrectos.');
        exit();
    }
}

function logoutUser() {
    session_unset();
    session_destroy();
    header('Location: /appdb/view/dashboard/view_user.php');
    exit();
}

function listUsers() {
    global $pdo;
    $userModel = new User($pdo);
    $users = $userModel->getAll();
    include '../view/user/list_user.php';
}

function updateUser() {
    global $pdo;

    // Obtener los datos del formulario
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $apellido = filter_input(INPUT_POST, 'apellido', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; // No sanitizar para poder verificar si está vacío
    $rol = filter_input(INPUT_POST, 'rol', FILTER_SANITIZE_STRING);

    // Validar los datos
    if (empty($id) || empty($nombre) || empty($apellido) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($rol)) {
        die("Todos los campos son obligatorios y deben ser válidos.");
    }

    // Crear una instancia del modelo User
    $user = new User($pdo);

    // Verificar si el email ya existe y pertenece a otro usuario
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE email = :email AND id_usuario != :id");
    $stmt->execute(['email' => $email, 'id' => $id]);
    if ($stmt->fetchColumn() > 0) {
        die("El correo electrónico ya está registrado por otro usuario.");
    }

    // Preparar los datos para la actualización
    if (empty($password)) {
        $updateData = [
            'id' => $id,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'rol' => $rol,
        ];
    } else {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $updateData = [
            'id' => $id,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'password' => $hashedPassword,
            'rol' => $rol,
        ];
    }

    // Intentar actualizar al usuario
    if ($user->update($updateData)) {
        echo "Usuario actualizado exitosamente.";
    } else {
        echo "Error al actualizar el usuario.";
    }
}

function deleteUser() {
    global $pdo;
    $userId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($userId === null || $userId === false) {
        echo 'ID de usuario inválido.';
        exit();
    }

    $userModel = new User($pdo);
    if ($userModel->delete($userId)) {
        echo 'Usuario eliminado correctamente';
    } else {
        echo 'Error al eliminar el usuario.';
    }
}
?>
