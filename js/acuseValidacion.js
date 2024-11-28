

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
    }else {
        alert("Sesion iniciada con exito");
    }
}

