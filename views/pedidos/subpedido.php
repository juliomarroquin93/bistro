<?php include_once 'views/templates/header.php'; ?>

<div class="card">
    <div class="card-body">
        <h5 class="card-title text-center"><i class="fas fa-plus"></i> Agregar Subpedido</h5>
        <hr>
        <div class="row mb-2 justify-content-center">
            <div class="col-md-4">
                <label for="producto" class="form-label">Producto</label>
                <input type="text" class="form-control" id="producto" name="producto" placeholder="Buscar producto">
            </div>
            <div class="col-md-2">
                <label for="cantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" min="1" value="1">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-success w-100" id="agregarProducto">Agregar Producto</button>
            </div>
        </div>
        <div class="table-responsive mb-3">
            <table class="table table-bordered table-striped table-hover align-middle" id="tablaSubpedido" style="width: 100%;">
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
        <form id="formSubpedido">
            <input type="hidden" id="idPedidoPadre" name="idPedidoPadre" value="<?php echo isset($data['idPedidoPadre']) ? intval($data['idPedidoPadre']) : ''; ?>">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Guardar Subpedido</button>
            </div>
        </form>
    </div>
</div>
<?php include_once 'views/templates/footer.php'; ?>


