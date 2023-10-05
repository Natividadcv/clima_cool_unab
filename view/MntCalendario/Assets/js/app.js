let calendarEl = document.getElementById("calendar");
let frm = document.getElementById("formulario");
let eliminar = document.getElementById("btnEliminar");
let myModal = new bootstrap.Modal(document.getElementById("myModal"));

// Configuración del evento change del select
let selectMonth = document.getElementById("select-month");

document.addEventListener("DOMContentLoaded", function () {
  calendar = new FullCalendar.Calendar(calendarEl, {
    timeZone: "local",
    initialView: "dayGridMonth",
    locale: "es",
    headerToolbar: {
      left: "prev next today",
      center: "title",
      right: "dayGridMonth timeGridWeek listWeek",
    },
    events: base_url + "Home/listar",

    editable: true,
    dateClick: function (info) {
      frm.reset();
      eliminar.classList.add("d-none");
      document.getElementById("start").value = info.dateStr;
      document.getElementById("end").value = info.dateStr;
      document.getElementById("id").value = "";
      document.getElementById("btnAccion").textContent = "Registrar";
      document.getElementById("titulo").textContent = "Registrar Evento";
      myModal.show();
    },

    eventClick: function (info) {
        console.log(document.getElementById("start").value = info.event);
      document.getElementById("id").value = info.event.id;
      document.getElementById("title").value = info.event.title;
      document.getElementById("tiposervicio").value = info.event.extendedProps.servicio;
      document.getElementById("start").value = info.event.startStr;
      document.getElementById("end").value = info.event.endStr || info.event.startStr;
      document.getElementById("clientes").value = info.event.extendedProps.idcliente;
      document.getElementById("productoId").value =info.event.extendedProps.productoId;
      document.getElementById("direccion").value = info.event.extendedProps.direccion;
      document.getElementById("referencia").value = info.event.extendedProps.referencia;
      document.getElementById("instalacion_coment").value = info.event.extendedProps.instalacion_coment;
      document.getElementById("btnAccion").textContent = "Modificar";
      document.getElementById("titulo").textContent = "Actualizar Evento";
      eliminar.classList.remove("d-none");
      //console.log(info.event.extendedProps.idcliente);
      //console.log(info.event.extendedProps.idcliente);
      myModal.show();
    },
    eventDrop: function (info) {
      const start = info.event.startStr;
      const end = info.event.endStr || info.event.startStr;
      const cliente = info.event.extendedProps.clientes;
      const productoId = info.event.extendedProps.productoId;
      const id = info.event.id;

      const url = base_url + "Home/drag";
      const http = new XMLHttpRequest();
      const formDta = new FormData();
      formDta.append("start", start);
      formDta.append("end", end);
      formDta.append("cliente", cliente);
      formDta.append("productoId", productoId);
      formDta.append("id", id);
      http.open("POST", url, true);
      http.send(formDta);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          Swal.fire("Avisos", res.msg, res.tipo);
          if (res.estado) {
            myModal.hide();
            calendar.refetchEvents();
          }
        }
      };
    },
  });

  fetch(base_url + "Home/listarCliente")
    .then((response) => response.json())
    .then((data) => {
      //console.log(data); // Mostrar la respuesta en la consola
      // Recorrer el array de clientes y crear un option para cada uno
      data.forEach((cliente) => {
        const option = document.createElement("option");
        option.value = cliente.CLI_ID;
        option.text = cliente.CLI_NOM;
        document.getElementById("clientes").appendChild(option);
      });
    });

  fetch(base_url + "Home/listarProducto")
    .then((response) => response.json())
    .then((dataProducto) => {
      //console.log(dataProducto); // Mostrar la respuesta en la consola
      // Recorrer el array de clientes y crear un option para cada uno
      dataProducto.forEach((producto) => {
        const option = document.createElement("option");
        option.value = producto.PROD_ID;
        option.text = producto.PROD_NOM;
        document.getElementById("productoId").appendChild(option);
      });
    });

  // !
  selectMonth.addEventListener("change", function (e) {
    e.preventDefault();
    let month = this.value; // Obtener el mes seleccionado
    calendar.gotoDate(new Date(calendar.getDate().getFullYear(), month)); // Cambiar el mes del FullCalendar
  });

  calendar.render();
  frm.addEventListener("submit", function (e) {
    e.preventDefault();
    const title = document.getElementById("title").value;
    const servicio = document.getElementById("tiposervicio").value;
    const start = document.getElementById("start").value;
    const end = document.getElementById("end").value;
    const cliente = document.getElementById("clientes").value;
    const productoId = document.getElementById("productoId").value;
    if (
      (title == "" ||
        servicio == "" ||
        start == "" ||
        end == "" ||
        cliente == "",
      productoId == "")
    ) {
      Swal.fire("Avisos", "Todo los campos son obligatorios", "warning");
    } else {
      const url = base_url + "Home/registrar";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(new FormData(frm));
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.responseText);
          const res = JSON.parse(this.responseText);
          Swal.fire("Avisos?", res.msg, res.tipo);
          if (res.estado) {
            myModal.hide();
            calendar.refetchEvents();
          }
        }
      };
    }
  });
  eliminar.addEventListener("click", function () {
    myModal.hide();
    Swal.fire({
      title: "Advertencia",
      text: "Esta seguro de eliminar!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!",
    }).then((result) => {
      if (result.isConfirmed) {
        const url =
          base_url + "Home/eliminar/" + document.getElementById("id").value;
        const http = new XMLHttpRequest();
        http.open("GET", url, true);
        http.send();
        http.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            Swal.fire("Avisos?", res.msg, res.tipo);
            if (res.estado) {
              calendar.refetchEvents();
            }
          }
        };
      }
    });
  });
});
