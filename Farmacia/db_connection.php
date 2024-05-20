<?php
$servername = "localhost"; // Cambiar si la base de datos está en un servidor diferente
$username = "root";
$password = "";
$database = "farmacia_db"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}