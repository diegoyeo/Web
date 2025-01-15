<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Asignacion";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del cliente
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tipo = $_POST['tipo']; // 'boleta'

    if ($tipo === 'boleta') {
        $valor = $_POST['valor'];
        $sql = "SELECT boleta FROM Alumno WHERE boleta = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $valor);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo json_encode(["existe" => true]);
        } else {
            echo json_encode(["existe" => false]);
        }

        $stmt->close();
    }
}
$conn->close();
?>



