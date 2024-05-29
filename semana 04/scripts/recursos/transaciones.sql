-- Puntos de guarado.


-- Iniciar la transacción
START TRANSACTION;

-- Paso 1: Insertar un nuevo libro
INSERT INTO libros (titulo, id_autor, precio, cantidad_stock) VALUES ('Nuevo Libro', 1, 25.00, 50);

-- Obtener el id_libro del libro recién insertado
SET @nuevo_libro_id = LAST_INSERT_ID();

-- Paso 2: Registrar una venta para el nuevo libro
INSERT INTO transacciones_ventas (id_libro, fecha_venta, cantidad, total) VALUES (@nuevo_libro_id, '2024-05-27', 2, 50.00);

-- Crear un punto de guardado
SAVEPOINT registro_venta_exitosa;

-- Paso 3: Intentar registrar otra venta con un error (cantidad negativa)
INSERT INTO transacciones_ventas (id_libro, fecha_venta, cantidad, total) VALUES (@nuevo_libro_id, '203324-05-27', -1, -25.00);

-- Ocurre un error, deshacer solo la última venta
ROLLBACK TO registro_venta_exitosa;

-- Confirmar la transacción
COMMIT;



