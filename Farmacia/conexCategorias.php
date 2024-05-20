<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si el nombre de la categoría está presente
    if (isset($_POST['nombre_categoria']) && isset($_POST['descripcion_categoria'])) {
        // Conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "farmaciabd";
        $conn = new mysqli($servername, $username, $password, $database);
        
        // Verifica la conexión
        if ($conn->connect_error) {
            die('<div class="alert alert-danger" role="alert">Error de conexión: ' . $conn->connect_error . '</div>');
        }
        
        // Prepara los datos para la inserción
        $nombre_categoria = $_POST['nombre_categoria'];
        $descripcion_categoria = $_POST['descripcion_categoria'];
        
        // Consulta SQL para insertar la nueva categoría
        $sql = "INSERT INTO categoria_producto (nombre, descripcion) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $nombre_categoria, $descripcion_categoria);
        
        // Ejecuta la consulta
        if ($stmt->execute() === TRUE) {
            echo '<div class="alert alert-success" role="alert">Categoría agregada exitosamente.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error al agregar la categoría: ' . $conn->error . '</div>';
        }
        
        // Cierra la conexión
        $stmt->close();
        $conn->close();
    } else {
        echo '<div class="alert alert-warning" role="alert">El nombre y la descripción de la categoría son requeridos.</div>';
    }
}
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
        <a href="categoria.php" class="btn btn-primary">Regresar</a>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>