﻿<?php
require_once '../src/models/Libro.php';

class LibrosController {
    private $model;

    public function __construct() {
        $this->model = new Libro();
    }

    public function get($id = null) {
        if ($id) {
            echo json_encode($this->model->find($id));
        } else {
            echo json_encode($this->model->all());
        }
    }

    public function post() {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($this->model->create($data));
    }

    public function put($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($this->model->update($id, $data));
    }

    public function delete($id) {
        echo json_encode($this->model->delete($id));
    }
}
?>
