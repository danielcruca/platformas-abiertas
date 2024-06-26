

<?php
class MiClase {
    private $mensaje = "Hola desde la clase"; // Propiedad de la clase
    public $usuario = "cmadrigal";
   
   
    public function mostrarMensaje() { // Método de la clase
        
        return $this->usuario; // Accediendo a la propiedad usando $this
    }







}

$objeto = new MiClase(); // Creando una instancia de la clase
echo $objeto->mostrarMensaje(); // Llamando al método y mostrando el mensaje
?>
