<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Calendario.php");
    /* TODO: Inicializando clase */
    $calendario = new Calendario();

    switch($_GET["op"]){
        /* TODO: Listado de registros formato JSON para Datatable JS */
        case "listar":
            $datos=$calendario->get_estado();
            $data=Array();
            //$correlativo = 1;
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["id"];
                $sub_array[] = $row["instalacion_completada"];
                //$sub_array[] = $correlativo++;
                $sub_array[] = $row["CLI_NOM"];
                $sub_array[] = $row["servicio"];
                $sub_array[] = $row["PROD_NOM"];
                $sub_array[] = $row["direccion"];
                $sub_array[] = $row["referencia"];
                $sub_array[] = $row["instalacion_coment"];
                $sub_array[] = $row["title"];
                $sub_array[] = $row["start"];
            
                $fecha = $row["start"];
                $fechaProx = date_create($fecha);
                date_add($fechaProx, date_interval_create_from_date_string("3 months"));
            
                $fechaActual = new DateTime();
                $diferencia = $fechaActual->diff($fechaProx);
                $dias = $diferencia->days;
            
                /* Este bloque de código verifica si la diferencia entre la fecha actual y la fecha de
                la tarea es menor o igual a 7 días. Si es así, crea una insignia con un mensaje de
                advertencia que indica que la tarea necesita mantenimiento en los próximos días. Si
                no, simplemente muestra la fecha del próximo mantenimiento. La credencial se agrega
                al `` junto con el estado "Alerta" (que significa "Alerta" en español)
                para que se muestre en el DataTable. */
                
                if ($dias <= 7) {
                    $sub_array[] = '<div class="badge badge-danger py-2 px-3 text-lg bg-danger shadow-sm rounded-lg d-flex align-items-center">
                    <i class="bi bi-calendar-date-fill me-2"></i>
                    <span>Mantenimiento dentro de ' . $dias . ' dias:</span>
                    <span class="fw-bold ms-2">' . date_format($fechaProx,"d-m-Y") . '</span>
                  </div>';
                  $sub_array[] = ("Alerta");
                } else {
                    $sub_array[] = date_format($fechaProx,"d-m-Y");
                }
            
                $sub_array[] = '<button type="button" onClick="marcaComoCompletada(' . $row["id"] . ')" id="' . $row["id"] . '" class="btn btn-success btn-icon waves-effect waves-light"><i class="ri-task-line"></i></button>';

                $sub_array[] = '<button type="button" onClick="undoTaskCompletion(' . $row["id"] . ')" id="' . $row["id"] . '" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-arrow-go-back-line"></i></button>';
                
                $data[] = $sub_array;
            }
            

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
            case "completar":
            if (!empty($_POST["id"])) {
                $calendario->update_completeTask($_POST["id"]);
            } 
            break;
        case "deshacer_completado":
            if (!empty($_POST["id"])) {
                $calendario->update_undoTaskCompletion($_POST["id"]);
            } 
            break;

    }
?>