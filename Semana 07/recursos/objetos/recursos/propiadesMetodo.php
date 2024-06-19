<?php

class Persona {
    // Propiedades
    public $nombre;
    public $edad;

    // Constructor
    public function __construct($nombre, $edad) {
        $this->nombre = $nombre;
        $this->edad = $edad;
    }

    // Método para mostrar información de la persona
    public function mostrarInformacion() {
        echo "Nombre: " . $this->nombre . ", Edad: " . $this->edad . " años";
    }
}

// Crear una instancia de la clase Persona
$persona1 = new Persona("Juan", 30);

// Acceder a las propiedades y métodos de la instancia
$persona1->mostrarInformacion();

