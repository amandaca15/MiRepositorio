<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmacia - Categorías</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
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
            <div class="col-md-6">
                <h2>Agregar Nueva Categoría</h2>
                <form action="conexCategorias.php" method="POST">
                    <div class="mb-3">
                        <label for="nombre_categoria" class="form-label">Nombre de la Categoría</label>
                        <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion_categoria" class="form-label">Descripcion de la Categoría</label>
                        <input type="text" class="form-control" id="descripcion_categoria" name="descripcion_categoria" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Categoría</button>
                </form>
            </div>
            <div class="col-md-6">
                <h2>Categorías Registradas</h2>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
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

                            // Consulta SQL para obtener las categorías
                            $sql = "SELECT * FROM categoria_producto";
                            $result = $conn->query($sql);

                            // Mostrar categorías
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id_categoria'] . "</td>";
                                    echo "<td>" . $row['nombre'] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='2'>No hay categorías registradas.</td></tr>";
                            }

                            // Cierra la conexión
                            $conn->close();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
