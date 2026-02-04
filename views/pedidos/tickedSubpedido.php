<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL . 'assets/css/ticked.css'; ?>">
</head>
<body>
<img src="<?php echo BASE_URL . 'assets/images/logo.png'; ?>" alt="">
    <div class="datos-empresa">
        <p><?php echo $data['empresa']['nombre']; ?></p>
        <p>Reg: <?php echo $data['empresa']['registro']; ?></p>
        <p>Tel:<?php echo $data['empresa']['telefono']; ?></p>
        <br><br>
    </div>
    <h5 class="title">Datos del Usuario</h5>
    <div class="datos-info">
        <p><strong>Usuario que hizo el subpedido: </strong> <?php echo $data['usuario_subpedido']; ?></p>
    </div>
    <h5 class="title">Comprobante de Subpedido</h5>
    <div class="datos-factu"> 
        <p><strong>Fecha: </strong> <?php echo $data['subpedido']['fecha']; ?></p>
        <p><strong>Hora: </strong> <?php echo $data['subpedido']['hora']; ?></p>
         <p><strong>Mesa: </strong> <?php echo $data['venta']['mesas']; ?></p>
         <p><strong>Cliente: </strong> <?php echo $data['venta']['observaciones']; ?></p>
        <p><strong>ID Pedido Padre: </strong> <?php echo $data['subpedido']['id_pedido_padre']; ?></p>
        <p><strong>ID Subpedido: </strong> <?php echo $data['idSubpedido']; ?></p>
    </div>
    <h5 class="title">Detalle de los Productos</h5>
    <table>
        <thead>
            <tr>
                <th>Cant</th>
                <th>Descripcion</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $productos = json_decode($data['subpedido']['productos'], true);
            foreach ($productos as $producto) { ?>
                <tr>
                    <td><?php echo $producto['cantidad']; ?></td>
                    <td><?php echo isset($producto['nombre']) ? $producto['nombre'] : (isset($producto['descripcion']) ? $producto['descripcion'] : ''); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>