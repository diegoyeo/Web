<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    echo '<script>alert("Sesión no iniciada. Por favor, inicie sesión."); window.location.href = "../acceso.html";</script>';
    exit;
}

// Verificar si se subió un archivo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['comprobante'])) {
    $archivo = $_FILES['comprobante'];
    $nombreArchivo = $archivo['name'];
    $tipoArchivo = $archivo['type'];
    $rutaTemporal = $archivo['tmp_name'];
    $errorArchivo = $archivo['error'];

    // Validar que no hubo errores al subir el archivo
    if ($errorArchivo === UPLOAD_ERR_OK) {
        // Validar que el archivo sea un PDF
        if ($tipoArchivo === 'application/pdf') {
            $carpetaDestino = '../uploads/';
            // Asegurarse de que la carpeta de destino exista
            if (!is_dir($carpetaDestino)) {
                mkdir($carpetaDestino, 0755, true);
            }

            $rutaDestino = $carpetaDestino . basename($nombreArchivo);

            // Mover el archivo a la carpeta destino
            if (move_uploaded_file($rutaTemporal, $rutaDestino)) {
                // Redirigir a la página de acuerdo de responsabilidades
                echo '<script>window.location.href = "acuerdo_responsabilidades.php";</script>';
            } else {
                echo '<script>alert("Error al guardar el archivo. Inténtalo de nuevo."); window.location.href = "renovacion_responsabilidades.php";</script>';
            }
        } else {
            echo '<script>alert("Por favor, sube un archivo en formato PDF."); window.location.href = "renovacion_responsabilidades.php";</script>';
        }
    } else {
        echo '<script>alert("Error al subir el archivo. Código de error: ' . $errorArchivo . '"); window.location.href = "renovacion_responsabilidades.php";</script>';
    }
} else {
    echo '<script>alert("No se recibió ningún archivo."); window.location.href = "renovacion_responsabilidades.php";</script>';
}
?>
