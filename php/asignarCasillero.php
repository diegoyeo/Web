<?php
include 'conexion.php';

if (!empty($_POST['num_casillero']) && !empty($_POST['id_soli'])) {
    $num_Casillero = intval($_POST['num_casillero']);
    $id_soli = intval($_POST['id_soli']);

    try {
        // Verificar si el casillero ya está ocupado
        $queryCheck = "SELECT estado_cas FROM Casillero WHERE num_casillero = ?";
        $stmtCheck = $conn->prepare($queryCheck);
        $stmtCheck->execute([$num_Casillero]);
        $casillero = $stmtCheck->fetch();

        if ($casillero && $casillero['estado_cas'] === 'ocupado') {
            echo json_encode(['success' => false, 'message' => 'El casillero ya está ocupado.']);
            exit;
        }

        // Asignar el casillero
        $query = "UPDATE casillero SET id_soli = ?, estado_cas = 'ocupado' WHERE num_casillero = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$id_soli, $num_Casillero]);
        
        // Actualizar el estado de la solicitud
        $queryUpdateSolicitud = "UPDATE solicitud SET estado_soli = 'finalizada' WHERE id_soli = ?";
        $stmtUpdateSolicitud = $conn->prepare($queryUpdateSolicitud);
        $stmtUpdateSolicitud->execute([$id_soli]);

        echo json_encode(['success' => true, 'message' => 'Casillero asignado correctamente.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error al asignar el casillero: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Parámetros faltantes']);
}
?>
