<?php
include 'conexion.php';

if (!empty($_POST['num_casillero']) && !empty($_POST['id_soli'])) {
    $num_casillero = intval($_POST['num_casillero']); // Aseguramos que sea un entero
    $id_soli = intval($_POST['id_soli']); // Aseguramos que sea un entero

    try {
        // Preparar la consulta SQL
        $query = "UPDATE casillero SET id_soli = ?, estado_cas = 'ocupado' WHERE num_casillero = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$id_soli, $num_casillero]);

        echo json_encode(['success' => true, 'message' => 'Casillero asignado correctamente.']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error al asignar el casillero: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Parámetros faltantes']);
}
?>
