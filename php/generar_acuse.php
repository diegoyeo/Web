<?php
session_start();
require_once 'fpdf/fpdf.php';

// Verificar si se enviaron los datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $boleta = $_POST['boleta'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $comprobante = $_FILES['comprobante'] ?? null;

    // Validar el archivo PDF
    if ($comprobante && $comprobante['type'] !== 'application/pdf') {
        die('Error: El archivo debe ser un PDF.');
    }

    // Mover el archivo subido
    $uploadDir = '../uploads/';
    $filePath = $uploadDir . basename($comprobante['name']);
    if (!move_uploaded_file($comprobante['tmp_name'], $filePath)) {
        die('Error al subir el archivo.');
    }

    // Crear el PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Acuse de Recibo', 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "Boleta: $boleta", 0, 1);
    $pdf->Cell(0, 10, "Usuario: $usuario", 0, 1);
    $pdf->Cell(0, 10, "Archivo subido: " . basename($comprobante['name']), 0, 1);

    // Salida del PDF
    $pdf->Output();
    exit;
}
?>
