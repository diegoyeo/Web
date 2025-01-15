<?php
include 'conexion.php';

$boleta = $_POST['boleta'];

$query = "DELETE FROM Alumno WHERE boleta = :boleta";
$stmt = $conn->prepare($query);
$stmt->bindParam(':boleta', $boleta);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>
