 SELECT 
                libros.id_libro,
                libros.titulo,
                libros.precio,
                libros.cantidad_stock,
                libros.id_autor,
                CONCAT(autores.nombre, ' ', autores.apellido) AS autor
            FROM 
                libros
            JOIN 
                autores
            ON 
                libros.id_autor = autores.id_autor;

                SELECT * FROM libros WHERE id_libro = ?