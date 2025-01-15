<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styleIndex.css">
    <title>Renovación de Casillero</title>
</head>
<body>

    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="recursos/logotipo_ipn.png" alt="LogoIpn" title="Logo IPN" width="50" height="50" class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link disabled">Renovación de Casillero</a>
                        </li>
                    </ul>
                </div>
                <a class="navbar-brand" href="#">
                    <img src="recursos/escudoESCOM.png" alt="LogoEscom" title="Logo ESCOM" width="50" height="50" class="d-inline-block align-text-top">
                </a>
            </div>
        </nav>
    </header>

    <!-- Contenido principal -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow p-4">
                    <h3 class="text-center mb-4">Subir Comprobante de Pago</h3>
                    <form action="procesar_renovacion.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="comprobante" class="form-label">Comprobante de Pago (PDF únicamente)</label>
                            <input type="file" name="comprobante" id="comprobante" class="form-control" accept=".pdf" required>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-outline-danger">Subir Comprobante</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
