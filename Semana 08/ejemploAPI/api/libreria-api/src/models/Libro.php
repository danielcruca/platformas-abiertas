<?php
require_once '../src/db/Database.php';

class Libro {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function all() {
        $stmt = $this->db->query("SELECT * FROM libros");
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM libros WHERE id_libro = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO libros (titulo, id_autor, precio, cantidad_stock) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data['titulo'], $data['id_autor'], $data['precio'], $data['cantidad_stock']]);
        return ['id' => $this->db->lastInsertId()];
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE libros SET titulo = ?, id_autor = ?, precio = ?, cantidad_stock = ? WHERE id_libro = ?");
        $stmt->execute([$data['titulo'], $data['id_autor'], $data['precio'], $data['cantidad_stock'], $id]);
        return ['success' => true];
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM libros WHERE id_libro = ?");
        $stmt->execute([$id]);
        return ['success' => true];
    }
}
?>
