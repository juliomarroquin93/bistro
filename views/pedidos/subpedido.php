<?php include_once 'views/templates/header.php'; ?>

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
<?php include_once 'views/templates/footer.php'; ?>


