<?php
include 'conexion.php';

if (!empty($_POST['id_soli']) && !empty($_POST['estado_soli'])) {
    $id_soli = intval($_POST['id_soli']); // Aseguramos que sea un entero
    $estado_soli = htmlspecialchars($_POST['estado_soli']); // Evitamos inyecciones de código

    // Preparar la consulta SQL
    $query = "UPDATE solicitud SET estado_soli = ? WHERE id_soli = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $estado_soli, $id_soli);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el estado: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Parámetros faltantes']);
}

$conn->close();
?>
