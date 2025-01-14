document.getElementById('loginForm').addEventListener('submit', (event) => {
    event.preventDefault(); // Evita que el formulario recargue la página

    const usuario = document.getElementById('usuario').value;
    const password = document.getElementById('password').value;

    const formData = new FormData();
    formData.append('usuario', usuario);
    formData.append('password', password);

    fetch('./php/login.php', {
        method: 'POST',
        body: formData,
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert('¡Bienvenido, ' + data.username + '!');
                window.location.href = './adminDashboard.html'; // Redirige a otra página
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch((error) => {
            alert('Error al conectar con el servidor');
            console.error(error);
        });
});
