
let tipoSolicitud = document.getElementsByName("tipoSolicitud");
let numeroLockerDiv = document.getElementById("numeroLockerDiv");
let numeroLocker = document.getElementById("numeroLocker");
let form = document.getElementById("FormLock");

// Mostrar/ocultar el campo de número de locker según la selección
tipoSolicitud.forEach((radio) => {
    radio.addEventListener("change", () => {
        if (radio.value === "Renovación") {
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
    let errores="";

    // Verificar que se haya seleccionado al menos un radio button
    let tipoSoli = document.querySelector('input[name="tipoSolicitud"]:checked');
    if (!tipoSoli) {
        errores += "- Debe seleccionar el tipo de solicitud.\n";
    }

    if (document.getElementById('renovacion').checked) {
        let numeroLocker = document.getElementById("numeroLocker").value;
        if (!numeroLocker || numeroLocker <= 0) {
            errores += "- El campo numero de locker no debe estar vacío.\n";
        }
    }    
    
    const nombre = document.getElementById("nombre").value;
    const expresionNombre = /^[a-zA-ZÁÉÍÓÚáéíóúÑñ\s]+$/;
    if (!nombre || !expresionNombre.test(nombre)) {
        errores += "- El campo nombre solo debe contener letras y espacios.\n";
    }

    let primerApellido = document.getElementById("primerA").value;
    if (!primerApellido || !expresionNombre.test(primerApellido)) {
        errores += "- El campo primer apellido solo debe contener letras y espacios.\n";
    }

    let segundoApellido = document.getElementById("segundoA").value;
    if (!segundoApellido || !expresionNombre.test(segundoApellido)) {
        errores += "- El campo segundo apellido solo debe contener letras y espacios.\n";
    }

    let tel = document.getElementById("tel").value;
    if (!tel || !/^\d{10}$/.test(tel)) {
        errores += "- El teléfono debe contener exactamente 10 dígitos.\n";
    }

    let boleta = document.getElementById("boleta").value;
    if (!boleta || !/^\d{10}$/.test(boleta)) {
        errores += "- El número de boleta debe contener exactamente 10 dígitos.\n";
    }

    let estatura = document.getElementById("estatura").value;
    if (!estatura && (isNaN(estatura) || estatura < 0.1 || estatura > 2.3)) {
        errores += "- La estatura debe ser un número entre 0.1 y 2.3 metros.\n";
    }

    let edad = document.getElementById("edad").value;
    if (!edad || isNaN(edad) || edad <= 0) {
        errores += "- La edad debe ser un número mayor a 0.\n";
    }

    let correo = document.getElementById("correo").value;
    let correoRegex = /^[a-zA-Z0-9._%+-]+@alumno\.ipn\.mx$/;
    if (!correo || !correoRegex.test(correo)) {
        errores += "- El correo debe ser del dominio @alumno.ipn.mx.\n";
    }

    let credencialPDF = document.getElementById('credencialPDF');
    let horarioPDF = document.getElementById('horarioPDF');
    const pdfRegex = /\.pdf$/i;
    if (credencialPDF.files.length === 0 || horarioPDF.files.length === 0) {
        errores += "- Debe cargar ambos archivos: credencial y horario.\n";
    } else {
        if (!pdfRegex.test(credencialPDF.files[0].name) || !pdfRegex.test(horarioPDF.files[0].name)) {
            errores += "- Ambos archivos deben tener formato PDF.\n";
        }
    }
    
    let usuario = document.getElementById("usuario").value;
    if (!usuario.trim()) {
        errores += "- El campo usuario no puede estar vacío.\n";
    }

    let contrasena = document.getElementById("password").value;
    let expresionContrasena = /^(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>])[A-Za-z\d!@#$%^&*(),.?":{}|<>]{8,}$/;
    if (!contrasena || !expresionContrasena.test(contrasena)) {
        errores += "- La contraseña debe tener al menos 8 caracteres, incluyendo un número y un carácter especial.\n";
    }

    if (errores) {
        alert("Verificar que los siguentes datos hayan sido llenados correctamente:\n" + errores);
        return;
    }

    let tipoSolicitud = document.querySelector('input[name="tipoSolicitud"]:checked')?.value;
    let primerA = document.getElementById('primerA').value;
    let segundoA = document.getElementById('segundoA').value;


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
        <li><b>Archivo Credencial:</b> ${credencialPDF.files[0]?.name}</li>
        <li><b>Archivo Horario:</b> ${horarioPDF.files[0]?.name}</li>
        <li><b>Usuario:</b> ${usuario}</li>
        <li><b>Contraseña:</b> ${contrasena}</li>
    `;
    
    // Si la solicitud es renovación, agregar el número de locker
    if (tipoSolicitud === "Renovación") {
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

document.getElementById('guardarDatos').addEventListener('click', function () {
    // Opcional: Confirmación antes de enviar
    if (confirm('¿Deseas enviar los datos ingresados?')) {
        document.getElementById('FormLock').submit();
    }
});


// Evento para guardar los datos
/*document.getElementById('guardarDatos').addEventListener('click', function () {
    alert("Los datos han sido guardados correctamente");
    window.location.href = "index.html";
});*/





