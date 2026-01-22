// Redirección desde el botón de la tabla de pedidos
// subpedido.js
let productosSubpedido = [];

document.addEventListener('DOMContentLoaded', function() {
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

    document.getElementById('formSubpedido').addEventListener('submit', function(e) {
        e.preventDefault();
        const idPedidoPadre = document.getElementById('idPedidoPadre').value;
        if (productosSubpedido.length === 0) {
            alert('Agrega al menos un producto');
            return;
        }
        // Aquí podrías calcular el total si tienes precios
        const total = 0;
        fetch('controllers/Pedidos.php?method=guardarSubpedido', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ idPedidoPadre, productos: productosSubpedido, total })
        })
        .then(res => res.json())
        .then(data => {
            if (data.type === 'success') {
                alert('Subpedido guardado correctamente');
                mostrarBotonImprimir(data.idSubpedido);
            } else {
                alert('Error al guardar subpedido');
            }
        })
        .catch(() => alert('Error de conexión'));
    });
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

function mostrarBotonImprimir(idSubpedido) {
    document.getElementById('formSubpedido').remove();
    const div = document.createElement('div');
    div.className = 'd-grid mt-4';
    div.innerHTML = `<button class="btn btn-info" onclick="window.open('controllers/Pedidos.php?method=imprimirSubpedido&id=${idSubpedido}', '_blank')">Imprimir Subpedido</button>
    <a href='index.php?url=pedidos' class='btn btn-secondary mt-2'>Volver a Pedidos</a>`;
    document.querySelector('.card-body').appendChild(div);
}
