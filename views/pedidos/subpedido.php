<?php include_once 'views/templates/header.php'; ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title text-center"><i class="fas fa-plus"></i> Agregar Subpedido</h5>
        <hr>
        <div class="row mb-2">
            <div class="col-md-6">
                <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                    <label class="btn btn-primary">
                        <input type="radio" id="barcode" checked name="buscarProducto"><i class="fas fa-barcode"></i> Barcode
                    </label>
                    <label class="btn btn-info">
                        <input type="radio" id="nombre" name="buscarProducto"><i class="fas fa-list"></i> Nombre
                    </label>
                    <div class="btn-group-toggle float-end" data-toggle="buttons">
                        <label class="btn btn-warning">
                            <input type="checkbox" id="chekExento"> Exento
                        </label>
                        <label class="btn btn-success">
                            <input type="radio" id="gasto" name="buscarProducto"><i class="fas fa-list"></i> Servicio
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="input-group mb-2" id="containerCodigo">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input class="form-control" type="text" id="buscarProductoCodigo" placeholder="Ingrese Barcode - Enter" autocomplete="off">
        </div>
        <div class="input-group d-none mb-2" id="containerNombre">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input class="form-control" type="text" id="buscarProductoNombre" placeholder="Buscar Producto" autocomplete="off">
        </div>
        <div class="input-group d-none mb-2" id="containerGasto">
            <span class="input-group-text"><i class="fas fa-search"></i></span>
            <input class="form-control" type="text" id="buscarGasto" placeholder="Ingresar gasto" autocomplete="off">
        </div>
        <span class="text-danger fw-bold mb-2" id="errorBusqueda"></span>
        <div class="table-responsive mb-3">
            <table class="table table-bordered table-striped table-hover align-middle" id="tablaSubpedido" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>SubTotal</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <form id="formSubpedido">
            <input type="hidden" id="idPedidoPadre" name="idPedidoPadre" value="<?php echo isset($data['idPedidoPadre']) ? intval($data['idPedidoPadre']) : ''; ?>">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Guardar Subpedido</button>
            </div>
        </form>
    </div>
</div>
<?php include_once 'views/templates/footer.php'; ?>


