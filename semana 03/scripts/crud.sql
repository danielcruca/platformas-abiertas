
-- Obtener todos los libros ordenados por título
SELECT * FROM libros
ORDER BY titulo;

-- Insertar un nuevo libro
INSERT INTO libros (titulo, id_autor, precio, cantidad_stock) VALUES ('Nuevo Libro', 1, 10.99, 50);

-- Actualizar el precio de un libro
SET SQL_SAFE_UPDATES = 0;
UPDATE libros SET precio = 12.99 WHERE titulo = 'Nuevo Libro';

-- Eliminar un libro
DELETE FROM libros WHERE titulo = 'Nuevo Libro';

-- Insertar un autor con valores predeterminados para nacionalidad
INSERT INTO autores (nombre, apellido) VALUES ('Juan', 'Pérez');

