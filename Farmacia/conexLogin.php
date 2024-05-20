<?php
// Archivo: conexLogin.php

// Datos de conexión a la base de datos
$servername = "localhost"; // Cambia localhost por la dirección del servidor si es diferente
$username = "root";
$password = "";
$dbname = "farmaciabd";

// Establecer conexión con la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die('<div class="alert alert-danger" role="alert">Conexión fallida: ' . $conn->connect_error . '</div>');
}

// Verificar si se enviaron datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el correo electrónico y la contraseña enviados desde el formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta SQL para obtener el usuario con el correo electrónico dado
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND estado_cuenta = 1";
    $result = $conn->query($sql);
    
    // Si se encontró un usuario con el correo electrónico dado
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];
        // Verificar la contraseña
        if (password_verify($password, $hashed_password)) {
            // Contraseña correcta
            // Redirigir al usuario a index.php
            header("Location: index.php");
            exit();
        } else {
            // Contraseña incorrecta
            echo '<div class="alert alert-danger" role="alert">Contraseña incorrecta. <a href="javascript:history.back()" class="alert-link">Volver</a></div>';
            exit();
        }
    } else {
        // Usuario no encontrado
        echo '<div class="alert alert-danger" role="alert">Usuario no encontrado. <a href="javascript:history.back()" class="alert-link">Volver</a></div>';
        exit();
    }
} 

// Cerrar la conexión con la base de datos
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
        <!-- Botón para regresar a la página de activación -->
    <div class="text-center mt-3">
        <a href="login.php" class="btn btn-primary">Regresar</a>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>