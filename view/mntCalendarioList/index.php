<?php
    require_once("../../config/conexion.php");
    require_once("../../models/Rol.php");
    $rol = new Rol();
    $datos = $rol->validar_acceso_rol($_SESSION["USU_ID"],"mntcategoria");
    if(isset($_SESSION["USU_ID"])){
        if(is_array($datos) and count($datos)>0){
?>


<!doctype html>
<html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
<head>
    <title>Clima Cool | Citas de Instalacion</title>
    <?php require_once("../html/head.php"); ?>
    <link rel="stylesheet" href="css.css">
</head>

<body>

    <div id="layout-wrapper">

        <?php require_once("../html/header.php"); ?>

        <?php require_once("../html/menu.php"); ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Mantenimiento cita de instalación de aire acondicionado</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Mantenimiento</a></li>
                                        <li class="breadcrumb-item active">Aire acondicionado</li>
                                    </ol>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                <button type="button" id="btnnuevo" class="btn btn-primary btn-label waves-effect waves-light rounded-pill" onclick="nuevoRegistro()"><i class="ri-user-smile-line label-icon align-middle rounded-pill fs-16 me-2"></i> Nuevo Registro</button>
                                </div>
                                <div class="card-body">
                                    <!-- TODO: Tabla de Cita de instalación de aire acondicionado -->
                                    <table id="table_data" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Completado</th>
                                                <th>Cliente</th>
                                                <th>Servicio</th>
                                                <th>Producto</th>
                                                <th>Dirreccion</th>
                                                <th>Punto de Referencia</th>
                                                <th>Comentario</th>
                                                <th>Evento</th>
                                                <th>Fecha de inicio</th>
                                                <th>Fecha de mantenimiento</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div id="custom-alert" class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Alerta!</strong> El mantenimiento para el cliente <span id="alert-id"></span> se aproxima en menos de 7 días.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>




            <?php require_once("../html/footer.php"); ?>
        </div>

    </div>



    <?php require_once("../html/js.php"); ?>
    <script type="text/javascript" src="mntCalendarioList.js"></script>
</body>

</html>
<?php
        }else{
            header("Location:".Conectar::ruta()."view/404/");
        }
    }else{
        header("Location:".Conectar::ruta()."view/404/");
    }
?>