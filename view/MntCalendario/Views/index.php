<?php
require_once("../../config/conexion.php");
require_once("../../models/Rol.php");
$rol = new Rol();
$datos = $rol->validar_acceso_rol($_SESSION["USU_ID"], "mntcategoria");
if (isset($_SESSION["USU_ID"])) {
    if (is_array($datos) and count($datos) > 0) {
?>
        <!doctype html>
        <html lang="es" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

        <head>
            <title>Clima Cool | Cita</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
            <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/main.min.css">
            <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/propio.css">
            <?php require_once("../html/head.php"); ?>
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
                                 <h4 class="mb-sm-0">Mantenimiento Cita</h4>
                                 <div class="page-title-right">
                                     <ol class="breadcrumb m-0">
                                         <li class="breadcrumb-item"><a href="javascript: void(0);">Mantenimiento</a></li>
                                         <li class="breadcrumb-item active">Instalacion Aire</li>
                                     </ol>
                                 </div>
                             </div>
                         </div>
                         <div class="col-lg-12">
                             <div class="card">
                                 <div class="card-header">
                                     <h1>Registrar Cita de Instalación de Aire Acondicionado</h1>
                                     <div class="fc-toolbar">
                                         <div class="fc-right">
                                         </div>
                                     </div>
                                     <div class="d-flex justify-content-between">
                                         <div class="flex-grow-1">
                                             <h4 class="fs-16 mb-1">Seleccion para filtra</h4>
                                             <label for="month-selector">Selecciona un mes:</label>
                                             <!-- <select class="month-select" id="month-selector"> -->
                                             <select class="month-select" id="select-month">
                                                 <option value="" selected>Seleccione un mes</option>
                                                 <optgroup label="Primer trimestre">
                                                     <option value="0">Enero</option>
                                                     <option value="1">Febrero</option>
                                                     <option value="2">Marzo</option>
                                                 </optgroup>
                                                 <optgroup label="Segundo trimestre">
                                                     <option value="3">Abril</option>
                                                     <option value="4">Mayo</option>
                                                     <option value="5">Junio</option>
                                                 </optgroup>
                                                 <optgroup label="Tercer trimestre">
                                                     <option value="6">Julio</option>
                                                     <option value="7">Agosto</option>
                                                     <option value="8">Septiembre</option>
                                                 </optgroup>
                                                 <optgroup label="Cuarto trimestre">
                                                     <option value="9">Octubre</option>
                                                     <option value="10">Noviembre</option>
                                                     <option value="11">Diciembre</option>
                                                 </optgroup>
                                             </select>
                                             <div id="calendar"></div>
                                         </div>
                                     </div>
                                     <div id="tablaModal"></div>
                                 </div>
                                 <div class="card-body">
                                     <!-- TODO: Tabla de Categoria -->
                                     <div class="container">
                                         <div id="calendar"></div>
                                     </div>
                                     <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="Label" aria-hidden="true">
                                         <div class="modal-dialog">
                                             <div class="modal-content">
                                                 <div class="modal-header p-3 bg-soft-info">
                                                     <h5 class="modal-title" id="titulo">Registro de Eventos</h5>
                                                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                 </div>
                                                 <form id="formulario" autocomplete="off">
                                                     <div class="modal-body">
                                                         <div class="row">
                                                             <div class="col-md-12">
                                                                 <div class="form-floating mb-3">
                                                                     <input type="hidden" id="id" name="id">
                                                                     <input id="title" type="text" class="form-control" name="title">
                                                                     <label for="title">Evento</label>
                                                                 </div>
                                                                 <div class="form-floating mb-3">
                                                                     <select class="form-select" id="tiposervicio" name="tiposervicio" aria-label="Seleccione un servicio">
                                                                         <option value="Instalacion de aire">Instalación de aire</option>
                                                                         <option value="Manteminieto de aire">Mantenimiento de aire</option>
                                                                     </select>
                                                                     <label for="tiposervicio">Seleccione un servicio</label>
                                                                 </div>
                                                             </div>
                                                             <div class="col-md-12">
                                                                 <div class="form-floating mb-3">
                                                                     <select class="form-select" id="clientes" name="idcliente" aria-label="Seleccione un cliente"></select>
                                                                     <label for="clientes">Seleccione un cliente</label>
                                                                 </div>
                                                                 <div class="form-floating mb-3">
                                                                     <select class="form-select" id="productoId" name="productoId" aria-label="Seleccione un producto"></select>
                                                                     <label for="productoId">Seleccione un producto</label>
                                                                 </div>
                                                                 <div class="form-floating mb-3">
                                                                     <input class="form-control" id="start" type="date" name="start">
                                                                     <label for="" class="form-label">Hora de inicio Fecha</label>
                                                                 </div>
                                                                 <div class="form-floating mb-3">
                                                                     <input class="form-control" id="end" type="date" name="end">
                                                                     <label for="" class="form-label">Hora de finalización Fecha</label>
                                                                 </div>
                                                                 <div class="mt-4">
                                                                     <label for="direccion" class="form-label text-muted text-uppercase fw-semibold">Dirección</label>
                                                                     <textarea class="form-control" id="direccion" name="direccion" placeholder="Dirección" rows="4" required=""></textarea>
                                                                 </div>
                                                                 <div class="mt-4">
                                                                     <label for="referencia" class="form-label text-muted text-uppercase fw-semibold">Punto de referencia</label>
                                                                     <textarea class="form-control alert alert-info" id="referencia" name="referencia" placeholder="Punto de referencia" rows="4" required=""></textarea>
                                                                 </div>
                                                                 <div class="mt-4">
                                                                     <label for="instalacion_coment" class="form-label text-muted text-uppercase fw-semibold">Comentario</label>
                                                                     <textarea class="form-control alert alert-info" id="instalacion_coment" name="instalacion_coment" placeholder="Comentario" rows="4" required=""></textarea>
                                                                 </div>
                                                             </div>



                                                         </div>
                                                     </div>
                                                     <div class="modal-footer">
                                                         <button type="submit" class="btn btn-primary" id="btnAccion">Guardar</button>
                                                         <button type="button" class="btn btn-danger" id="btnEliminar">Eliminar</button>
                                                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                     </div>
                                                 </form>
                                             </div>
                                         </div>
                                     </div>
                                     <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
                                     <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.13/jspdf.plugin.autotable.min.js"></script>
                                     <!-- Agregar jQuery -->
                                     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
                                     <script src="<?php echo base_url; ?>Assets/js/main.min.js"></script>
                                     <script src="<?php echo base_url; ?>Assets/js/es.js"></script>
                                     <script>
                                         const base_url = '<?php echo base_url; ?>';
                                     </script>
                                     <script src="<?php echo base_url; ?>Assets/js/sweetalert2.all.min.js"></script>
                                     <script src="<?php echo base_url; ?>Assets/js/app.js"></script>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <?php require_once("../html/footer.php"); ?>
         </div>
     </div>
     <?php require_once("../html/js.php"); ?>
     <script type="text/javascript" src="mntcategoria.js"></script>
 </body>
 </html>
<?php
    } else {
        header("Location:" . Conectar::ruta() . "view/404/");
    }
} else {
    header("Location:" . Conectar::ruta() . "view/404/");
}
?>