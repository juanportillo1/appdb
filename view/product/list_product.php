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

// Obtener todos los productos
$products = $productModel->getAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver Productos</title>
    <link rel="stylesheet" href="/appdb/public/css/list_product.css">
</head>
<body>
    <div class="tablecontainer" id="product-table-container">
        <h2>Lista de Productos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($product['id_producto']); ?></td>
                            <td><?php echo htmlspecialchars($product['producto']); ?></td>
                            <td><?php echo htmlspecialchars($product['descripcion']); ?></td>
                            <td><?php echo htmlspecialchars($product['precio']); ?></td>
                            <td><?php echo htmlspecialchars($product['cantidad']); ?></td>
                            <td>
                                <div class="button-container">
                                    <button class="update-button" data-id="<?php echo $product['id_producto']; ?>">Actualizar</button>
                                    <button class="delete-button" data-id="<?php echo $product['id_producto']; ?>">Eliminar</button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No hay productos disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="/appdb/public/js/view_admin.js"></script>
</body>
</html>
