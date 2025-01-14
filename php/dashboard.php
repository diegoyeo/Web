<?php
include 'conexion.php';

try {
    // Consulta para obtener solicitudes activas
    $query = "SELECT id_soli, boleta, tipo_soli, estado_soli FROM solicitud WHERE estado_soli != 'finalizada'";
    $stmt = $conn->query($query);
    $solicitudes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['success' => true, 'data' => $solicitudes]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error al obtener las solicitudes: ' . $e->getMessage()]);
}
?>
