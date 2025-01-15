<?php
include 'conexion.php';

$query = "SELECT boleta, Nombre, primerApe, segundoApe, telefono FROM Alumno";
$result = $conn->query($query);

$data = [];
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}

echo json_encode($data);
?>
