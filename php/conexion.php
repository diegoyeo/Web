<?php
// Configuración de la conexión a la base de datos
$host = 'localhost';         // Dirección del servidor (o localhost si está en tu máquina)
$dbname = 'asignacion';      // Nombre de la base de datos
$username = 'root';          // Usuario de la base de datos
$password = '';              // Contraseña del usuario

try {
    // Crear una nueva conexión PDO
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Configurar opciones para el manejo de errores
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    // Mostrar mensaje de error si la conexión falla
    die('Error al conectar con la base de datos: ' . $e->getMessage());
}
?>
