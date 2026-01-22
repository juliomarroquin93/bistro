<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL; ?>assets/images/favicon.ico">
    <!-- Bootstrap 5 Modern -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <title><?php echo TITLE . ' - ' . $data['title']; ?></title>
</head>

<body>
    <!--wrapper-->
        <!-- Menú Bootstrap Moderno -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Bistro</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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
                        <li> <a href="<?php echo BASE_URL . 'productos'; ?>"><i class="bx bx-right-arrow-alt"></i>Productos</a>
                        </li>
						<?php } if (verificar('bodegas')) { ?>
                        <li> <a href="<?php echo BASE_URL . 'bodegas'; ?>"><i class="bx bx-right-arrow-alt"></i>Bodegas</a>
                        </li>
						<?php } if (verificar('contingencias')) { ?>
                        <li> <a href="<?php echo BASE_URL . 'contingencias'; ?>"><i class="bx bx-right-arrow-alt"></i>Contingencias</a>
                        </li>
                        <?php }if (verificar('tasaMora') || verificar('medidas') || verificar('categorias') || verificar('productos') || verificar('bodegas')|| verificar('contingencias')) { ?>
                    </ul>
                </li>
                <?php } ?>
                
                <!--FIN DESDE AQUI PUSE EL CODIGO DE NUEVO SI ES NECESARIO QUITARLO LO QUITAS PARA NO INTERFERIR CON TU PROGRAMACION SI ESTA BIEN DEJARLO-->
                
                
                <?php  if (verificar('tipoProducto')) { ?>
                <li>
                    <a href="<?php echo BASE_URL . 'tipoProducto'; ?>">
                        <div class="parent-icon"><i class="fa-solid fa-boxes-stacked"></i>
                        </div>
                        <div class="menu-title">Tipo de Producto</div>
                    </a>
                </li>
                
                <?php }  if (verificar('clientes')) { ?>
                <li>
                    <a href="<?php echo BASE_URL . 'clientes'; ?>">
                        <div class="parent-icon"><i class="fa-solid fa-people-group"></i>
                        </div>
                        <div class="menu-title">Clientes</div>
                    </a>
                </li>
                
                <?php }  if (verificar('proveedores')) { ?>
                <li>
                    <a href="<?php echo BASE_URL . 'clientes2'; ?>">
                        <div class="parent-icon"><i class="fa-solid fa-people-carry-box"></i>
                        </div>
                        <div class="menu-title">Proveedores</div>
                    </a>
                </li>


                <?php }  if (verificar('cajas')) { ?>
                <li>
                    <a href="<?php echo BASE_URL . 'cajas'; ?>">
                        <div class="parent-icon"><i class="fa-solid fa-box-open"></i>
                        </div>
                        <div class="menu-title">Cajas</div>
                    </a>
                </li> 
				
                <?php } if (verificar('salidas') ) { ?>
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="fa-solid fa-arrow-right-arrow-left"></i>
                            </div>
                            <div class="menu-title">Traslados</div>
                        </a>
                        <ul>
                            <?php } if (verificar('salidas')) { ?>
                            <li> <a href="<?php echo BASE_URL . 'salidas'; ?>"><i class="bx bx-right-arrow-alt"></i>Movimientos</a>
                            </li>
                        </ul>
                    </li>
					<?php } if (verificar('ingresos') && ! verificar('salidas') ) { ?>
					</ul>
                    </li>
					<?php } if ((verificar('pedidos')) || (verificar('FacturarPedidos')) || (verificar('despacho')) ) { ?>
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="fa-regular fa-id-badge"></i>
                            </div>
                            <div class="menu-title">Pedidos</div>
                        </a>
                        <ul>
                            <?php } if (verificar('pedidos')) { ?>
                            <li> <a href="<?php echo BASE_URL . 'pedidos'; ?>"><i class="bx bx-right-arrow-alt"></i>Nuevo Pedido</a>
                            </li>
                           
                            <?php } if (verificar('FacturarPedidos')) { ?>
                            <li> <a href="<?php echo BASE_URL . 'pedidos/facturacion'; ?>"><i class="bx bx-right-arrow-alt"></i>Facturacion</a>
                            </li>
							<?php } if (verificar('despacho')) { ?>
                            <li> <a href="<?php echo BASE_URL . 'pedidos/despacho'; ?>"><i class="bx bx-right-arrow-alt"></i>Despacho</a>
                            </li>
					<?php } if (verificar('pedidos') || verificar('FacturarPedidos') || verificar('despacho') ) { ?>
					</ul>
                    </li>
                <?php } if (verificar('compras')) { ?>
				
                <li>
                    <a href="<?php echo BASE_URL . 'ventas2'; ?>">
                        <div class="parent-icon"><i class="fa-solid fa-credit-card"></i>
                        </div>
                        <div class="menu-title">Compras</div>
                    </a>
                </li>



                <?php }  if (verificar('ventas')) { ?>
                <li>
                    <a href="<?php echo BASE_URL . 'ventas'; ?>">
                        <div class="parent-icon"><i class="fa-solid fa-cash-register"></i>
                        </div>
                        <div class="menu-title">Ventas</div>
                    </a>
                </li>

                 <?php }  if (verificar('requisiciones')) { ?>
                <li>
                    <a href="<?php echo BASE_URL . 'requisiciones'; ?>">
                        <div class="parent-icon"><i class="fa-solid fa-cart-shopping"></i>
                        </div>
                        <div class="menu-title">Requisiciones</div>
                    </a>
                </li>
                <?php }  if (verificar('OrdenesCompras')) { ?>
                <li>
                    <a href="<?php echo BASE_URL . 'ordenesCompra/listado'; ?>">
                        <div class="parent-icon"><i class="fa-solid fa-file-invoice-dollar"></i>
                        </div>
                        <div class="menu-title">Órdenes de Compra</div>
                    </a>
                </li>
				
				<?php }if (verificar('Nota de credito')) { ?>
                <li>
                    <a href="<?php echo BASE_URL . 'notaCredito'; ?>">
                        <div class="parent-icon"><i class="fa-solid fa-bars-staggered"></i>
                        </div>
                        <div class="menu-title">Nota de crédito</div>
                    </a>
                </li>



                <?php }  if (verificar('cuentas por cobrar')) { ?>
                <li>
                    <a href="<?php echo BASE_URL . 'creditos'; ?>">
                        <div class="parent-icon"><i class="fa-solid fa-hand-holding-heart"></i>
                        </div>
                        <div class="menu-title">Cuentas por cobrar</div>
                    </a>
                </li>




                <?php }  if (verificar('cuentas por pagar')) { ?>
                <li>
                    <a href="<?php echo BASE_URL . 'creditos2'; ?>">
                        <div class="parent-icon"><i class="fa-solid fa-money-bill-wave"></i>
                        </div>
                        <div class="menu-title">Cuentas por pagar</div>
                    </a>
                </li>




                <?php }  if (verificar('formulario medico')) { ?>
                <li>
                    <a href="<?php echo BASE_URL . 'cotizaciones2'; ?>">
                        <div class="parent-icon"><i class="fa-solid fa-glasses"></i>
                        </div>
                        <div class="menu-title">Formulario Medico</div>
                    </a>
                </li>

                <?php }  if (verificar('cotizaciones')) { ?>
                <li>
                    <a href="<?php echo BASE_URL . 'cotizaciones'; ?>">
                        <div class="parent-icon"><i class="fa-solid fa-book-open-reader"></i>
                        </div>
                        <div class="menu-title">Cotizaciones</div>
                    </a>
                </li>


                <?php }  if (verificar('apartados')) { ?>
                <li>
                    <a href="<?php echo BASE_URL . 'apartados'; ?>">
                        <div class="parent-icon"><i class="fa-solid fa-people-arrows"></i>
                        </div>
                        <div class="menu-title">Apartados</div>
                    </a>
                </li>
				
				  <?php }  if (verificar('librosIva')) { ?>
                <li>
                    <a href="<?php echo BASE_URL . 'librosIva'; ?>">
                        <div class="parent-icon"><i class="fa-solid fa-file-lines"></i>
                        </div>
                        <div class="menu-title">Libros de IVA</div>
                    </a>
                </li>

                <?php }  if (verificar('inventario y kardex')) { ?>
                <li>
                    <a href="<?php echo BASE_URL . 'inventarios'; ?>">
                        <div class="parent-icon"><i class="fa-solid fa-list-check"></i>
                        </div>
                        <div class="menu-title">Inventario & Kardex</div>
                    </a>
                </li>
                <?php }  if (verificar('Cortez')) { ?> 
				<li>
                    <a href="<?php echo BASE_URL . 'cortez'; ?>">
                        <div class="parent-icon"><i class="fa-solid fa-circle-dollar-to-slot"></i>
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
            </ul>
            
            <!--end navigation-->
        </div>
        <!--end sidebar wrapper -->
        <!--start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>
                    <div class="search-bar flex-grow-1">
                        <div class="position-relative">
                            <h6><?php echo TITLE; ?></h6>
                        </div>
                    </div>
                    <div class="user-box dropdown">
                        <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php if ($_SESSION['perfil_usuario'] == null) {
                                $perfil = BASE_URL . 'assets/images/logo.png';
                            } else {
                                $perfil = BASE_URL . $_SESSION['perfil_usuario'];
                            } ?>
                            <img src="<?php echo $perfil; ?>" class="user-img" alt="user avatar">
                            <!-- Menú Bootstrap Moderno -->
                            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                                <div class="container-fluid">
                                    <a class="navbar-brand" href="#">Bistro</a>
                                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarNav">
                                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
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