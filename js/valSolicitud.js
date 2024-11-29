
let tipoSolicitud = document.getElementsByName("tipoSolicitud");
let numeroLockerDiv = document.getElementById("numeroLockerDiv");
let numeroLocker = document.getElementById("numeroLocker");
let form = document.getElementById("FormLock");

// Mostrar/ocultar el campo de número de locker según la selección
tipoSolicitud.forEach((radio) => {
    radio.addEventListener("change", () => {
        if (radio.value === "renovacion") {
            numeroLockerDiv.style.display = "block";
            numeroLocker.setAttribute("required", true);
        } else {
            numeroLockerDiv.style.display = "none";
            numeroLocker.removeAttribute("required");
        }
    });
});

// Evento onclick para el botón "Verificar Datos"
document.getElementById('verDatos').addEventListener('click', function () {
    let valido = true;

    // Verificar que se haya seleccionado al menos un radio button
    let tipoSoli = document.querySelector('input[name="tipoSolicitud"]:checked');
    if (!tipoSoli) {
        alert("Por favor, seleccione el tipo de solicitud.");
        valido = false;
    }
    
    const nombre = document.getElementById("nombre").value;
    const expresionNombre = /^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/;
    if (!nombre || !expresionNombre.test(nombre)) {
        alert("El campo Nombre solo debe contener letras y espacios.");
        valido = false;
    }

    const primerApellido = document.getElementById("primerA").value;
    if (!primerApellido || !expresionNombre.test(primerApellido)) {
        alert("El campo Primer Apellido solo debe contener letras y espacios.");
        valido = false;
    }

    const segundoApellido = document.getElementById("segundoA").value;
    if (!segundoApellido || !expresionNombre.test(segundoApellido)) {
        alert("El campo Segundo Apellido solo debe contener letras y espacios.");
        valido = false;
    }


    if (document.getElementById('renovacion').checked) {
        let numeroLocker = document.getElementById("numeroLocker").value;
        if (!numeroLocker || numeroLocker <= 0) {
            alert("El número de locker es obligatorio.");
            valido = false;
        }
    }

    let correo = document.getElementById("correo").value;
    let correoRegex = /^[a-zA-Z0-9._%+-]+@alumno\.ipn\.mx$/;
    if (!correo || !correoRegex.test(correo)) {
        alert("El correo debe ser del dominio @alumno.ipn.mx.");
        valido = false;
    }

    let tel = document.getElementById("tel").value;
    if (!tel || !/^\d{10}$/.test(tel)) {
        alert("El teléfono debe contener exactamente 10 dígitos.");
        valido = false;
    }

    let boleta = document.getElementById("boleta").value;
    if (!boleta || !/^\d{10}$/.test(boleta)) {
        alert("El número de boleta debe contener exactamente 10 dígitos.");
        valido = false;
    }

    let estatura = document.getElementById("estatura").value;
    if (estatura && (isNaN(estatura) || estatura < 0.1 || estatura > 2.3)) {
        alert("La estatura debe ser un número entre 0.1 y 2.3 metros.");
        valido = false;
    }

    let edad = document.getElementById("edad").value;
    if (!edad || isNaN(edad) || edad <= 0) {
        alert("La edad debe ser un número mayor a 0.");
        valido = false;
    }
   

    let credencialPDF = document.getElementById('credencialPDF').files.length;
    let horarioPDF = document.getElementById('horarioPDF').files.length;
    if (credencialPDF === 0 || horarioPDF === 0) {
        alert("Debe cargar ambos archivos: credencial y horario.");
        valido = false;
    }

    let contrasena = document.getElementById("password").value;
    let expresionContrasena = /^(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>])[A-Za-z\d!@#$%^&*(),.?":{}|<>]{8,}$/;
    if (!contrasena || !expresionContrasena.test(contrasena)) {
        alert("La contraseña debe tener al menos 8 caracteres, incluyendo un número y un carácter especial.");
        valido = false;
    }

    if (!valido) {
        return; 
    }

    let tipoSolicitud = document.querySelector('input[name="tipoSolicitud"]:checked')?.value;
    let primerA = document.getElementById('primerA').value;
    let segundoA = document.getElementById('segundoA').value;
    let usuario = document.getElementById('usuario').value;

    let datosHTML = `
        <li><b>Tipo de solicitud:</b> ${tipoSolicitud}</li>
        <li><b>Nombre:</b> ${nombre}</li>
        <li><b>Primer apellido:</b> ${primerA}</li>
        <li><b>Segundo apellido:</b> ${segundoA}</li>
        <li><b>Teléfono:</b> ${tel}</li>
        <li><b>Boleta:</b> ${boleta}</li>
        <li><b>Estatura:</b> ${estatura} m</li>
        <li><b>Edad:</b> ${edad}</li>
        <li><b>Correo:</b> ${correo}</li>
        <li><b>Usuario:</b> ${usuario}</li>
    `;
    
    // Si la solicitud es renovación, agregar el número de locker
    if (tipoSolicitud === "renovacion") {
        const locker = numeroLocker.value || 'No proporcionado';
        datosHTML += `<li><b>Número de locker:</b> ${locker}</li>`;
    }

    // Mostrar los datos y ocultar el formulario
    document.getElementById('datosList').innerHTML = datosHTML;
    document.getElementById('resultado').style.display = 'block';
    document.getElementById('FormLock').style.display = 'none';
});

// Evento para editar los datos
document.getElementById('editarDatos').addEventListener('click', function () {
    document.getElementById('resultado').style.display = 'none';
    document.getElementById('FormLock').style.display = 'block';
});

// Evento para guardar los datos
document.getElementById('guardarDatos').addEventListener('click', function () {
    alert("Los datos han sido guardados correctamente");
    window.location.href = "index.html";
});







