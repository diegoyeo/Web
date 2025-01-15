<?php
session_start();

// Verificar si la sesión está iniciada
if (!isset($_SESSION['usuario']) || !isset($_SESSION['boleta'])) {
    echo '<script>alert("Por favor, inicia sesión para acceder a esta página."); window.location.href = "acceso.html";</script>';
    exit;
}

$usuario = $_SESSION['usuario'];
$boleta = $_SESSION['boleta'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styleIndex.css">
    <title>Acuerdo de Responsabilidades</title>
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
                            <a class="nav-link" href="#inicio" style="color: rgb(255, 0, 0);">Acuerdo de Responsabilidades</a>
                        </li>
                    </ul>
                </div>
                <a class="navbar-brand" href="recursos/escudoESCOM.png">
                    <img src="recursos/escudoESCOM.png" alt="LogoEscom" title="ESCOM" width="50" height="50" class="d-inline-block align-text-top">
                </a>
            </div>
        </nav>
    </header>

    <div class="container mt-5">
        <h2 class="text-center">Acuerdo de Responsabilidades</h2>
        <div class="card p-4 shadow">
            <h5>Boleta: <?= htmlspecialchars($boleta); ?></h5>
            <h5>Usuario: <?= htmlspecialchars($usuario); ?></h5>
            <embed src="recursos/acuerdo_responsabilidades.pdf" type="application/pdf" width="100%" height="600px" />
            <form id="acuerdo-form" action="php/generar_acuse.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" id="conformidad" name="conformidad" required>
                    <label class="form-check-label" for="conformidad">
                        Estoy de acuerdo con los términos y condiciones.
                    </label>
                </div>
                <div class="mb-3 mt-3">
                    <label for="comprobante" class="form-label">Subir comprobante de pago (PDF)</label>
                    <input class="form-control" type="file" id="comprobante" name="comprobante" accept="application/pdf" required>
                    <small class="text-danger d-none" id="error-message">El archivo debe ser un PDF.</small>
                </div>
                <input type="hidden" name="boleta" value="<?= htmlspecialchars($boleta); ?>">
                <input type="hidden" name="usuario" value="<?= htmlspecialchars($usuario); ?>">
                <button type="submit" class="btn btn-primary">Generar Acuse</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const checkbox = document.getElementById('conformidad');
        const fileInput = document.getElementById('comprobante');
        const errorMessage = document.getElementById('error-message');

        // Validación del formulario antes del envío
        function validateForm() {
            const isFileSelected = fileInput.files.length > 0;
            const isCheckboxChecked = checkbox.checked;

            if (!isFileSelected) {
                alert("Por favor, sube un archivo PDF.");
                return false;
            }

            const file = fileInput.files[0];
            if (file.type !== 'application/pdf') {
                errorMessage.classList.remove('d-none');
                alert("El archivo debe ser un PDF.");
                return false;
            } else {
                errorMessage.classList.add('d-none');
            }

            if (!isCheckboxChecked) {
                alert("Debes aceptar los términos y condiciones.");
                return false;
            }

            return true;
        }
    </script>
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
