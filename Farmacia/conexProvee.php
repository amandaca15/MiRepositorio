<?php
// Establecer conexión con la base de datos (modifica los valores según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmaciabd";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die('<div class="alert alert-danger" role="alert">Error en la conexión: ' . $conn->connect_error . '</div>');
}

// Recuperar los datos del formulario
$nombre = $_POST['nombre'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$pag_web = $_POST['pag_web'];

// Crear y ejecutar la consulta SQL para insertar el proveedor
$sql = "INSERT INTO proveedor (nombre, direccion, telefono, pag_web) VALUES ('$nombre', '$direccion', '$telefono', '$pag_web')";

if ($conn->query($sql) === TRUE) {
    echo '<div class="alert alert-success" role="alert">Proveedor registrado correctamente</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Error al registrar el proveedor: ' . $conn->error . '</div>';
}

// Cerrar la conexión
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
        <a href="proveedores.php" class="btn btn-primary">Regresar</a>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>