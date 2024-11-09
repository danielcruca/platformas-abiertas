<?php
require_once '../src/db/Database.php';

class Libros {

    private $db;

    public function __construct(){
        $this->db = new Database();
    }


    public function getAll(){

        $consulta = $this->db->connect()->query("
                SELECT 
                libros.id_libro,
                libros.titulo,
                libros.precio,
                libros.cantidad_stock,
                libros.id_autor,
                CONCAT(autores.nombre, ' ', autores.apellido) AS autor
            FROM 
                        libros
            JOIN 
                autores
            ON 
                libros.id_autor = autores.id_autor;
        ");
        return $consulta->fetchAll();
    }

    public function getById($id){
        $consulta = $this->db->connect()->prepare(
            " SELECT * FROM libros WHERE id_libro = ?");

        $consulta->execute(params: [$id]);
        return $consulta->fetch();
    }


    public function create($data){
        $consulta = $this->db->connect()->prepare(
            "INSERT INTO libros (titulo, id_autor, precio, cantidad_stock) VALUES (?, ?, ?, ?) ");
        $consulta->execute([$data['titulo'],$data['id_autor'],$data['precio'], $data['cantidad_stock']]);
            return $this->db->connect()->lastInsertId();

    }


    public function delete($id){
        $consulta = $this->db->connect()->prepare(
            "DELETE FROM libros WHERE id_libro = ? ");
        $consulta->execute([$id]);
         return $consulta->rowCount();

       // return   ['success' => true];
    }

    public function update($id, $data){
        $consulta = $this->db->connect()->prepare(
            "UPDATE libros SET titulo = ?, id_autor = ?, precio = ?, cantidad_stock = ? WHERE id_libro = ? ");
        $consulta->execute([$data['titulo'],$data['id_autor'],$data['precio'], $data['cantidad_stock'],$id]);
        return $consulta->rowCount();
    }

    public function UpdateTitulo($id, $data){
        $consulta = $this->db->connect()->prepare(
            "UPDATE libros SET titulo = ? WHERE id_libro = ? ");
        $consulta->execute([$data['titulo'], $id]);
        return $consulta->rowCount();
    }
}