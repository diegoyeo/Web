
const tipoSolicitud = document.getElementsByName("tipoSolicitud");
const numeroLockerDiv = document.getElementById("numeroLockerDiv");
const numeroLocker = document.getElementById("numeroLocker");
const form = document.getElementById("FormLock");

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
    let valid = true;

    // Verificar que se haya seleccionado al menos un radio button
    const tipoSoli = document.querySelector('input[name="tipoSolicitud"]:checked');
    if (!tipoSoli) {
        alert("Por favor, seleccione el tipo de solicitud.");
        valid = false;
    }

    if (document.getElementById('renovacion').checked) {
        const numeroLocker = document.getElementById("numeroLocker").value;
        if (!numeroLocker || numeroLocker <= 0) {
            alert("El número de locker es obligatorio.");
            valid = false;
        }
    }

    const correo = document.getElementById("correo").value;
    if (!correo || !correo.endsWith("@alumno.ipn.mx")) {
        alert("El correo debe ser del dominio @alumno.ipn.mx.");
        valid = false;
    }

    const tel = document.getElementById("tel").value;
    if (!tel || !/^\d{10}$/.test(tel)) {
        alert("El teléfono debe contener exactamente 10 dígitos.");
        valid = false;
    }

    const boleta = document.getElementById("boleta").value;
    if (!boleta || !/^\d{10}$/.test(boleta)) {
        alert("El número de boleta debe contener exactamente 10 dígitos.");
        valid = false;
    }

    const estatura = document.getElementById("estatura").value;
    if (estatura && (isNaN(estatura) || estatura < 0.1 || estatura > 2.3)) {
        alert("La estatura debe ser un número entre 0.1 y 2.3 metros.");
        valid = false;
    }

    const edad = document.getElementById("edad").value;
    if (!edad || isNaN(edad) || edad <= 0) {
        alert("La edad debe ser un número mayor a 0.");
        valid = false;
    }

    const requiredFields = ["nombre", "primerA", "segundoA", "usuario", "password"];
    requiredFields.forEach((fieldId) => {
        const field = document.getElementById(fieldId).value;
        if (!field) {
            alert(`El campo ${fieldId} es obligatorio.`);
            valid = false;
        }
    });

    const credencialPDF = document.getElementById('credencialPDF').files.length;
    const horarioPDF = document.getElementById('horarioPDF').files.length;
    if (credencialPDF === 0 || horarioPDF === 0) {
        alert("Debe cargar ambos archivos: credencial y horario.");
        valid = false;
    }

    if (!valid) {
        return; 
    }

    // Si pasa las validaciones, mostrar los datos ingresados
    const nombre = document.getElementById('nombre').value || 'No proporcionado';
    const tipoSolicitud = document.querySelector('input[name="tipoSolicitud"]:checked')?.value || 'No seleccionado';
    const primerA = document.getElementById('primerA').value || 'No proporcionado';
    const segundoA = document.getElementById('segundoA').value || 'No proporcionado';
    const usuario = document.getElementById('usuario').value || 'No proporcionado';

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







