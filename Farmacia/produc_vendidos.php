<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas Realizadas</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>



<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-vertical">
    <div class="container-fluid d-flex flex-column">
        <a class="navbar-brand" href="index.php">Farmacia</a>
        <div class="collapse navbar-collapse flex-column" id="navbarNav">
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="ventas.php">Venta de Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categoria.php">Categoría Producto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="clientes.php">Cliente</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="productos.php">Producto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="proveedores.php">Proveedor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="usuarios.php">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="produc_vendidos.php">Venta</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Iniciar Sesion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registro.php">Registrase</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <!-- Contenido -->
    <div class="container mt-5">
        <h1 class="mb-4">Ventas Realizadas</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Venta</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Producto</th>
                    <th>Cantidad Pagada</th>
                    <th>Cantidad Vendida</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Establecer conexión a la base de datos (debes llenar los detalles de conexión)
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "farmaciabd";

                $conn = new mysqli($servername, $username, $password, $database);

                // Verificar la conexión
                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }

                // Consulta SQL para obtener la información de ventas con nombres de cliente y productos
                $sql = "SELECT venta.id_venta, venta.fecha, cliente.nombre AS nombre_cliente, producto.nombre AS nombre_producto, venta.cantidad_pago, venta.cantidad
                        FROM venta
                        INNER JOIN cliente ON venta.cliente = cliente.id_cliente
                        INNER JOIN producto ON venta.id_producto = producto.id_producto";

                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id_venta"] . "</td>";
                        echo "<td>" . $row["fecha"] . "</td>";
                        echo "<td>" . $row["nombre_cliente"] . "</td>";
                        echo "<td>" . $row["nombre_producto"] . "</td>";
                        echo "<td>" . $row["cantidad_pago"] . "</td>";
                        echo "<td>" . $row["cantidad"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No hay ventas registradas</td></tr>";
                }

                // Cerrar conexión a la base de datos al final del script
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Enlace a Bootstrap JS (opcional, solo si lo necesitas) -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
