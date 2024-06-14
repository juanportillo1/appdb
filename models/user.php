<?php
// models/User.php

class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register($nombre, $apellido, $email, $password, $rol) {
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nombre, apellido, email, password, rol) VALUES (:nombre, :apellido, :email, :password, :rol)");
        return $stmt->execute([
            'nombre' => $nombre,
            'apellido' => $apellido,
            'email' => $email,
            'password' => $password,
            'rol' => $rol
        ]);
    }

    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }

        return false;
    }

    public function getAll() {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id_usuario = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function update($data) {
        $fields = [
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'rol' => $data['rol'],
            'id' => $data['id']
        ];
    
        if (isset($data['password'])) {
            $fields['password'] = $data['password'];
            $sql = "UPDATE usuarios SET nombre = :nombre, apellido = :apellido, email = :email, password = :password, rol = :rol WHERE id_usuario = :id";
        } else {
            $sql = "UPDATE usuarios SET nombre = :nombre, apellido = :apellido, email = :email, rol = :rol WHERE id_usuario = :id";
        }
    
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($fields);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id_usuario = :id");
        return $stmt->execute(['id' => $id]);
    }

}
?>
