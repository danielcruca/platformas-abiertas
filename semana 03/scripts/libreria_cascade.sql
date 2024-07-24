DROP DATABASE IF EXISTS libreria;
CREATE DATABASE libreria;
USE libreria;

CREATE TABLE autores (
    id_autor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    nacionalidad VARCHAR(50)
);

CREATE TABLE libros (
    id_libro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    id_autor INT,
    precio DECIMAL(10, 2),
    cantidad_stock INT,
    FOREIGN KEY (id_autor) REFERENCES autores(id_autor)
);

CREATE TABLE transacciones_ventas (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    id_libro INT,
    fecha_venta DATE,
    cantidad INT,
    total DECIMAL(10, 2),
    FOREIGN KEY (id_libro) REFERENCES libros(id_libro) ON DELETE CASCADE
);
