<?php

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_productos');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    // Conexión a la base de datos utilizando PDO
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    // Establecer el modo de error de PDO para manejar excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Establecer el modo de recuperación de datos para prevenir inyección SQL
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

//    echo "Conexión a la base de datos exitosa.";
    
} catch (PDOException $e) {
    // Manejar el error de conexión
    die("Error de conexión: " . $e->getMessage());
}
?>
