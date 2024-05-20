<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "farmaciabd";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Procesar el formulario de activación
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST["email"]);
    $codigo_verificacion = $conn->real_escape_string($_POST["codigo_verificacion"]);

    $sql = "SELECT * FROM usuarios WHERE email='$email' AND codigo_verificacion='$codigo_verificacion'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $update_sql = "UPDATE usuarios SET estado_cuenta = 1 WHERE email = '$email' AND codigo_verificacion = '$codigo_verificacion'";
        if ($conn->query($update_sql) === TRUE) {
            echo '<div class="alert alert-success" role="alert">¡Tu cuenta ha sido activada correctamente!</div>';
            // Redirigir al usuario a login.php
            header("Location: login.php");
            exit();
        } else {
            echo '<div class="alert alert-danger" role="alert">Error al activar la cuenta: ' . $conn->error . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Código de verificación incorrecto para el correo proporcionado.</div>';
    }
} else {
    echo '<div class="alert alert-danger" role="alert">Error al procesar la solicitud.</div>';
}

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
        <a href="activar.php" class="btn btn-primary">Regresar</a>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
