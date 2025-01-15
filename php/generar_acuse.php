<?php
session_start();
require('fpdf/fpdf.php');

// Verificar si la sesión está activa
if (!isset($_SESSION['usuario']) || !isset($_SESSION['boleta'])) {
    echo '<script>alert("Por favor, inicia sesión para acceder a esta página."); window.location.href = "acceso.html";</script>';
    exit;
}

// Verificar si el acuse ya ha sido generado en esta sesión
if (isset($_SESSION['acuse_generado']) && $_SESSION['acuse_generado'] === true) {
    // Si ya se generó, redirigir al usuario a la página de acuse generado
    echo '<script>window.location.href = "acuse_generado.php";</script>';
    exit;
}

$host = "localhost";
$dbname = "asignacion";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $boleta = $_SESSION['boleta'];

    // Consultar el nombre completo
    $query = "
        SELECT Nombre, primerApe, segundoApe
        FROM alumno
        WHERE boleta = :boleta
    ";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':boleta', $boleta);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$result) {
        echo '<script>alert("No se encontraron datos para esta boleta."); window.location.href = "acceso.html";</script>';
        exit;
    }

    $nombreCompleto = "{$result['Nombre']} {$result['primerApe']} {$result['segundoApe']}";
    $periodo = "2024-2025/2 (febrero - agosto)";

    // Crear el PDF
    class PDF extends FPDF
    {
        function Header()
        {
            $this->Image('../recursos/logotipo_ipn.png', 10, 6, 20); 
            $this->Image('../recursos/escudoESCOM.png', 180, 6, 20); 
            $this->SetFont('Arial', 'B', 12);
            $this->Cell(0, 10, 'Acuse', 0, 1, 'C');
            $this->Ln(10);
        }

        function Footer()
        {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
        }
    }

    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);

    // Añadir contenido
    $pdf->Cell(0, 10, "Numero de boleta: $boleta", 0, 1);
    $pdf->Cell(0, 10, "Nombre completo: $nombreCompleto", 0, 1);
    $pdf->Cell(0, 10, "Periodo de uso del casillero: $periodo", 0, 1);

    // Guardar el PDF
    $pdf->Output('I', 'acuse.pdf');

    // Marcar que el acuse ha sido generado en la sesión
    $_SESSION['acuse_generado'] = true;

} catch (PDOException $e) {
    echo '<script>alert("Error de conexión a la base de datos: ' . $e->getMessage() . '"); window.location.href = "../acceso.html";</script>';
}
?>
