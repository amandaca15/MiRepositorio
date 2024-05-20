<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmacia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="estilos.css">
</head>
<body>

<!-- Vertical Navbar -->
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


<!-- Page Content -->
<div class="content">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1>Bienvenido a la Farmacia</h1>
                <!-- Sección de productos -->
                <div class="row">
                    <?php
                    // Conexión a la base de datos
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "farmaciabd";
                    $conn = new mysqli($servername, $username, $password, $database);

                    // Verifica la conexión
                    if ($conn->connect_error) {
                        die("Error de conexión: " . $conn->connect_error);
                    }

                    // Consulta SQL para obtener los productos
                    $sql = "SELECT * FROM producto";
                    $result = $conn->query($sql);

                    // Mostrar productos
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<div class='col-md-4'>";
                            echo "<div class='card product-card'>";
                            echo "<img src='uploads/" . $row['imagen'] . "' class='card-img-top' alt='" . $row['nombre'] . "'>";
                            echo "<div class='card-body'>";
                            echo "<h5 class='card-title'>" . $row['nombre'] . "</h5>";
                            echo "<p class='card-text'>" . $row['descripcion'] . "</p>";
                            echo "</div>"; // Cierre de card-body
                            echo "</div>"; // Cierre de card
                            echo "</div>"; // Cierre de col-md-4
                        }
                    } else {
                        echo "<p>No hay productos disponibles.</p>";
                    }

                    // Cierra la conexión
                    $conn->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
