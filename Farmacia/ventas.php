<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realizar Venta</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
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

<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h2 class="text-center">Realizar Venta</h2>
            <form action="conexVenta.php" method="POST">
                <div class="form-group">
                    <label for="categoria">Seleccione Categoría</label>
                    <select class="form-control" id="categoria" name="categoria" onchange="fetchProductos(this.value)">
                        <option value="">Seleccione una categoría</option>
                        <?php
                        $servername = "localhost";
                        $username = "root";
                        $password = "";
                        $dbname = "farmaciabd";
                        
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        
                        if ($conn->connect_error) {
                            die("Conexión fallida: " . $conn->connect_error);
                        }
                        $query = "SELECT * FROM categoria_producto";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id_categoria']}'>{$row['nombre']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="producto">Seleccione Producto</label>
                    <select class="form-control" id="producto" name="producto" onchange="updatePrice()">
                        <option value="">Seleccione un producto</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" oninput="updatePrice()">
                </div>
                <div class="form-group">
                    <label for="precio">Precio Total</label>
                    <input type="text" class="form-control" id="precio" name="precio" readonly>
                </div>
                <input type="hidden" name="precio_unitario" id="precio_unitario" value="precio_unitario_del_producto">

                <div class="form-group">
                    <h4>Datos del Cliente</h4>
                    <label for="nombre_cliente">Nombre</label>
                    <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" required>
                    <label for="telefono_cliente">Teléfono</label>
                    <input type="text" class="form-control" id="telefono_cliente" name="telefono_cliente" required>
                    <label for="direccion_cliente">Dirección</label>
                    <input type="text" class="form-control" id="direccion_cliente" name="direccion_cliente" required>
                </div>
                <!-- Se agregarán campos ocultos para enviar solo los IDs -->
                <input type="hidden" id="id_categoria_hidden" name="id_categoria_hidden">
                <input type="hidden" id="id_producto_hidden" name="id_producto_hidden">
                <button type="submit" class="btn btn-primary">Realizar Venta</button>
            </form>
        </div>
    </div>
</div>

<script>
    function fetchProductos(idCategoria) {
        if (idCategoria == "") {
            document.getElementById("producto").innerHTML = "<option value=''>Seleccione un producto</option>";
            return;
        }
        fetch('fetch_productos.php?id_categoria=' + idCategoria)
        .then(response => response.json())
        .then(data => {
            let productosSelect = document.getElementById("producto");
            productosSelect.innerHTML = "<option value=''>Seleccione un producto</option>";
            data.forEach(producto => {
                productosSelect.innerHTML += `<option value='${producto.id_producto}' data-precio='${producto.precio}'>${producto.nombre}</option>`;
            });
        });
        // Establecer el valor del campo oculto id_categoria_hidden
        document.getElementById("id_categoria_hidden").value = idCategoria;
    }

    function updatePrice() {
        let productoSelect = document.getElementById("producto");
        let cantidad = document.getElementById("cantidad").value;
        let precio = productoSelect.options[productoSelect.selectedIndex].getAttribute('data-precio');
        if (precio && cantidad) {
            document.getElementById("precio").value = (precio * cantidad).toFixed(2);
        } else {
            document.getElementById("precio").value = '';
        }
        // Establecer el valor del campo oculto id_producto_hidden
        document.getElementById("id_producto_hidden").value = productoSelect.value;
    }
</script>

</body>
</html>
