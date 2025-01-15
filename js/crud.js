document.addEventListener('DOMContentLoaded', () => {
    // Cargar los datos iniciales
    cargarAlumnos();

    // Botón para agregar alumno
    const btnAgregar = document.getElementById('btnAgregarAlumno');
    btnAgregar.addEventListener('click', () => {
        const nuevoAlumno = {
            boleta: prompt('Boleta:'),
            nombre: prompt('Nombre:'),
            primerApe: prompt('Primer Apellido:'),
            segundoApe: prompt('Segundo Apellido:'),
            telefono: prompt('Teléfono:')
        };

        fetch('php/addAlumno.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams(nuevoAlumno)
        }).then(response => response.json())
          .then(data => {
              if (data.status === 'success') {
                  alert('Alumno agregado exitosamente');
                  cargarAlumnos();
              } else {
                  alert('Error al agregar alumno');
              }
          });
    });
});

// Función para cargar los datos de los alumnos
function cargarAlumnos() {
    fetch('php/getAlumno.php')
        .then(response => response.json())
        .then(data => {
            const tabla = document.getElementById('tablaAlumnos');
            tabla.innerHTML = ''; // Limpiar la tabla

            data.forEach(alumno => {
                const row = `
                    <tr>
                        <td>${alumno.boleta}</td>
                        <td>${alumno.Nombre}</td>
                        <td>${alumno.primerApe}</td>
                        <td>${alumno.segundoApe}</td>
                        <td>${alumno.telefono}</td>
                        <td>
                            <button class="btn btn-warning" onclick="editarAlumno(${alumno.boleta})">Editar</button>
                            <button class="btn btn-danger" onclick="eliminarAlumno(${alumno.boleta})">Eliminar</button>
                        </td>
                    </tr>
                `;
                tabla.innerHTML += row;
            });
        });
}

function eliminarAlumno(boleta) {
    if (!confirm('¿Estás seguro de que deseas eliminar este alumno?')) return;

    fetch('php/deleteAlumno.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ boleta })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Alumno eliminado exitosamente');
            cargarAlumnos(); // Recargar la tabla después de borrar
        } else {
            alert('Error al eliminar alumno');
        }
    })
    .catch(error => console.error('Error en la solicitud de eliminación:', error));
}
