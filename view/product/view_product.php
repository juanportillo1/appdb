<?php
require_once '../../config/dbct.php';
require_once '../../models/product.php';


$productModel = new Product($pdo);
$productos = $productModel->getAllProducts();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="/appdb/public/css/view_product.css">
</head>
<body>
    <div class="content">
        <h1>Lista de Productos</h1>
        <div class="product-list">
            <?php if (empty($productos)): ?>
                <p>No hay productos todavia.</p>
            <?php else: ?>
                <?php foreach ($productos as $producto): ?>
                    <div class="product-item">
                    <img src="/appdb/public/imgs/shop.jpg" alt="Logo" class="logo">
                        <h2><?php echo htmlspecialchars($producto['producto']); ?></h2>
                        <p><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                        <p>Precio: $<?php echo number_format($producto['precio'], 2); ?></p>
                        <button>Agregar al Carrito</button>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

