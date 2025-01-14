<?php
header('Content-Type: application/json');

// Conexión a la base de datos
$host = "localhost";
$dbname = "asignacion";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener los casilleros y sus estados
    $query = "SELECT num_casillero, estado_cas FROM casillero";
    $stmt = $pdo->query($query);
    $casilleros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'data' => $casilleros]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error al conectar con la base de datos: ' . $e->getMessage()]);
}
?>
