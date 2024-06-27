<?php

class Carro {
    public $marca;
    public $modelo;

    // Constructor de la clase Carro
    public function __construct() {
 


    }
}

// Crear una nueva instancia de la clase Carro
$miCarro = new Carro();
$miCarro->marca = "Toyota";
$miCarro->modelo = "Corolla";


$miCarro2 = new Carro("suzuki", "alto");
