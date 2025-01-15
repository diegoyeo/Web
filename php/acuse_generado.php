<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    echo '<script>alert("Por favor, inicia sesión para acceder a esta página."); window.location.href = "acceso.html";</script>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Acuse Generado</title>
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="recursos/logotipo_ipn.png" alt="LogoIpn" title="Logo Ipn" width="50" height="50" class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <button type="button" class="btn btn-dark me-2"><a href="index.html" class="btn-lore">Inicio</a></button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-dark me-2"><a href="signin.html" class="btn-lore">Solicitud</a></button>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#inicio" style="color: rgb(255, 0, 0);">Acceso</a>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-dark me-2"><a href="admin.html" class="btn-lore">Admin</a></button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="btn btn-dark me-2"><a href="acceso.html" class="btn-lore">Acceso</a></button>
                        </li>
                    </ul>
                </div>
                <a class="navbar-brand" href="">
                    <img src="recursos/escudoESCOM.png" alt="LogoEscom" title="Logo Escom" width="50" height="50" class="d-inline-block align-text-top">
                </a>
            </div>
        </nav>
    </header>
    
    <div class="container mt-5">
        <h2 class="text-center">Acuse ya Generado</h2>
        <div class="alert alert-success" role="alert">
            ¡Tu acuse ha sido generado exitosamente! No necesitas realizar esta acción nuevamente.
        </div>
        <div class="d-flex justify-content-center">
            <a href="index.html" class="btn btn-primary">Regresar al Inicio</a>
        </div>
    </div>

    <footer class="bg-body-tertiary py-3 mt-4">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <a href="https://www.ipn.mx" target="_blank">
                        <img src="recursos/logotipo_ipn.png" alt="Logo IPN" title="IPN" width="50" height="50">
                    </a>
                    <p><a href="https://www.ipn.mx" target="_blank">Instituto Politécnico Nacional</a></p>
                </div>
                <div class="col">
                    <a href="https://www.escom.ipn.mx" target="_blank">
                        <img src="recursos/escudoESCOM.png" alt="Logo ESCOM" title="ESCOM" width="50" height="50">
                    </a>
                    <p><a href="https://www.escom.ipn.mx" target="_blank">Escuela Superior de Cómputo</a></p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <p>Producto Registrado &copy; 2024. Todos los Derechos Reservados.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
