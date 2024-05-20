<?php
// Verifica si se ha enviado la solicitud de realizar venta y si hay datos en $_POST
if (isset($_POST['realizar_venta']) && isset($_POST['lista_venta'])) {
    // Decodifica la lista de venta JSON
    $listaVenta = json_decode($_POST['lista_venta'], true);

    // Verifica si la decodificación fue exitosa
    if ($listaVenta !== null) {
        // Crear conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "farmaciabd";
        $conn = new mysqli($servername, $username, $password, $database);

        // Verifica si hay errores en la conexión
        if ($conn->connect_error) {
            die('<div class="alert alert-danger" role="alert">Error de conexión: ' . $conn->connect_error . '</div>');
        }

        // Recoge la información del cliente del formulario
        $nombre_cliente = $_POST['nombre'];
        $telefono_cliente = $_POST['telefono'];
        $direccion_cliente = $_POST['direccion'];

        // Inserta la información del cliente en la tabla "cliente"
        $sql_insert_cliente = "INSERT INTO cliente (nombre, telefono, direccion) VALUES ('$nombre_cliente', '$telefono_cliente', '$direccion_cliente')";
        $result_insert_cliente = $conn->query($sql_insert_cliente);
        if (!$result_insert_cliente) {
            echo '<div class="alert alert-danger" role="alert">Error al insertar el cliente: ' . $conn->error . '</div>';
        } else {
            // Obtiene el ID del cliente recién insertado
            $id_cliente = $conn->insert_id;

            // Calcula el total del precio de la venta
            $total_venta = 0;
            foreach ($listaVenta as $producto) {
                $total_venta += $producto['precio'] * $producto['cantidad'];
            }

            // Inserta la información de la venta en la tabla "venta"
            foreach ($listaVenta as $producto) {
                $id_producto = $producto['id_producto'];
                $cantidad = $producto['cantidad'];
                $sql_insert_venta = "INSERT INTO venta (fecha, cliente, cantidad_pago, id_producto, cantidad) VALUES (CURDATE(), $id_cliente, $total_venta, $id_producto, $cantidad)";
                $result_insert_venta = $conn->query($sql_insert_venta);
                if (!$result_insert_venta) {
                    echo '<div class="alert alert-danger" role="alert">Error al insertar la venta: ' . $conn->error . '</div>';
                }
            }

            // Vacía la lista de venta después de realizar la venta
            $listaVenta = [];
            echo '<div class="alert alert-success" role="alert">Venta realizada con éxito.</div>';
        }
    } else {
        // Maneja el caso en que la decodificación falle
        echo '<div class="alert alert-danger" role="alert">Error al decodificar la lista de venta JSON.</div>';
    }
} else {
    // Maneja el caso en que los datos no estén completos en $_POST
    echo '<div class="alert alert-danger" role="alert">Error: Los datos de la venta no están completos.</div>';
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
        <a href="clientes.php" class="btn btn-primary">Regresar</a>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>