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
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="/appdb/public/css/add_product.css">
</head>
<body>
    <div class="container">
        <h2>Agregar Producto</h2>
        <form id="add-product-form" action="/appdb/controllers/productController.php?action=add" method="POST">
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" id="nombre" name="nombre" required>
            <br>
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" required></textarea>
            <br>
            <label for="precio">Precio:</label>
            <input type="text" id="precio" name="precio" required>
            <br>
            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" required>
            <br>
            <button type="submit">Agregar Producto</button>
        </form>
    </div>

    <script src="/appdb/public/js/view_admin.js"></script>
</body>
</html>
