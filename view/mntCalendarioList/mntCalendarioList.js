var suc_id = $("#SUC_IDx").val();
var alertCounter = 0;



//console.log(suc_id);
function init() {
  $("#mantenimiento_form").on("submit", function (e) {
    guardaryeditar(e);
  });
}

function nuevoRegistro() {
  window.location.href = "/CLIMA/view/MntCalendario/";
}

$(document).ready(function () {
  /* TODO: Listar informacion en el datatable js */
  $("#table_data").DataTable({
    aProcessing: true,
    aServerSide: true,
    dom: "Bfrtip",
    buttons: [
      {
        extend: "copyHtml5",
        exportOptions: {
          columns: [2, 3, 4, 5, 6, 7, 8, 9], // Especificar columnas a exportar
        },
      },
      {
        extend: "excelHtml5",
        exportOptions: {
          columns: [2, 3, 4, 5, 6, 7, 8, 9], // Especificar columnas a exportar
        },
      },
      {
        extend: "csvHtml5",
        exportOptions: {
          columns: [2, 3, 4, 5, 6, 7, 8, 9], // Especificar columnas a exportar
        },
      },
    ],
    ajax: {
      url: "../../controller/calendario.php?op=listar",
      type: "post",
      data: { suc_id: suc_id },
    },
    bDestroy: true,
    responsive: true,
    bInfo: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo:
        "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending:
          ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
    columnDefs: [
      {
        targets: 1, // índice de la columna "Completado"
        visible: false,
      },
    ],
    
    rowCallback: function (row, data, index) {
    console.log(data[1]);
    if (data[1] === "1") {
        $(row).addClass("completed");
    }
    if(data[11] === "Alerta"){
        $('#custom-alert').hide();
        var cliente = data[2];
        var alertDiv = $('#custom-alert').clone();
        var alertID = 'custom-alert-' + alertCounter;
        alertDiv.attr('id', alertID);
        alertDiv.find('#alert-id').text(cliente);
        alertDiv.appendTo('body').fadeIn(300).delay(5000).fadeOut(10000, function(){
            $(this).remove(); // eliminar la alerta del DOM después de ocultarla
        });
        alertCounter++;
    }
    },
  });
});

function marcaComoCompletada(id) {
  try {
    swal
      .fire({
        title: "¿Está seguro de completar la instalación?",
        text: "Una vez completada no podrá revertir los cambios",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, completar",
        cancelButtonText: "Cancelar",
      })
      .then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "../../controller/calendario.php?op=completar",
            type: "POST",
            data: { id: id },
            success: function (data) {
              /* TODO: Mensaje de sweetalert */
              $("#table_data").DataTable().ajax.reload();
              swal.fire({
                title: "Instalacion Completado",
                text: "Felicitaciones, la instalacion se ha completado con exito",
                icon: "success",
              });
            },
          });
        }
      });
  } catch (error) {
    /* TODO: Manejo de errores */
    console.error(error);
    swal.fire({
      title: "Error",
      text: "Ocurrió un error al completar la instalación",
      icon: "error",
    });
  }
}
function undoTaskCompletion(id) {
  try {
    swal
      .fire({
        title:
          "¿Está seguro de deshacer la instalación completada o mantenimiento?",
        text: "Esta acción revertirá la instalación completada de un aire acondicionado o mantenimiento de aire acondicionado.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, deshacer",
        cancelButtonText: "Cancelar",
      })
      .then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "../../controller/calendario.php?op=deshacer_completado",
            type: "POST",
            data: { id: id },
            success: function (data) {
              $("#table_data").DataTable().ajax.reload();
              swal.fire({
                title: "Deshacer instalación completada",
                text: "La instalación completada se ha revertido con éxito",
                icon: "success",
              });
            },
            error: function (error) {
              swal.fire({
                title: "Error al deshacer instalación completada",
                text: "Ocurrió un error al deshacer la instalación completada de un aire acondicionado o mantenimiento de aire acondicionado",
                icon: "error",
              });
            },
          });
        } else {
          swal.fire({
            title: "Cancelado",
            text: "La acción ha sido cancelada",
            icon: "info",
          });
        }
      });
  } catch (error) {
    /* TODO: Manejo de errores */
    console.error(error);
    swal.fire({
      title: "Error",
      text: "Ocurrió un error al deshacer la instalación completada de un aire acondicionado o mantenimiento de aire acondicionado",
      icon: "error",
    });
  }
}

init();
