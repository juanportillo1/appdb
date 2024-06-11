<?php
require_once '../../config/dbct.php';
require_once '../../models/product.php';

session_start();

$productModel = new Product($pdo);

// Verificar si el usuario está autenticado y es un administrador
if (!isset($_SESSION['user_id']) || $_SESSION['user_rol'] != 'admin') {
    header('Location: /appdb/view/dashboard/view_user.php');
    exit();
}

// Obtener el ID del producto
$productId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$productId) {
    die('ID de producto inválido.');
}

// Obtener los datos del producto
$product = $productModel->getById($productId);
if (!$product) {
    die('Producto no encontrado.');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizar Producto</title>
    <link rel="stylesheet" href="/appdb/public/css/update_product.css">
</head>
<body>
    <div class="container">
        <h2>Actualizar Producto</h2>

        <form id="update-product-form" action="/appdb/controllers/productController.php?action=update&id=<?php echo $product['id_producto']; ?>" method="POST">
            <input type="hidden" name="id" value="<?php echo $product['id_producto']; ?>">

            <label for="update-product-name">Nombre:</label>
            <input type="text" id="update-product-name" name="nombre" value="<?php echo htmlspecialchars($product['producto']); ?>" required>

            <label for="update-product-description">Descripción:</label>
            <textarea id="update-product-description" name="descripcion" required><?php echo htmlspecialchars($product['descripcion']); ?></textarea>

            <label for="update-product-price">Precio:</label>
            <input type="number" id="update-product-price" name="precio" value="<?php echo htmlspecialchars($product['precio']); ?>" required step="0.01">

            <label for="update-product-quantity">Cantidad:</label>
            <input type="number" id="update-product-quantity" name="cantidad" value="<?php echo htmlspecialchars($product['cantidad']); ?>" required>

            <button type="submit">Actualizar Producto</button>
        </form>
    </div>

    <script src="/appdb/public/js/view_admin.js"></script>
</body>
</html>
