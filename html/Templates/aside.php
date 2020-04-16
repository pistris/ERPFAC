<?php

session_start();

require("conexionPDO.php");
$conexion = new Conexion;
$sql = "SELECT 
            tbl4.*
        FROM
        tCatUsuario tbl1
            INNER JOIN
        tCatPlanPago tbl2 ON tbl2.intPlanPago = tbl1.intPlanPago
            INNER JOIN
        tPlanPagoModulo tbl3 ON tbl3.intPlanPago = tbl1.intPlanPago
            INNER JOIN
        tCatModulo tbl4 ON tbl4.intModulo = tbl3.intModulo
        WHERE
        tbl1.intUsuario = ".$_SESSION['intUsuario'];
$sqlModulos = $conexion->Query($sql);
//print_r($sqlModulos);
?>

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-xl navbar-light fixed-top hk-navbar">
        <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="menu"></i></span></a>
        <a class="navbar-brand font-weight-700" href="dashboard.php">
            Marvin
        </a>
        <ul class="navbar-nav hk-navbar-content">
            <li class="nav-item">
                <a id="settings_toggle_btn" class="nav-link nav-link-hover" href="javascript:void(0);"><span class="feather-icon"><i data-feather="settings"></i></span></a>
            </li>
            <!--<li class="nav-item dropdown dropdown-notifications">
                <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="feather-icon"><i data-feather="bell"></i></span><span class="badge-wrap"><span class="badge badge-primary badge-indicator badge-indicator-sm badge-pill pulse"></span></span></a>
                <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                    <h6 class="dropdown-header">Notifications <a href="javascript:void(0);" class="">View all</a></h6>
                    <div class="notifications-nicescroll-bar">
                        <a href="javascript:void(0);" class="dropdown-item">
                            <div class="media">
                                <div class="media-img-wrap">
                                    <div class="avatar avatar-sm">
                                        <img src="../dist/img/avatar1.jpg" alt="user" class="avatar-img rounded-circle">
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div>
                                        <div class="notifications-text"><span class="text-dark text-capitalize">Evie Ono</span> accepted your invitation to join the team</div>
                                        <div class="notifications-time">12m</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <div class="media">
                                <div class="media-img-wrap">
                                    <div class="avatar avatar-sm">
                                        <img src="../dist/img/avatar2.jpg" alt="user" class="avatar-img rounded-circle">
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div>
                                        <div class="notifications-text">New message received from <span class="text-dark text-capitalize">Misuko Heid</span></div>
                                        <div class="notifications-time">1h</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <div class="media">
                                <div class="media-img-wrap">
                                    <div class="avatar avatar-sm">
                                        <span class="avatar-text avatar-text-primary rounded-circle">
                                                <span class="initial-wrap"><span><i class="zmdi zmdi-account font-18"></i></span></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div>
                                        <div class="notifications-text">You have a follow up with<span class="text-dark text-capitalize"> Marvin head</span> on <span class="text-dark text-capitalize">friday, dec 19</span> at <span class="text-dark">10.00 am</span></div>
                                        <div class="notifications-time">2d</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <div class="media">
                                <div class="media-img-wrap">
                                    <div class="avatar avatar-sm">
                                        <span class="avatar-text avatar-text-success rounded-circle">
                                                <span class="initial-wrap"><span>A</span></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div>
                                        <div class="notifications-text">Application of <span class="text-dark text-capitalize">Sarah Williams</span> is waiting for your approval</div>
                                        <div class="notifications-time">1w</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="javascript:void(0);" class="dropdown-item">
                            <div class="media">
                                <div class="media-img-wrap">
                                    <div class="avatar avatar-sm">
                                        <span class="avatar-text avatar-text-warning rounded-circle">
                                                <span class="initial-wrap"><span><i class="zmdi zmdi-notifications font-18"></i></span></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <div>
                                        <div class="notifications-text">Last 2 days left for the project</div>
                                        <div class="notifications-time">15d</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </li>-->
            <li class="nav-item dropdown dropdown-authentication">
                <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media">
                        <div class="media-img-wrap">
                            <div class="avatar">
                                <img src="../dist/img/avatar12.jpg" alt="user" class="avatar-img rounded-circle">
                            </div>
                            <span class="badge badge-success badge-indicator"></span>
                        </div>
                        <div class="media-body">
                            <span><?= $_SESSION['varUsuario'] ?><i class="zmdi zmdi-chevron-down"></i></span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <a class="dropdown-item" href="#"><i class="dropdown-icon zmdi zmdi-account"></i><span>Perfil</span></a>
                    <a class="dropdown-item" href="ConfiguracionEmpresa.php"><i class="dropdown-icon zmdi zmdi-account"></i><span>Empresa</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php"><i class="dropdown-icon zmdi zmdi-power"></i><span>Cerrar Sesión</span></a>
                </div>
            </li>
        </ul>
    </nav>
    <form role="search" class="navbar-search">
        <div class="position-relative">
            <a href="javascript:void(0);" class="navbar-search-icon"><span class="feather-icon"><i data-feather="search"></i></span></a>
            <input type="text" name="example-input1-group2" class="form-control" placeholder="Type here to Search">
            <a id="navbar_search_close" class="navbar-search-close" href="#"><span class="feather-icon"><i data-feather="x"></i></span></a>
        </div>
    </form>
    <!-- /Top Navbar -->

    <!-- Vertical Nav -->
    <nav class="hk-nav hk-nav-dark">
        <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
        <div class="nicescroll-bar">
            <div class="navbar-nav-wrap">
                <ul class="navbar-nav flex-column">


                <?php
                    foreach ($sqlModulos as $key => $value) {
                        if($value->intModulo == 1){
                ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#dash_drp">
                                <i class="<?= $value->varIcono ?>" aria-hidden="true"></i>
                                <span class="nav-link-text"><?= $value->varNombre ?></span>
                            </a>
                            <ul id="dash_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item active">
                                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#empresas_drp">Empresas</a>
                                        </li>
                                        <ul id="empresas_drp" class="nav flex-column collapse collapse-level-1">
                                            <li class="nav-item">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item active">
                                                        <a class="nav-link" href="CatalogoEmpresas.php">Catalo de Empresas</a>
                                                    </li>
                                                    <li class="nav-item active">
                                                        <a class="nav-link" href="CatalogoFranquicias.php">Catalo de Franquicias</a>
                                                    </li>
                                                    <li class="nav-item active">
                                                        <a class="nav-link" href="#">Catalo de Usuarios</a>
                                                    </li>
                                                
                                                </ul>
                                            </li>
                                        </ul>
                                    
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    <?php 
                        } 
                        if($value->intModulo == 2){                            
                    ?> 
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#prod_drp">
                            <i class="<?= $value->varIcono ?>" aria-hidden="true"></i>
                                <span class="nav-link-text"><?= $value->varNombre ?></span>
                            </a>
                            <ul id="prod_drp" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="CategoriaProductos.php">Categoria de Productos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="Productos.php">Productos</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    <?php 
                        } 
                        if($value->intModulo == 3){                            
                    ?>                         
                        <li class="nav-item">
                            <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#prod_cli">
                                <i class="<?= $value->varIcono ?>" aria-hidden="true"></i>
                                <span class="nav-link-text"><?= $value->varNombre ?></span>
                            </a>
                            <ul id="prod_cli" class="nav flex-column collapse collapse-level-1">
                                <li class="nav-item">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="CategoriaClientes.php">Categoria de Clientes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="Clientes.php">Clientes</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    <?php 
                        } 
                        if($value->intModulo == 4){
                        }
                    ?> 



                
                <?php } ?> 



                    
                    <!--<li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#auth_drp">
                            <span class="feather-icon"><i data-feather="zap"></i></span>
                            <span class="nav-link-text">Authentication</span>
                        </a>
                        <ul id="auth_drp" class="nav flex-column collapse collapse-level-1">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#signup_drp">
                                                Sign Up
                                            </a>
                                        <ul id="signup_drp" class="nav flex-column collapse collapse-level-2">
                                            <li class="nav-item">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="signup.html">Cover</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="signup-simple.html">Simple</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#signin_drp">
                                                Login
                                            </a>
                                        <ul id="signin_drp" class="nav flex-column collapse collapse-level-2">
                                            <li class="nav-item">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="login.html">Cover</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="login-simple.html">Simple</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="javascript:void(0);" data-toggle="collapse" data-target="#recover_drp">
                                                Recover Password
                                            </a>
                                        <ul id="recover_drp" class="nav flex-column collapse collapse-level-2">
                                            <li class="nav-item">
                                                <ul class="nav flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="forgot-password.html">Forgot Password</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="reset-password.html">Reset Password</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="lock-screen.html">Lock Screen</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="404.html">Error 404</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="maintenance.html">Maintenance</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>-->
                </ul>
                <hr class="nav-separator">
                
            </div>
        </div>
    </nav>
    <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
    <!-- /Vertical Nav -->

    <!-- Setting Panel -->
    <div class="hk-settings-panel">
        <div class="nicescroll-bar position-relative">
            <div class="settings-panel-wrap">
                <div class="settings-panel-head">
                    <a href="javascript:void(0);" id="settings_panel_close" class="settings-panel-close"><span class="feather-icon"><i data-feather="x"></i></span></a>
                </div>
                <hr>
                
                <h6 class="mb-5">Navigation</h6>
                <p class="font-14">Menu comes in two modes: dark & light</p>
                <div class="button-list hk-nav-select mb-10">
                    <button type="button" id="nav_light_select" class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-sun-o"></i> </span><span class="btn-text">Light Mode</span></button>
                    <button type="button" id="nav_dark_select" class="btn btn-outline-primary btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-moon-o"></i> </span><span class="btn-text">Dark Mode</span></button>
                </div>
                <hr>
                <h6 class="mb-5">Top Nav</h6>
                <p class="font-14">Choose your liked color mode</p>
                <div class="button-list hk-navbar-select mb-10">
                    <button type="button" id="navtop_light_select" class="btn btn-outline-light btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-sun-o"></i> </span><span class="btn-text">Light Mode</span></button>
                    <button type="button" id="navtop_dark_select" class="btn btn-outline-primary btn-sm btn-wth-icon icon-wthot-bg"><span class="icon-label"><i class="fa fa-moon-o"></i> </span><span class="btn-text">Dark Mode</span></button>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <h6>Scrollable Header</h6>
                    <div class="toggle toggle-sm toggle-simple toggle-light toggle-bg-primary scroll-nav-switch"></div>
                </div>
                <button id="reset_settings" class="btn btn-primary btn-block btn-reset mt-30">Reset</button>
            </div>
        </div>
        <!--<img class="d-none" src="../dist/img/logo-light.png" alt="brand" />
        <img class="d-none" src="../dist/img/logo-dark.png" alt="brand" />-->
    </div>
    <!-- /Setting Panel -->


