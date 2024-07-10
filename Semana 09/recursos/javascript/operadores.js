let a = 5;
let b = 2;
let suma = a + b;  // 7
let resta = a - b;  // 3
let multiplicacion = a * b;  // 10
let division = a / b;  // 2.5
let modulo = a % b;  // 1
a++;  // Incrementa a en 1
b--;  // Decrementa b en 1


let x = 10;
x += 5;  // Equivalente a: x = x + 5;


let num1 = 5;
let num2 = "5";
console.log(num1 == num2);  // true (verifica igualdad sin considerar tipo)
console.log(num1 === num2);  // false (verifica igualdad considerando tipo)


let condicion1 = true;
let condicion2 = false;
console.log(condicion1 && condicion2);  // false (AND lógico)
console.log(condicion1 || condicion2);  // true (OR lógico)
console.log(!condicion1);  // false (NOT lógico)


let nombre = "Florencio";
let apellido = "Del Castillo";
let nombreCompleto = nombre + " " + apellido;