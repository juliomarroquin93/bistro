let productosSubpedido = [];

document.addEventListener('DOMContentLoaded', function() {
    // Alternar inputs de búsqueda
    document.getElementById('nombre').addEventListener('click', function () {
        document.getElementById('containerCodigo').classList.add('d-none');
        document.getElementById('containerNombre').classList.remove('d-none');
        document.getElementById('containerGasto').classList.add('d-none');
        document.getElementById('buscarProductoNombre').value = '';
        document.getElementById('errorBusqueda').textContent = '';
        document.getElementById('buscarProductoNombre').focus();
    });
    document.getElementById('barcode').addEventListener('click', function () {
        document.getElementById('containerNombre').classList.add('d-none');
        document.getElementById('containerCodigo').classList.remove('d-none');
        document.getElementById('containerGasto').classList.add('d-none');
        document.getElementById('buscarProductoCodigo').value = '';
        document.getElementById('errorBusqueda').textContent = '';
        document.getElementById('buscarProductoCodigo').focus();
    });
    document.getElementById('gasto').addEventListener('click', function () {
        document.getElementById('containerNombre').classList.add('d-none');
        document.getElementById('containerCodigo').classList.add('d-none');
        document.getElementById('containerGasto').classList.remove('d-none');
        document.getElementById('buscarGasto').value = '';
        document.getElementById('errorBusqueda').textContent = '';
        document.getElementById('buscarGasto').focus();
    });

    // Autocomplete para productos por nombre
    $("#buscarProductoNombre").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: base_url + 'productos/buscarPorNombre',
                dataType: "json",
                data: { term: request.term },
                success: function (data) {
                    response(data);
                    if (data.length === 0) {
                        $('#errorBusqueda').text('NO HAY PRODUCTO CON ESE NOMBRE');
                    } else {
                        $('#errorBusqueda').text('');
                    }
                }
            });
        },
        minLength: 2,
        select: function (event, ui) {
            agregarProductoCatalogo(ui.item);
            $('#buscarProductoNombre').val('');
        }
    });

    // Buscar por código de barras
    document.getElementById('buscarProductoCodigo').addEventListener('keyup', function(e) {
        if (e.keyCode === 13) {
            buscarProductoPorCodigo(e.target.value);
        }
    });

    // Agregar gasto/servicio
    document.getElementById('buscarGasto').addEventListener('keyup', function(e) {
        if (e.keyCode === 13) {
            agregarProductoCatalogo({ descripcion: e.target.value, precio_venta: 0, cantidad: 1, id: 0 });
            e.target.value = '';
        }
    });

    document.getElementById('formSubpedido').addEventListener('submit', function(e) {
        e.preventDefault();
        const idPedidoPadre = document.getElementById('idPedidoPadre').value;
        if (productosSubpedido.length === 0) {
            alert('Agrega al menos un producto');
            return;
        }
        const total = productosSubpedido.reduce((acc, prod) => acc + (prod.precio * prod.cantidad), 0);
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

function buscarProductoPorCodigo(codigo) {
    $.ajax({
        url: base_url + 'productos/buscarPorCodigo',
        dataType: "json",
        data: { term: codigo },
        success: function (data) {
            if (data && data.id) {
                agregarProductoCatalogo(data);
                $('#buscarProductoCodigo').val('');
                $('#errorBusqueda').text('');
            } else {
                $('#errorBusqueda').text('CODIGO NO EXISTE');
            }
        }
    });
}

function agregarProductoCatalogo(item) {
    // Si ya existe, suma cantidad
    const idx = productosSubpedido.findIndex(p => p.id === item.id);
    if (idx !== -1) {
        productosSubpedido[idx].cantidad += 1;
    } else {
        productosSubpedido.push({
            id: item.id,
            descripcion: item.descripcion,
            precio: item.precio_venta,
            cantidad: 1
        });
    }
    renderTabla();
}

function renderTabla() {
    const tbody = document.querySelector('#tablaSubpedido tbody');
    tbody.innerHTML = '';
    productosSubpedido.forEach((prod, idx) => {
        const subTotal = (prod.precio * prod.cantidad).toFixed(2);
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${prod.descripcion}</td><td>${prod.precio}</td><td>${prod.cantidad}</td><td>${subTotal}</td><td><button type="button" class="btn btn-danger btn-sm" onclick="eliminarProducto(${idx})">Eliminar</button></td>`;
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
