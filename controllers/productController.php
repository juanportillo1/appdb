<?php

require_once '../config/dbct.php';
require_once '../models/product.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($action == 'add') {
            addProduct();
        } elseif ($action == 'update') {
            updateProduct();
        } elseif ($action == 'delete') {
            deleteProduct();
        }
    } elseif ($_SERVER["REQUEST_METHOD"] == "GET" && $action == 'list') {
        listProduct();
    }
}

function addProduct() {
    global $pdo;

    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
    $precio = filter_input(INPUT_POST, 'precio', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_SANITIZE_NUMBER_INT);

    if (empty($nombre) || empty($descripcion) || $precio === false || $cantidad === false) {
        echo "Todos los campos son obligatorios y deben ser válidos.";
        exit();
    }

    $product = new Product($pdo);

    if ($product->add($nombre, $descripcion, $precio, $cantidad)) {
        echo 'Producto agregado correctamente';
        exit();
    } else {
        echo "Error al agregar el producto.";
        exit();
    }
}

function listProduct() {
    global $pdo;

    $product = new Product($pdo);
    $products = $product->getAll();

    include '../view/product/list_product.php';
}

function updateProduct() {
    global $pdo;

    $productId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING);
    $precio = filter_input(INPUT_POST, 'precio', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $cantidad = filter_input(INPUT_POST, 'cantidad', FILTER_SANITIZE_NUMBER_INT);

    if ($productId === null || $nombre === null || $descripcion === null || $precio === false || $cantidad === false) {
        echo 'Error: Datos inválidos.';
        exit();
    }

    $product = new Product($pdo);

    if ($product->update($productId, $nombre, $descripcion, $precio, $cantidad)) {
        echo 'Producto actualizado correctamente';
    } else {
        echo 'Error al actualizar el producto.';
    }
    exit();
}

function deleteProduct() {
    global $pdo;

    $productId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($productId === null) {
        echo 'Error: ID de producto inválido.';
        exit();
    }

    $product = new Product($pdo);

    if ($product->delete($productId)) {
        echo 'Producto eliminado correctamente';
        exit();
    } else {
        echo 'Error al eliminar el producto.';
        exit();
    }
}
?>
