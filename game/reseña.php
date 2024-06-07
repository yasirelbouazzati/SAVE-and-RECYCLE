<?php
// Conectar a la base de datos (asegúrate de tener las credenciales correctas)
$servername = "reseña"; // Nombre del servidor MySQL
$username = "root";
$password = "";
$dbname = "juego_niveles"; // Nombre de la base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener datos de la solicitud AJAX
$data = json_decode(file_get_contents("php://input"));

// Insertar la reseña en la base de datos
$nivel = $data->nivel;
$emoji = $data->emoji;

// Escapar los datos para evitar inyección de SQL
$nivel = $conn->real_escape_string($nivel);
$emoji = $conn->real_escape_string($emoji);

$sql = "INSERT INTO niveles_resenas (nivel, emoji) VALUES (?, ?)"; // Consulta preparada

// Preparar y ejecutar la consulta
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $nivel, $emoji);

if ($stmt->execute()) {
    echo json_encode(array("success" => true));
} else {
    echo json_encode(array("success" => false, "error" => $stmt->error));
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
