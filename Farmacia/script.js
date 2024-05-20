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
}