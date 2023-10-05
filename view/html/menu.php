<?php
    require_once("../../models/Menu.php");
    $menu = new Menu();
    /* TODO: Obtener listado de acceso por ROL ID del Usuario */
    $datos = $menu->get_menu_x_rol_id($_SESSION["ROL_ID"]);
?>

<div class="app-menu navbar-menu">

    <div class="navbar-brand-box">

        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="../../assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="../../assets/images/logo-dark.png" alt="" height="17">
            </span>
        </a>

        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="../../assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="../../assets/images/logo-light.png" alt="" height="17">
            </span>
        </a>

        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>

    </div>

    <div id="scrollbar">

        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                <?php
                    foreach ($datos as $row) {
                       if ($row["MEN_GRUPO"]=="Dashboard" && $row["MEND_PERMI"]=="Si"){
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link menu-link" href="<?php echo $row["MEN_RUTA"];?>">
                                        <i class="ri-dashboard-2-line"></i> <span data-key="t-widgets"><?php echo $row["MEN_NOM"];?></span>
                                    </a>
                                </li>
                            <?php
                        }
                    }
                ?>

                <li class="menu-title"><span data-key="t-menu">Mantenimiento</span></li>

                <li class="nav-item">
                                    <a class="nav-link menu-link" href="../../view/MntCalendario/">
                                        <i class="ri-calendar-2-line"></i> <span data-key="t-widgets">Cita de Instalación</span>
                                    </a>
                </li>


                <li class="nav-item">
                                    <a class="nav-link menu-link" href="../../view/mntCalendarioList/">
                                        <i class="ri-file-list-line"></i> <span data-key="t-widgets">Listar Cita</span>
                     </a>




                <?php
foreach ($datos as $row) {
   if ($row["MEN_GRUPO"]=="Mantenimiento" && $row["MEND_PERMI"]=="Si"){
        $icono = "";
        switch ($row["MEN_NOM"]) {
            case "Categoria":
                $icono = "ri-archive-line";
                break;
            case "Inventario":
                $icono = "ri-product-hunt-line";
                break;
            case "Cliente":
                $icono = "ri-team-line";
                break;
            case "Proveedor":
                $icono = "ri-truck-line";
                break;
            case "Moneda":
                $icono = "ri-coins-line";
                break;
            case "Capacidad Aire":
                $icono = "ri-function-line";
                break;
            case "Empresa":
                $icono = "ri-bank-line";
                break;
            case "Sucursal":
                $icono = "ri-git-merge-line";
                break;
            case "Usuario":
                $icono = "ri-user-line";
                break;
            case "Rol":
                $icono = "ri-settings-line";
                break;
            // Agregar más casos según corresponda
            default:
                $icono = "ri-question-line";
                break;
        }
?>
    <li class="nav-item">
        <a class="nav-link menu-link" href="<?php echo $row["MEN_RUTA"];?>">
            <i class="<?php echo $icono; ?>"></i> <span data-key="t-widgets"><?php echo $row["MEN_NOM"];?></span>
        </a>
    </li>
<?php
    }
}
?>


                <li class="menu-title"><span data-key="t-menu">Compra</span></li>

                <?php
foreach ($datos as $row) {
   if ($row["MEN_GRUPO"]=="Compra" && $row["MEND_PERMI"]=="Si"){
        $icono = "";
        switch ($row["MEN_NOM"]) {
            case "Nueva Compra":
                $icono = "ri-bank-card-line";
                break;
            case "List.Compra":
                $icono = "ri-file-list-line";
                break;
            case "Nueva Venta":
                $icono = "ri-price-tag-3-line";
                break;
            case "List.Venta":
                $icono = "ri-file-list-3-line";
                break;
            // Agregar más casos según corresponda
            default:
                $icono = "ri-question-line";
                break;
        }
?>
    <li class="nav-item">
        <a class="nav-link menu-link" href="<?php echo $row["MEN_RUTA"];?>">
            <i class="<?php echo $icono; ?>"></i> <span data-key="t-widgets"><?php echo $row["MEN_NOM"];?></span>
        </a>
    </li>
<?php
    }
}
?>



                <li class="menu-title"><span data-key="t-menu">Venta</span></li>

                
                <?php
foreach ($datos as $row) {
   if ($row["MEN_GRUPO"]=="Venta" && $row["MEND_PERMI"]=="Si"){
        $icono = "";
        switch ($row["MEN_NOM"]) {
            case "Nueva Venta":
                $icono = "ri-price-tag-3-line";
                break;
            case "List.Venta":
                $icono = "ri-file-list-3-line";
                break;
            // Agregar más casos según corresponda
            default:
                $icono = "ri-question-line";
                break;
        }
?>
    <li class="nav-item">
        <a class="nav-link menu-link" href="<?php echo $row["MEN_RUTA"];?>">
            <i class="<?php echo $icono; ?>"></i> <span data-key="t-widgets"><?php echo $row["MEN_NOM"];?></span>
        </a>
    </li>
<?php
    }
}
?>

            </ul>
        </div>

    </div>

    <div class="sidebar-background"></div>
</div>

<div class="vertical-overlay"></div>