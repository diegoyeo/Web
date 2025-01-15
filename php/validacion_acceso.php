<?php
session_start();
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
        echo '<script>alert("Por favor, completa todos los campos."); window.location.href = "../acceso.html";</script>';
        exit;
    }

    // Consultar la tabla alumno
    $query = "SELECT * FROM alumno WHERE usuario_alum = :usuario";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();

    $admin = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($admin) {
        if ($contrasena === $admin['contra_alum']) {
            // Guardar la sesión del usuario
            $_SESSION['usuario'] = $admin['usuario_alum'];
            $_SESSION['boleta'] = $admin['boleta'];

            // Verificar el tipo de solicitud en la tabla solicitud
            $soliQuery = "
                SELECT tipo_soli 
                FROM solicitud 
                WHERE boleta = :boleta
            ";
            $soliStmt = $pdo->prepare($soliQuery);
            $soliStmt->bindParam(':boleta', $admin['boleta']);
            $soliStmt->execute();

            $solicitud = $soliStmt->fetch(PDO::FETCH_ASSOC);

            if ($solicitud && $solicitud['tipo_soli'] === 'Primera vez') {
                // Redirigir a la página del Acuerdo de Responsabilidades
                echo '<script>window.location.href = "../acuerdo_responsabilidades.html";</script>';
            } else {
                // Redirigir a la página principal o según sea necesario
                echo '<script>window.location.href = "../index.html?sesion=true";</script>';
            }
        } else {
            echo '<script>alert("Credenciales incorrectas."); window.location.href = "../acceso.html";</script>';
        }
    } else {
        echo '<script>alert("Usuario no encontrado."); window.location.href = "../acceso.html";</script>';
    }
} catch (PDOException $e) {
    echo '<script>alert("Error de conexión a la base de datos: ' . $e->getMessage() . '"); window.location.href = "../acceso.html";</script>';
}
?>
