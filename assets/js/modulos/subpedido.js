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
                setTimeout(function(){ $('#buscarProductoNombre').val(''); }, 50);
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
                setTimeout(function(){ e.target.value = ''; }, 50);
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
        const url = base_url + 'pedidos/guardarSubpedido';
        const http = new XMLHttpRequest();
        http.open('POST', url, true);
        http.setRequestHeader('Content-Type', 'application/json');
        http.send(JSON.stringify({ idPedidoPadre, productos: productosSubpedido, total }));
        http.onreadystatechange = function () {
            if (this.readyState == 4) {
                if (this.status == 200) {
                    const data = JSON.parse(this.responseText);
                    if (data.type === 'success') {
                        alert('Subpedido guardado correctamente');
                        mostrarBotonImprimir(data.idSubpedido);
                    } else {
                        alert('Error al guardar subpedido');
                    }
                } else {
                    alert('Error de conexión');
                }
            }
        };
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
                    setTimeout(function(){ $('#buscarProductoCodigo').val(''); }, 50);
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
            nombre: item.label ? item.label : (item.nombre ? item.nombre : item.descripcion),
            precio: item.precio_venta ? item.precio_venta : (item.precio ? item.precio : 0),
            cantidad: item.cantidad ? item.cantidad : 1,
            mediaMh: item.mediaMh ? item.mediaMh : ''
        });
    }
    renderTabla();
    // Limpiar el textbox de búsqueda automáticamente
    if (document.getElementById('containerNombre') && !document.getElementById('containerNombre').classList.contains('d-none')) {
        document.getElementById('buscarProductoNombre').value = '';
    }
    if (document.getElementById('containerCodigo') && !document.getElementById('containerCodigo').classList.contains('d-none')) {
        document.getElementById('buscarProductoCodigo').value = '';
    }
}

function renderTabla() {
    const tbody = document.querySelector('#tablaSubpedido tbody');
    tbody.innerHTML = '';
    productosSubpedido.forEach((prod, idx) => {
        const subTotal = (prod.precio * prod.cantidad).toFixed(2);
        const tr = document.createElement('tr');
        // Mostrar el nombre si existe, si no la descripcion
        const nombreProducto = prod.nombre ? prod.nombre : (prod.descripcion ? prod.descripcion : '');
        tr.innerHTML = `
            <td>${nombreProducto}</td>
            <td><input type="number" class="form-control inputPrecio" data-idx="${idx}" value="${prod.precio}" min="0" step="0.01"></td>
            <td><input type="number" class="form-control inputCantidad" data-idx="${idx}" value="${prod.cantidad}" min="1"></td>
            <td>${subTotal}</td>
            <td><button type="button" class="btn btn-danger btn-sm" onclick="eliminarProducto(${idx})">Eliminar</button></td>
        `;
        tbody.appendChild(tr);
    });
    // Listeners para inputs editables
    tbody.querySelectorAll('.inputPrecio').forEach(input => {
        input.addEventListener('change', function() {
            const idx = parseInt(this.getAttribute('data-idx'));
            productosSubpedido[idx].precio = parseFloat(this.value);
            renderTabla();
        });
    });
    tbody.querySelectorAll('.inputCantidad').forEach(input => {
        input.addEventListener('change', function() {
            const idx = parseInt(this.getAttribute('data-idx'));
            productosSubpedido[idx].cantidad = parseInt(this.value);
            renderTabla();
        });
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
    div.innerHTML = `<button class="btn btn-info" id="btnImprimirSubpedido">Imprimir Subpedido</button>
    <a href='index.php?url=pedidos' class='btn btn-secondary mt-2'>Volver a Pedidos</a>`;
    document.querySelector('.card-body').appendChild(div);
    document.getElementById('btnImprimirSubpedido').addEventListener('click', function() {
        imprimirSubpedido(idSubpedido);
    });
}

function imprimirSubpedido(idSubpedido) {
    const ruta = base_url + 'pedidos/imprimirSubpedido/' + idSubpedido;
    window.open(ruta, '_blank');
    window.location.href = base_url + 'pedidos';
}
