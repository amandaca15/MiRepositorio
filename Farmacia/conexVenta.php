<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "farmaciabd";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('<div class="alert alert-danger" role="alert">Conexión fallida: ' . $conn->connect_error . '</div>');
}

$categoria = $_POST['categoria'];
$producto = $_POST['producto'];
$cantidad = $_POST['cantidad'];
$precio_total = $_POST['precio'];
$nombre_cliente = $_POST['nombre_cliente'];
$telefono_cliente = $_POST['telefono_cliente'];
$direccion_cliente = $_POST['direccion_cliente'];
$id_categoria = $_POST['id_categoria_hidden'];
$id_producto = $_POST['id_producto_hidden'];

// Primero, insertar el cliente si no existe
$sql_cliente = "INSERT INTO cliente (nombre, telefono, direccion) VALUES ('$nombre_cliente', '$telefono_cliente', '$direccion_cliente') ON DUPLICATE KEY UPDATE nombre='$nombre_cliente', telefono='$telefono_cliente', direccion='$direccion_cliente'";
if ($conn->query($sql_cliente) === TRUE) {
    $cliente_id = $conn->insert_id;

    // Insertar la venta
    $sql_venta = "INSERT INTO venta (fecha, cliente, cantidad_pago, id_producto, cantidad) VALUES (CURDATE(), '$cliente_id', '$precio_total', '$id_producto', '$cantidad')";
    if ($conn->query($sql_venta) === TRUE) {
        // Actualizar la existencia del producto
        $sql_update_producto = "UPDATE producto SET existencia = existencia - $cantidad WHERE id_producto = $id_producto";
        if ($conn->query($sql_update_producto) === TRUE) {
            echo '<div class="alert alert-success" role="alert">Venta realizada y existencia de producto actualizada correctamente.</div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">Error al actualizar la existencia del producto: ' . $conn->error . '</div>';
        }
    } else {
        echo '<div class="alert alert-danger" role="alert">Error al insertar la venta: ' . $conn->error . '</div>';
    }
} else {
    echo '<div class="alert alert-danger" role="alert">Error al insertar el cliente: ' . $conn->error . '</div>';
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
        <a href="ventas.php" class="btn btn-primary">Regresar</a>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>