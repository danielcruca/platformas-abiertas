const API_URL = "http://localhost/api/libreria-api/public/index.php";


function obtenerTodosLosLibros() {

    const xhr = new XMLHttpRequest();
    xhr.open('GET', API_URL+'/libros', true);



    xhr.onload = function () {

        // Nos conectamos a la API por el endpoint usando get
        // si el status 200 significa que esta bien.
        // Leemos la respuesta de la api. 
        // Selecionas la tabla  #book-table
        // creamos logica para tomar todos esos datos y adjuntarlos(append) a #book-table
        if (this.status === 200) {

            console.log(this.responseText);
            




            const cleanedText = this.responseText.replace(/^\uFEFF/, '').trim();
            try {
                const books = JSON.parse(cleanedText);
                document.querySelector('#book-table tbody').innerHTML = ''; // Limpiar de la tabla previo
                console.log(books);

                books.forEach(book => {
                    console.log("Autor: "+ book.autor
                    )
                });
                books.forEach(book => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${book.titulo}</td>
                         <td>${book.autor}</td>
                        <td>$${book.precio}</td>
                        <td>${book.cantidad_stock}</td>
                        <td>
                         <button onclick="mostrarFormActualizarLibro(${book.id_libro}, '${book.titulo}', ${book.id_autor}, ${book.precio}, ${book.cantidad_stock})">Actualizar</button>
                         <button onclick="eliminarLibro(${book.id_libro})">Eliminar</button>
                        </td>
                    `;
                    document.querySelector('#book-table tbody').appendChild(tr);
                });
            } catch (e) {
                console.error('Error parsing JSON:', e);
            }
        } else {
            console.error('Error fetching books:', this.statusText);
        }
    };
    xhr.onerror = function () {
        console.error('Request error...');
    };
    xhr.send();
}


function guardarLibro(data) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST',  API_URL+'/libros', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log('Libro guardado exitosamente');
            obtenerTodosLosLibros(); // Actualizar lista de libros después de guardar
        } else {
            console.error('Error al guardar el libro:', xhr.statusText);
        }
    };
    xhr.onerror = function () {
        console.error('Error en la solicitud');
    };
    xhr.send(JSON.stringify(data));
}


function actualizarLibro(data) {
    const xhr = new XMLHttpRequest();
    xhr.open('PUT', API_URL + '/libros/' + data.id_libro, true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log('Libro actualizado exitosamente');
            obtenerTodosLosLibros(); // Actualizar lista de libros después de actualizar
        } else {
            console.error('Error al actualizar el libro:', xhr.statusText);
        }
    };
    xhr.onerror = function () {
        console.error('Error en la solicitud');
    };
    xhr.send(JSON.stringify(data));
}


function eliminarLibro(bookId) {
    console.log("borrrandoooo......." + bookId);
    const xhr = new XMLHttpRequest();
    xhr.open('DELETE', API_URL + '/libros/' + bookId, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            console.log('Libro eliminado exitosamente');
            obtenerTodosLosLibros(); // Actualizar lista de libros después de eliminar
        } else {
            console.error('Error al eliminar el libro:', xhr.statusText);
        }
    };
    xhr.onerror = function () {
        console.error('Error en la solicitud');
    };
    xhr.send();
}

/* Metodo que muestra el formulario para actualizar con la informacion de los libros.*/

function mostrarFormActualizarLibro(id_libro, titulo, id_autor, precio, cantidad_stock) {

    alert("Mostrar formulario para actualizar")
    console.log(id_autor)
    const form = document.getElementById('update-book-form');
    form.querySelector('#update-id_libro').value = id_libro;
    form.querySelector('#update-titulo').value = titulo;
    form.querySelector('#update-id_autor').value = id_autor;
    form.querySelector('#update-precio').value = precio;
    form.querySelector('#update-cantidad_stock').value = cantidad_stock;
    form.style.display = 'block';
}

