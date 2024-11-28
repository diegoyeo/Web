// Función de validación de la contraseña
function validarContrasena(contrasena) {
    let regex = /^(?=.*\d)(?=.*[!@#$%^&*(),.?":{}|<>])[A-Za-z\d!@#$%^&*(),.?":{}|<>]{8,}$/; // Expresión regular

    if (regex.test(contrasena)) {
        console.log("Contraseña válida.");
        alert("Inicio de sesión exitoso");
    } else {
        alert("La contraseña debe tener al menos 8 caracteres, incluir al menos un número y un carácter especial.");
    }
}

// Función de validación del formulario
function validarFormulario(event) {
    // Obtener los valores de los campos
    var usuario = document.getElementById("usuario").value;
    var password = document.getElementById("password").value;

    // Verificar si los campos están vacíos
    if (usuario === "" || password === "") {
        // Prevenir el envío del formulario
        event.preventDefault();

        // Mostrar un mensaje de error
        alert("Por favor, ingrese los datos requeridos.");
    } else {
        // Validar la contraseña antes de enviar el formulario
        if (validarContrasena(password)) {
            // Si la contraseña es válida, proceder con el envío del formulario
            alert("Formulario enviado.");
        } else {
            // Prevenir el envío del formulario si la contraseña no es válida
            event.preventDefault();
        }
    }
}
