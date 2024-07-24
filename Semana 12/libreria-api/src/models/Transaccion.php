<?php
require_once '../src/db/Database.php';

class Transaccion {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function all() {
        $stmt = $this->db->query("SELECT * FROM transacciones_ventas");
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM transacciones_ventas WHERE id_venta = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO transacciones_ventas (id_libro, fecha_venta, cantidad, total) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data['id_libro'], $data['fecha_venta'], $data['cantidad'], $data['total']]);
        return ['id' => $this->db->lastInsertId()];
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE transacciones_ventas SET id_libro = ?, fecha_venta = ?, cantidad = ?, total = ? WHERE id_venta = ?");
        $stmt->execute([$data['id_libro'], $data['fecha_venta'], $data['cantidad'], $data['total'], $id]);
        return ['success' => true];
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM transacciones_ventas WHERE id_venta = ?");
        $stmt->execute([$id]);
        return ['success' => true];
    }
}
?>
