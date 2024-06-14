<?php
class Product {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function add($nombre, $descripcion, $precio, $cantidad) {
        $stmt = $this->pdo->prepare("INSERT INTO productos (producto, descripcion, precio, cantidad) VALUES (:nombre, :descripcion, :precio, :cantidad)");
        return $stmt->execute([
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'cantidad' => $cantidad
        ]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM productos");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM productos WHERE id_producto = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function update($id, $nombre, $descripcion, $precio, $cantidad) {
        $sql = "UPDATE productos SET producto = :nombre, descripcion = :descripcion, precio = :precio, cantidad = :cantidad WHERE id_producto = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':precio' => $precio,
            ':cantidad' => $cantidad
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM productos WHERE id_producto = ?");
        return $stmt->execute([$id]);
    }

    public function getAllProducts() {
        $stmt = $this->pdo->query('SELECT * FROM productos');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>

