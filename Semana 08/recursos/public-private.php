<?php
// Definición de una clase llamada MiClase
class MiClase {
    public $propiedadPublica = "Propiedad pública";
    private $propiedadPrivada = "Propiedad privada";

    // Método para mostrar las propiedades
    public function mostrarPropiedades() {
        echo "Propiedad pública: " . $this->propiedadPublica . "<br>";
        echo "Propiedad privada: " . $this->propiedadPrivada . "<br>";
    }

    // Método para mostrar las propiedades
    private function conectarBaseDeDatos() {
        echo "Desde aqui me conecto a la base de datos.";
        
    }
}

$objeto = new MiClase(); //hielo


/// Publico
echo "Accediendo a la propiedad pública desde fuera de la clase: " . $objeto->propiedadPublica . "<br>";
$objeto->mostrarPropiedades();


//Privado
// Puede descomentar estas lineas para que vea el error:
echo "Accediendo a la propiedad pública desde fuera de la clase: " . $objeto->propiedadPrivada . "<br>";
$objeto->conectarBaseDeDatos();


?>
