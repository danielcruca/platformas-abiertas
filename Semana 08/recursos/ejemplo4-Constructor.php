<?php

class Carro {
    private $marca;
    private $modelo;

    // Constructor de la clase Carro
    public function __construct($marca, $modelo) {
        $this->marca = $marca;
        $this->modelo = $modelo;
    }
}

// Crear una nueva instancia de la clase Carro
$miCarro = new Carro("Toyota", "Corolla");
$miCarro2 = new Carro("suzuki", "alto");
