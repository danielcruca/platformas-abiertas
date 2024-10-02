-- Eliminar la base de datos si ya existe
DROP DATABASE IF EXISTS libreria;

-- Crear la base de datos
CREATE DATABASE libreria;

-- Seleccionar la base de datos
USE libreria;

-- Creación de la tabla "autores"
CREATE TABLE autores (
    id_autor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    nacionalidad VARCHAR(50)
);

-- Creación de la tabla "libros"
CREATE TABLE libros (
    id_libro INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100),
    id_autor INT,
    precio DECIMAL(10, 2),
    cantidad_stock INT,
    FOREIGN KEY (id_autor) REFERENCES autores(id_autor)
);

-- Creación de la tabla "transacciones_ventas"
CREATE TABLE transacciones_ventas (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    id_libro INT,
    fecha_venta DATE,
    cantidad INT,
    total DECIMAL(10, 2),
    FOREIGN KEY (id_libro) REFERENCES libros(id_libro)
);

-- Datos para la tabla "autores"
INSERT INTO autores (nombre, apellido, nacionalidad) VALUES
    ('Gabriel', 'García Márquez', 'Colombia'),
    ('J.K.', 'Rowling', 'Reino Unido'),
    ('Stephen', 'King', 'Estados Unidos');

-- Datos para la tabla "libros"
INSERT INTO libros (titulo, id_autor, precio, cantidad_stock) VALUES
    ('Cien años de soledad', 1, 19.99, 100),
    ('Harry Potter y la piedra filosofal', 2, 15.99, 150),
    ('El resplandor', 3, 12.99, 80),
    ('El amor en los tiempos del cólera', 1, 18.50, 120),
    ('It', 3, 14.75, 90);

-- Datos para la tabla "transacciones_ventas"
INSERT INTO transacciones_ventas (id_libro, fecha_venta, cantidad, total) VALUES
    (1, '2024-05-01', 5, 99.95),
    (2, '2024-05-03', 10, 159.90),
    (3, '2024-05-05', 3, 38.97),
    (4, '2024-05-07', 8, 148.00),
    (5, '2024-05-10', 6, 88.50);

-- Creación de la vista "ventas"
CREATE VIEW ventas AS
SELECT 
    tv.id_venta,
    l.titulo AS libro,
    CONCAT(a.nombre, ' ', a.apellido) AS autor,
    tv.fecha_venta,
    tv.cantidad,
    tv.total,
    CASE 
        WHEN l.cantidad_stock - COALESCE((SELECT SUM(tv2.cantidad) FROM transacciones_ventas tv2 WHERE tv2.id_libro = l.id_libro), 0) < 0 THEN 0
        ELSE l.cantidad_stock - COALESCE((SELECT SUM(tv2.cantidad) FROM transacciones_ventas tv2 WHERE tv2.id_libro = l.id_libro), 0)
    END AS libros_restantes
FROM 
    transacciones_ventas tv
    JOIN libros l ON tv.id_libro = l.id_libro
    JOIN autores a ON l.id_autor = a.id_autor;

-- Obtener todos los libros ordenados por título
SELECT * FROM libros
ORDER BY titulo;

-- Obtener todos los libros con la información del autor
SELECT l.titulo, a.nombre, a.apellido
FROM libros l
JOIN autores a ON l.id_autor = a.id_autor;

-- Obtener todos los autores y títulos de libros, combinando autores que no tienen libros con los que sí
SELECT nombre, apellido FROM autores
UNION
SELECT a.nombre, a.apellido FROM autores a
JOIN libros l ON a.id_autor = l.id_autor;


-- Obtener todos los autores que tienen libros que si han vendido.
SELECT a.nombre, a.apellido FROM autores a
JOIN libros l ON a.id_autor = l.id_autor
INTERSECT  
SELECT a.nombre, a.apellido FROM autores a
JOIN libros l ON a.id_autor = l.id_autor
JOIN transacciones_ventas tv ON l.id_libro = tv.id_libro;



-- Obtener todos los autores que tienen libros pero no han vendido nada
SELECT a.nombre, a.apellido FROM autores a
JOIN libros l ON a.id_autor = l.id_autor
EXCEPT
SELECT a.nombre, a.apellido FROM autores a
JOIN libros l ON a.id_autor = l.id_autor
JOIN transacciones_ventas tv ON l.id_libro = tv.id_libro;

-- Obtener todas las transacciones con la información del libro y del autor
SELECT tv.id_venta, l.titulo, a.nombre, a.apellido, tv.fecha_venta, tv.cantidad, tv.total
FROM transacciones_ventas tv
JOIN libros l ON tv.id_libro = l.id_libro
JOIN autores a ON l.id_autor = a.id_autor;

-- Obtener el libro con el precio más altov
SELECT * FROM libros
WHERE precio = (SELECT MAX(precio) FROM libros);

