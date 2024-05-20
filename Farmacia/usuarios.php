<?php
session_start(); // Iniciar la sesión si no está iniciada

// Si el usuario hace clic en el botón de cerrar sesión
if (isset($_POST['logout'])) {
    // Destruir la sesión
    session_destroy();
    
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: login.php");
    exit(); // Detener el script después de redirigir
}

// Establecer conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "farmaciabd";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener la información del último usuario que inició sesión
$sql = "SELECT * FROM usuarios ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

// Variables para almacenar los datos del usuario
$email = "";
$password = "";
$usuario = "";
$codigo_verificacion = "";
$estado_cuenta = "";

if ($result->num_rows > 0) {
    // Obtener los datos del último usuario
    $row = $result->fetch_assoc();
    $email = $row["email"];
    $password = $row["password"];
    $usuario = $row["usuario"];
    $codigo_verificacion = $row["codigo_verificacion"];
    $estado_cuenta = $row["estado_cuenta"];
}

// Cerrar conexión a la base de datos
$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Usuario</title>
    <!-- Enlaces a archivos CSS -->
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


<!-- Información del Usuario -->
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Usuario</h5>
                    <p class="card-text">Email: <?php echo htmlspecialchars($email); ?></p>
                    <p class="card-text">Nombre de Usuario: <?php echo htmlspecialchars($usuario); ?></p>
                    <p class="card-text">Estado de la Cuenta: <?php echo ($estado_cuenta == 1) ? 'Activa' : 'Inactiva'; ?></p>
                    
                    <!-- Botón de cerrar sesión -->
                    <form method="post">
                        <button type="submit" class="btn btn-danger" name="logout">Cerrar Sesión</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enlaces a archivos JS (opcional, solo si los necesitas) -->
<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
