<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmaciabd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id_categoria = $_GET['id_categoria'];

$sql = "SELECT id_producto, nombre, precio FROM producto WHERE id_categoria = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_categoria);
$stmt->execute();
$result = $stmt->get_result();

$productos = array();
while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}

echo json_encode($productos);

$stmt->close();
$conn->close();
?>
