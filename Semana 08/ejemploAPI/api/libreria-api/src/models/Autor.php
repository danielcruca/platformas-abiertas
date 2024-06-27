<?php
require_once '../src/db/Database.php';

class Autor {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function all() {
        $stmt = $this->db->query("SELECT * FROM autores");
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM autores WHERE id_autor = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO autores (nombre, apellido, nacionalidad) VALUES (?, ?, ?)");
        $stmt->execute([$data['nombre'], $data['apellido'], $data['nacionalidad']]);
        return ['id' => $this->db->lastInsertId()];
    }

    public function update($id, $data) {
        $sql = "UPDATE autores SET";
        $params = [];
    
        // Construir dinámicamente la consulta y los parámetros según los datos proporcionados
        if (isset($data['nombre'])) {
            $sql .= " nombre = ?,";
            $params[] = $data['nombre'];
        }
        if (isset($data['apellido'])) {
            $sql .= " apellido = ?,";
            $params[] = $data['apellido'];
        }
        if (isset($data['nacionalidad'])) {
            $sql .= " nacionalidad = ?,";
            $params[] = $data['nacionalidad'];
        }
    
        // Eliminar la última coma y completar la consulta
        $sql = rtrim($sql, ",");
        $sql .= " WHERE id_autor = ?";
        $params[] = $id;
    
        // Ejecutar la consulta
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return ['success' => true];
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM autores WHERE id_autor = ?");
        
        $stmt->execute([$id]);
        return ['success' => true];
    }
}
?>
