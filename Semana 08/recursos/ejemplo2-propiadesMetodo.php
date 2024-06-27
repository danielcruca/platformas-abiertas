<?php

class Persona {
    // Propiedades
    public $nombre;
    public $edad;

    public $pais;

    public $apellido;

    // Constructor
    // D
    public function __construct($nombre, $edad , $pais) {
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->pais = $pais;

        echo "prueba constructor<br>";
    }

    // Método para mostrar información de la persona
    public function mostrarInformacion() { // METODO

        $this->apellido;
        echo "Nombre: " . $this->nombre . ", Edad: " . $this->edad . " años" . " Pais: ". $this->pais . "<br>";
    }
}


$persona_nombre = 5;
$persona_edad = 30;
$persona_pais = "CR";


$persona_nombre1 = 5;
$persona_edad1 = 30;
$persona_pais1 = "CR";


$persona_nombre2 = 5;
$persona_edad2 = 30;
$persona_pais3 = "CR";



// Crear una instancia de la clase Persona
$persona1 = new Persona("Juan", 30, "CR");
$persona2 = new Persona("Jairo", 24, "Portugal");
$persona3 = new Persona("Genesis", 40, "Espanna");
$persona4 = new Persona("Messi", 37 , "Francia");
$persona5 = new Persona("Cristiano", 39, "Portugal"  );



// Acceder a las propiedades y métodos de la instancia
$persona1->mostrarInformacion();
$persona2->mostrarInformacion();
$persona3->mostrarInformacion();
$persona4->mostrarInformacion();

$persona5->mostrarInformacion();


