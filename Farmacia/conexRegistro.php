<?php
$servername = "localhost"; // Cambiar si la base de datos está en un servidor diferente
$username = "root"; // Usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$database = "farmaciabd"; // Nombre de la base de datos

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die('<div class="alert alert-danger" role="alert">Error en la conexión: ' . $conn->connect_error . '</div>');
}

// Procesar el formulario de registro si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $codigo_verificacion = uniqid();

    // Query para insertar los datos en la tabla de usuarios
    $sql = "INSERT INTO usuarios (usuario, email, password, codigo_verificacion) VALUES ('$usuario', '$email', '$hashed_password', '$codigo_verificacion')";

    if ($conn->query($sql) === TRUE) {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'amandamonserratcarrillocarmona@gmail.com';                     // SMTP username
            $mail->Password   = 'j p i p e x v q m g r y b s x b';                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            // Enable implicit TLS encryption
            $mail->Port       = 465;                                    // TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Recipients
            $mail->setFrom('amandamonserratcarrillocarmona@gmail.com', 'Amanda Carrillo');
            $mail->addAddress($email);     // Add a recipient

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Activa tu cuenta';
            $mail->Body    = 'Hola, este es tu código de verificación: '.$codigo_verificacion;
            $mail->AltBody = 'Hola, este es tu código de verificación: '.$codigo_verificacion;

            $mail->send();
            echo '<div class="alert alert-success" role="alert">El mensaje ha sido enviado</div>';

            // Redirigir a la página activar.php
            header("Location: activar.php");
            exit(); // Asegurar que el script se detenga después de la redirección
        } catch (Exception $e) {
            echo '<div class="alert alert-danger" role="alert">El mensaje no pudo ser enviado. Error de Mailer: ' . $mail->ErrorInfo . '</div>';
        }
        echo '<div class="alert alert-success" role="alert">Registro exitoso</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Error al registrar el usuario: ' . $conn->error . '</div>';
    }
}

// Cerrar la conexión a la base de datos
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
        <a href="registro.php" class="btn btn-primary">Regresar</a>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>