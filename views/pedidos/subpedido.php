
<?php include_once '../templates/header.php'; ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title text-center"><i class="fas fa-plus"></i> Agregar Subpedido</h5>
        <hr>
        <form id="formSubpedido">
            <input type="hidden" id="idPedidoPadre" name="idPedidoPadre" value="<?php echo isset($_GET['idPedidoPadre']) ? intval($_GET['idPedidoPadre']) : ''; ?>">
            <div class="mb-3">
                <label for="producto" class="form-label">Producto</label>
                <input type="text" class="form-control" id="producto" name="producto" placeholder="Buscar producto">
            </div>
            <div class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" value="1">
            </div>
            <div class="mb-3">
                <button type="button" class="btn btn-success" id="agregarProducto">Agregar Producto</button>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="tablaSubpedido">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Guardar Subpedido</button>
            </div>
        </form>
    </div>
</div>

<script>
let productosSubpedido = [];

document.getElementById('agregarProducto').addEventListener('click', function() {
    const producto = document.getElementById('producto').value.trim();
    const cantidad = parseInt(document.getElementById('cantidad').value);
    if (producto && cantidad > 0) {
        productosSubpedido.push({ descripcion: producto, cantidad: cantidad });
        renderTabla();
        document.getElementById('producto').value = '';
        document.getElementById('cantidad').value = 1;
    }
});

function renderTabla() {
    const tbody = document.querySelector('#tablaSubpedido tbody');
    tbody.innerHTML = '';
    productosSubpedido.forEach((prod, idx) => {
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${prod.descripcion}</td><td>${prod.cantidad}</td><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminarProducto(${idx})">Eliminar</button></td>`;
        tbody.appendChild(tr);
    });
}

function eliminarProducto(idx) {
    productosSubpedido.splice(idx, 1);
    renderTabla();
}

document.getElementById('formSubpedido').addEventListener('submit', function(e) {
    e.preventDefault();
    const idPedidoPadre = document.getElementById('idPedidoPadre').value;
    if (productosSubpedido.length === 0) {
        alert('Agrega al menos un producto');
        return;
    }
    // Aquí podrías calcular el total si tienes precios
    const total = 0;
    fetch('../../controllers/Pedidos.php?method=guardarSubpedido', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ idPedidoPadre, productos: productosSubpedido, total })
    })
    .then(res => res.json())
</script>
    .then(data => {
        if (data.type === 'success') {
            alert('Subpedido guardado correctamente');
            // Mostrar botón para imprimir
            mostrarBotonImprimir(data.idSubpedido);
        } else {
            alert('Error al guardar subpedido');
        }
    })
    .catch(() => alert('Error de conexión'));
});

function mostrarBotonImprimir(idSubpedido) {
    // Eliminar el formulario para evitar duplicados
    document.getElementById('formSubpedido').remove();
    // Crear botón de impresión
    const div = document.createElement('div');
    div.className = 'd-grid mt-4';
    div.innerHTML = `<button class="btn btn-info" onclick="window.open('../../controllers/Pedidos.php?method=imprimirSubpedido&id=${idSubpedido}', '_blank')">Imprimir Subpedido</button>
    <a href='../pedidos/index.php' class='btn btn-secondary mt-2'>Volver a Pedidos</a>`;
    document.querySelector('.card-body').appendChild(div);
}
</script>
</script>

<?php include_once '../templates/footer.php'; ?>
