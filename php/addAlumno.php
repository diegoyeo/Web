<?php
include 'conexion.php';

$boleta = $_POST['boleta'];
$nombre = $_POST['nombre'];
$primerApe = $_POST['primerApe'];
$segundoApe = $_POST['segundoApe'];
$telefono = $_POST['telefono'];

$query = "INSERT INTO Alumno (boleta, Nombre, primerApe, segundoApe, telefono) 
          VALUES (:boleta, :nombre, :primerApe, :segundoApe, :telefono)";
$stmt = $conn->prepare($query);
$stmt->bindParam(':boleta', $boleta);
$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':primerApe', $primerApe);
$stmt->bindParam(':segundoApe', $segundoApe);
$stmt->bindParam(':telefono', $telefono);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error']);
}
?>
