document.addEventListener('DOMContentLoaded', () => {
    const menu = document.getElementById('menu');
    const menuHeader = document.getElementById('menu-header');
    const boletasContainer = document.getElementById('boletas');
    const listaBoletas = document.getElementById('listaBoletas');
    const casillerosContainer = document.getElementById('casilleros');
    const botones = document.querySelectorAll('.boton');

    // Cargar el estado de los casilleros desde la base de datos
    fetch('./php/obtenerCasilleros.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const casilleros = data.data;
                casilleros.forEach(casillero => {
                    if (casillero.estado_cas === 'ocupado') {
                        const boton = document.querySelector(`button[data-id="${casillero.num_casillero}"]`);
                        if (boton) {
                            boton.disabled = true;
                            boton.style.backgroundColor = '#ccc'; // Cambiar color de fondo para los ocupados
                        }
                    }
                });
            } else {
                console.error('Error al cargar los casilleros:', data.message);
            }
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
        });

    // Mostrar el menú y las boletas cuando se haga clic en un casillero
    botones.forEach((boton) => {
        boton.addEventListener('click', (event) => {
            menuHeader.innerText = `Acciones para el casillero ${boton.innerText}`;
            const rect = boton.getBoundingClientRect();
            menu.style.top = `${rect.bottom + window.scrollY}px`;
            menu.style.left = `${rect.left}px`;
            menu.style.display = 'block';

            // Guardar el casillero seleccionado
            menu.dataset.selectedButton = boton.getAttribute('data-id');

            // Mostrar las boletas relacionadas con el casillero
            mostrarBoletas();
        });
    });

    // Cerrar el menú si se hace clic fuera de él
    document.addEventListener('click', (event) => {
        if (!menu.contains(event.target) && !event.target.classList.contains('boton')) {
            menu.style.display = 'none';
        }
    });

    // Mostrar las boletas al hacer clic en un casillero
    function mostrarBoletas() {
        const idCasillero = menu.dataset.selectedButton;

        // Mostrar el contenedor de boletas
        boletasContainer.style.display = 'block';
        listaBoletas.innerHTML = ''; // Limpiar lista antes de agregar nuevos elementos

        // Solicitar las boletas desde la base de datos
        fetch('./php/dashboard.php')
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const solicitudes = data.data;
                    solicitudes.forEach(solicitud => {
                        const listItem = document.createElement('li');
                        listItem.classList.add('list-group-item', 'list-group-item-action');
                        listItem.innerText = `Boleta: ${solicitud.boleta}, Tipo: ${solicitud.tipo_soli}, Estado: ${solicitud.estado_soli}`;
                        listItem.dataset.id_soli = solicitud.id_soli;

                        // Agregar evento de clic para seleccionar la boleta
                        listItem.addEventListener('click', () => {
                            asignarCasillero(solicitud, idCasillero);
                        });

                        listaBoletas.appendChild(listItem);
                    });
                } else {
                    alert(data.message || 'No se pudieron obtener las solicitudes.');
                }
            })
            .catch(error => {
                console.error('Error al obtener las solicitudes:', error);
            });
    }

    // Asignar el casillero seleccionado a la boleta
    function asignarCasillero(solicitud, numCasillero) {
        const boletaSeleccionada = solicitud.boleta;

        // Enviar la solicitud para asignar el casillero a la boleta
        fetch('./php/asignarCasillero.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `num_casillero=${numCasillero}&id_soli=${solicitud.id_soli}`,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Actualizar el estado de la solicitud a 'finalizada'
                actualizarEstadoSolicitud(solicitud);
                alert(`Casillero ${numCasillero} asignado a la boleta ${boletaSeleccionada} y estado actualizado a 'finalizada'`);

                // Deshabilitar el botón del casillero
                const botonCasillero = document.querySelector(`button[data-id="${numCasillero}"]`);
                if (botonCasillero) {
                    botonCasillero.disabled = true;
                }

                // Cerrar el contenedor de boletas
                boletasContainer.style.display = 'none';
            } else {
                alert(data.message || 'No se pudo asignar el casillero.');
            }
        })
        .catch(error => {
            console.error('Error al asignar el casillero:', error);
        });
    }

    // Actualizar el estado de la solicitud a 'finalizada'
    function actualizarEstadoSolicitud(solicitud) {
        fetch('./php/actualizarEstadoSolicitud.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `id_soli=${solicitud.id_soli}&estado_soli=finalizada`,
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                alert(data.message || 'No se pudo actualizar el estado de la solicitud.');
            }
        })
        .catch(error => {
            console.error('Error al actualizar el estado de la solicitud:', error);
        });
    }
});
