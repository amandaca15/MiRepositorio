<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si todos los campos requeridos están presentes
    if (isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['existencia']) && isset($_POST['descripcion']) && isset($_POST['id_categoria']) && isset($_POST['id_proveedor'])) {
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
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $existencia = $_POST['existencia'];
        $descripcion = $_POST['descripcion'];
        $id_categoria = $_POST['id_categoria'];
        $id_proveedor = $_POST['id_proveedor']; // Nuevo campo para el ID del proveedor
        
        // Procesamiento de la imagen
        $imagen = null;
        if ($_FILES['imagen']['size'] > 0) {
            $imagen = $_FILES['imagen']['name'];
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
            move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file);
        }
        
        // Consulta SQL para insertar el nuevo producto
        $sql = "INSERT INTO producto (nombre, precio, existencia, descripcion, imagen, id_categoria, id_proveedor) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sdisssi", $nombre, $precio, $existencia, $descripcion, $imagen, $id_categoria, $id_proveedor);
        
        // Ejecuta la consulta
        if ($stmt->execute() === TRUE) {
            echo '<div class="alert alert-success" role="alert">Producto agregado exitosamente.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error al agregar el producto: ' . $conn->error . '</div>';
        }
        
        // Cierra la conexión
        $stmt->close();
        $conn->close();
    } else {
        echo '<div class="alert alert-danger" role="alert">Todos los campos son requeridos.</div>';
    }
} else {
    echo '<div class="alert alert-danger" role="alert">Error: No se ha enviado el formulario.</div>';
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
        <a href="productos.php" class="btn btn-primary">Regresar</a>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>