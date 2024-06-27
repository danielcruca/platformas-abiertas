ALTER TABLE libros
DROP FOREIGN KEY libros_ibfk_1;

ALTER TABLE libros
ADD CONSTRAINT libros_ibfk_1
FOREIGN KEY (id_autor)
REFERENCES autores(id_autor)
ON DELETE CASCADE;
