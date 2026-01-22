<!doctype html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL; ?>assets/images/favicon.ico">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <title><?php echo TITLE . ' - ' . $data['title']; ?></title>
</head>
<body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo BASE_URL; ?>admin">Bistro</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL; ?>admin">Inicio</a>
                        </li>
                        <?php if (verificar('pedidos')) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>pedidos">Pedidos</a>
                        </li>
                        <?php } ?>
                        <?php if (verificar('clientes')) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>clientes">Clientes</a>
                        </li>
                        <?php } ?>
                        <?php if (verificar('productos')) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>productos">Productos</a>
                        </li>
                        <?php } ?>
                        <?php if (verificar('ventas')) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BASE_URL; ?>ventas">Ventas</a>
                        </li>
                        <?php } ?>
                        <?php if (verificar('compras')) { ?>
                        <li class="nav-item">
                            <div class="container mt-4">
                                        </div>
                                        <div class="menu-title">Corte Z</div>
                                    </a>
                                </li>
                                 <?php } if (verificar('catalogoCuentas')) { ?> 
                				<li>
                                    <a href="<?php echo BASE_URL . 'catalogoCuentas'; ?>">
                                        <div class="parent-icon"><i class="fa-solid fa-chalkboard-user"></i>
                                        </div>
                                        <div class="menu-title">Catalogo de Cuentas</div>
                                    </a>
                                </li>
                                <?php } ?>		  
                                            <li class="nav-item">
                                                <a class="nav-link active" aria-current="page" href="<?php echo BASE_URL; ?>admin">Inicio</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE_URL; ?>pedidos">Pedidos</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE_URL; ?>clientes">Clientes</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="<?php echo BASE_URL; ?>productos">Productos</a>
                                            </li>
                                        </ul>
                                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img src="<?php echo isset($_SESSION['perfil_usuario']) && $_SESSION['perfil_usuario'] ? BASE_URL . $_SESSION['perfil_usuario'] : BASE_URL . 'assets/images/logo.png'; ?>" class="rounded-circle" width="30" height="30" alt="user avatar">
                                                    <?php echo $_SESSION['nombre_usuario']; ?>
                                                </a>
                                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                                    <li><a class="dropdown-item" href="<?php echo BASE_URL . 'usuarios/profile'; ?>">Perfil</a></li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="<?php echo BASE_URL . 'usuarios/salir'; ?>">Salir</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </nav>
                            <div class="container mt-4">