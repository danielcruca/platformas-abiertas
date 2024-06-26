<?php

class Persona {
    // Propiedades
    public $nombre;
    public $edad;

    public $pais;

    // Constructor
    // D
    public function __construct($nombre, $edad , $pais) {
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->pais = $pais;
    }

    // Método para mostrar información de la persona
    public function mostrarInformacion() { // METODO
        echo "Nombre: " . $this->nombre . ", Edad: " . $this->edad . " años<br>";
    }
}

// Crear una instancia de la clase Persona
$persona1 = new Persona("Juan", 30, "CR");
$persona2 = new Persona("Jairo", 24, "Portugal");
$persona3 = new Persona("Genesis", 40, "Espanna");
$persona4 = new Persona("Messi", 37 , "Francia");


// Acceder a las propiedades y métodos de la instancia
$persona1->mostrarInformacion();
$persona2->mostrarInformacion();
$persona3->mostrarInformacion();
$persona4->mostrarInformacion();

