<?php
$host = "localhost";
$dbname = "asignacion";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Validar que las claves existan
    $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;
    $contrasena = isset($_POST['password']) ? $_POST['password'] : null;

    // Validar campos vacíos
    if (empty($usuario) || empty($contrasena)) {
        echo json_encode(['success' => false, 'message' => 'Por favor, completa todos los campos.']);
        exit;
    }

    // Consultar la base de datos
    $query = "SELECT * FROM administrador WHERE usuario_admin = :usuario";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        if ($contrasena === $admin['contra_admin']) {
            echo json_encode(['success' => true, 'username' => $admin['usuario_admin']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Credenciales incorrectas.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Usuario no encontrado.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos: ' . $e->getMessage()]);
}
?>