-- Obtener las transacciones y marcar si la cantidad vendida es mayor a 5
SELECT tv.*, 
    CASE 
        WHEN tv.cantidad > 5 THEN 'Mayor a 5'
        ELSE '5 o menos'
    END AS cantidad_marca
FROM transacciones_ventas tv;

-- Insertar un nuevo autor y libro dentro de una transacción con punto de guardado
START TRANSACTION;

SAVEPOINT sp1;
INSERT INTO autores (nombre, apellido, nacionalidad) VALUES ('Isabel', 'Allende', 'Chile');
-- Asumimos que el id_autor generado es 4
INSERT INTO libros (titulo, id_autor, precio, cantidad_stock) VALUES ('La casa de los espíritus', 4, 20.00, 100);

-- Si todo es correcto, confirmar los cambios
COMMIT;

-- Encontrar libros que han sido vendidos al menos una vez
SELECT DISTINCT l.titulo
FROM libros l
JOIN transacciones_ventas tv ON l.id_libro = tv.id_libro;

-- Obtener la cantidad total de libros vendidos por cada autor
SELECT a.nombre, a.apellido, SUM(tv.cantidad) AS total_vendidos
FROM autores a
JOIN libros l ON a.id_autor = l.id_autor
JOIN transacciones_ventas tv ON l.id_libro = tv.id_libro
GROUP BY a.id_autor;

-- Encontrar autores que tienen el mismo nombre y apellido (posible duplicado)
SELECT a1.nombre, a1.apellido
FROM autores a1
JOIN autores a2 ON a1.nombre = a2.nombre AND a1.apellido = a2.apellido
WHERE a1.id_autor <> a2.id_autor;

-- Obtener los libros junto con el nombre completo del autor
SELECT l.titulo, CONCAT(a.nombre, ' ', a.apellido) AS autor_completo
FROM libros l
JOIN autores a ON l.id_autor = a.id_autor;

-- Insertar un nuevo libro
INSERT INTO libros (titulo, id_autor, precio, cantidad_stock) VALUES ('Nuevo Libro', 1, 10.99, 50);

-- Actualizar el precio de un libro
SET SQL_SAFE_UPDATES = 0;
UPDATE libros SET precio = 12.99 WHERE titulo = 'Nuevo Libro';

-- Eliminar un libro
DELETE FROM libros WHERE titulo = 'Nuevo Libro';

-- Insertar un autor con valores predeterminados para nacionalidad
INSERT INTO autores (nombre, apellido) VALUES ('Juan', 'Pérez');

-- Calcular el precio promedio de los libros
SELECT AVG(precio) AS precio_promedio FROM libros;

-- Calcular la cantidad promedio de stock
SELECT AVG(cantidad_stock) AS promedio_stock FROM libros;

-- Calcular la diferencia acumulada de cantidad vendida para cada libro
SELECT id_libro, fecha_venta, cantidad, 
       SUM(cantidad) OVER (PARTITION BY id_libro ORDER BY fecha_venta) AS cantidad_acumulada
FROM transacciones_ventas;

-- Generar productos acumulados (en este caso, calcularemos un producto ficticio acumulado)
SELECT id_libro, fecha_venta, cantidad, 
       EXP(SUM(LOG(cantidad)) OVER (PARTITION BY id_libro ORDER BY fecha_venta)) AS producto_acumulado
FROM transacciones_ventas;

-- Obtener las ventas realizadas en el último mes
SELECT * FROM transacciones_ventas
WHERE fecha_venta >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH);

-- Obtener la cantidad de días desde la primera venta hasta hoy
SELECT DATEDIFF(CURDATE(), MIN(fecha_venta)) AS dias_desde_primera_venta
FROM transacciones_ventas;

-- Crear una vista jerárquica de autores y sus libros
CREATE VIEW autores_libros AS
SELECT a.id_autor, a.nombre, a.apellido, l.id_libro, l.titulo
FROM autores a
LEFT JOIN libros l ON a.id_autor = l.id_autor;


------------------------------------------------------------------------------------------------------------------------------------------------
SELECT 
    tv.id_venta,
    l.titulo AS libro,
    CONCAT(a.nombre, ' ', a.apellido) AS autor,
    tv.fecha_venta,
    tv.cantidad,
    tv.total,
    CASE 
        WHEN l.cantidad_stock - COALESCE((SELECT SUM(tv2.cantidad) FROM transacciones_ventas tv2 WHERE tv2.id_libro = l.id_libro), 0) < 0 THEN 0
        ELSE l.cantidad_stock - COALESCE((SELECT SUM(tv2.cantidad) FROM transacciones_ventas tv2 WHERE tv2.id_libro = l.id_libro), 0)
    END AS libros_restantes
FROM 
    transacciones_ventas tv
    JOIN libros l ON tv.id_libro = l.id_libro
    JOIN autores a ON l.id_autor = a.id_autor;