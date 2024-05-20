<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto - Farmacia</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
        }
        .navbar-vertical {
            width: 250px;
            position: fixed;
            top: 0;
            bottom: 0;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
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
                <h1>Agregar Producto</h1>
                <form action="conexProductos.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre del Producto</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio</label>
                        <input type="number" class="form-control" id="precio" name="precio" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="existencia" class="form-label">Existencia</label>
                        <input type="number" class="form-control" id="existencia" name="existencia" required>
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="id_categoria" class="form-label">Categoría</label>
                        <select class="form-select" id="id_categoria" name="id_categoria" required>
                            <option value="">Selecciona una categoría</option>
                            <!-- Aquí se cargarán las opciones de categoría desde la base de datos -->
                            <?php
                            // Conexión a la base de datos
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $database = "farmaciabd";
                            $conn = new mysqli($servername, $username, $password, $database);
                            if ($conn->connect_error) {
                                die("Error de conexión: " . $conn->connect_error);
                            }

                            // Consulta para obtener las categorías
                            $sql = "SELECT id_categoria, nombre FROM categoria_producto";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['id_categoria'] . "'>" . $row['nombre'] . "</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                    <label for="id_proveedor" class="form-label">Proveedor</label>
                    <select class="form-select" id="id_proveedor" name="id_proveedor" required>
                        <option value="">Selecciona un proveedor</option>
                        <!-- Aquí se cargarán las opciones de proveedores desde la base de datos -->

                        <?php
                                                 
                            // Conexión a la base de datos
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $database = "farmaciabd";
                            $conn = new mysqli($servername, $username, $password, $database);
                            if ($conn->connect_error) {
                                die("Error de conexión: " . $conn->connect_error);
                            }
                        // Consulta para obtener los proveedores
                        $sql_proveedores = "SELECT id_proveedor, nombre FROM proveedor";
                        $result_proveedores = $conn->query($sql_proveedores);

                        if ($result_proveedores->num_rows > 0) {
                            while ($row_proveedor = $result_proveedores->fetch_assoc()) {
                                echo "<option value='" . $row_proveedor['id_proveedor'] . "'>" . $row_proveedor['nombre'] . "</option>";
                            }
                        }
                        ?>
                    </select>
                </div>

                    <div class="mb-3">
                        <label for="imagen" class="form-label">Imagen del Producto</label>
                        <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Producto</button>
                </form>

                <!-- Después del formulario de agregar producto -->

                <div class="mt-5">
                    <h2>Productos</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Precio</th>
                                    <th>Existencia</th>
                                    <th>Descripción</th>
                                    <th>Categoría</th>
                                    <th>Imagen</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Consulta para obtener los productos
                                $sql_productos = "SELECT p.nombre, p.precio, p.existencia, p.descripcion, cp.nombre AS categoria, p.imagen FROM producto p INNER JOIN categoria_producto cp ON p.id_categoria = cp.id_categoria";
                                $result_productos = $conn->query($sql_productos);

                                if ($result_productos->num_rows > 0) {
                                    while ($row_producto = $result_productos->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row_producto['nombre'] . "</td>";
                                        echo "<td>" . $row_producto['precio'] . "</td>";
                                        echo "<td>" . $row_producto['existencia'] . "</td>";
                                        echo "<td>" . $row_producto['descripcion'] . "</td>";
                                        echo "<td>" . $row_producto['categoria'] . "</td>";
                                        echo "<td><img src='uploads/" . $row_producto['imagen'] . "' style='max-width: 100px;' alt='Imagen del Producto'></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No hay productos disponibles</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
