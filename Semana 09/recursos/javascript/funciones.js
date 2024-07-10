// Definición de una función básica
function saludar() {
    console.log("¡Hola, mundo!");
}

// Llamada a la función básica
saludar();

// Función con parámetro
function saludarPersona(nombre) {
    console.log("Hola, " + nombre + "!");
}

// Llamada a la función con parámetro
saludarPersona("Lus");

// Función con valor de retorno
function suma(a, b) {
    return a + b;
}

// Llamada a la función con valor de retorno
let resultado = suma(5, 3);
console.log(resultado);  // Salida: 8



// Función expresión o anonima asignada a una variable 
let multiplicar = function (a, b) {
    return a * b;
};

// Llamada a la función asignada a una variable
console.log(multiplicar(4, 6))