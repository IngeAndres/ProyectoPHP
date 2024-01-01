$(document).ready(function () {
  // Realizar solicitud AJAX para obtener datos de servicios
  $.ajax({
    url: "controller/ListarServicios.php", // Ruta al script que obtiene los datos
    type: "GET",
    dataType: "json",
    success: function (data) {
      // Manejar los datos recibidos y mostrarlos en el contenedor
      mostrarServicios(data);

      // Llamar a verificarEstadoCuenta con el código del primer servicio (si existe)
      if (data.length > 0) {
        verificarEstadoCuenta(data[0].codiServ);
      }
    },
    error: function () {
      alert("Error al obtener los datos de los servicios.");
    },
  });

  // Función para mostrar los servicios en el contenedor
  function mostrarServicios(data) {
    var serviciosContainer = $("#serviciosContainer");

    if (data.length > 0) {
      // Construir la tabla de servicios
      var tablaServicios =
        '<table id="tablaServicios" class="table table-hover table-bordered">' +
        "<thead>" +
        "<tr class='table table-primary'>" +
        '<th style="text-align: center;">Código</th>' +
        '<th style="text-align: center;">Ciudad</th>' +
        '<th style="text-align: center;">Plan</th>' +
        '<th style="text-align: center;">Monto</th>' +
        '<th style="text-align: center;">Día Facturación</th>' +
        '<th style="text-align: center;">Detalles</th>' +
        "</tr>" +
        "</thead>" +
        "<tbody>";

      // Iterar sobre los datos y construir filas de la tabla
      data.forEach(function (servicio) {
        tablaServicios +=
          "<tr>" +
          '<td style="text-align: center;">' +
          servicio.codiServ +
          "</td>" +
          '<td style="text-align: center;">' +
          servicio.nombUbig +
          "</td>" +
          '<td style="text-align: center;">' +
          servicio.nombPlan +
          "</td>" +
          '<td style="text-align: center;">' +
          "S/." +
          Number(servicio.montPlan).toFixed(2) +
          "</td>" +
          '<td style="text-align: center;">' +
          servicio.diaFact +
          "</td>" +
          '<td align="center">' +
          '<button type="button" class="btn btn-warning btn-sm text-white" data-codiserv="' +
          servicio.codiServ +
          '">' +
          '<i class="fa fa-eye" aria-hidden="true"></i>' +
          "</button>" +
          "</td>" +
          "</tr>";
      });

      // Cerrar la tabla
      tablaServicios += "</tbody></table>";

      // Agregar la tabla al contenedor
      serviciosContainer.html(tablaServicios);

      // Inicializar el DataTable
      $("#tablaServicios").DataTable({
        language: {
          url: "./view/json/es-ES.json",
        },
        dom:
          "<'d-flex justify-content-between'lfB>" +
          "<'row'<'col-md-12't>>" +
          "<'row'<'col-md-5'i><'col-md-7'p>>",
        buttons: [
          {
            extend: "excel",
            className: "btn btn-success btn-sm",
            text: '<i class="fas fa-file-excel"></i>',
            exportOptions: {
              columns: ":not(:last-child)",
            },
          },
          {
            extend: "pdf",
            className: "btn btn-danger btn-sm",
            text: '<i class="fas fa-file-pdf"></i>',
            exportOptions: {
              columns: ":not(:last-child)",
            },
          },
          {
            extend: "print",
            className: "btn btn-info btn-sm",
            text: '<i class="fas fa-print"></i>',
            exportOptions: {
              columns: ":not(:last-child)",
            },
          },
        ],
        initComplete: function () {
          var $buttons = $(".dt-buttons").appendTo(".dataTables_length");
          $buttons.css("margin-left", "10px");

          $(".dataTables_length").prepend($(".dataTables_length label"));
          $(".dataTables_length label").css("margin-right", "10px");

          $(".dataTables_length, .dt-buttons, .dataTables_filter").addClass(
            "d-flex align-items-center"
          );
        },
      });

      // Agregar evento click al botón de detalles
      $("#tablaServicios").on("click", ".btn-warning", function () {
        var codiServ = $(this).data("codiserv");
        window.location.href = "detalle_servicio.php?codiServ=" + codiServ;
      });
    } else {
      // Mostrar mensaje si no hay servicios disponibles
      serviciosContainer.html(
        "<p>No hay servicios disponibles para este cliente</p>"
      );
    }
  }

  // Función para verificar el estado de la cuenta
  function verificarEstadoCuenta(codiServ) {
    // Realizar AJAX para llamar al método verificarEstadoCuenta con el código del servicio
    $.ajax({
      url: "controller/VerificarEstado.php",
      type: "POST",
      data: { codiServ: codiServ },
      dataType: "json", // Asegúrate de especificar que esperas JSON como respuesta
      success: function (resultado) {
        // Manejar la respuesta según sea necesario
        var estadoCuentaCard = $("#estadoCuentaCard");
        var cardHeader = estadoCuentaCard.find(".card-header");
        var cardBody = estadoCuentaCard.find(".card-body");
        var cardTitle = cardBody.find(".card-title");

        if (resultado) {
          estadoCuentaCard
            .removeClass("border-danger")
            .addClass("border-success");
          cardHeader.removeClass("text-danger").addClass("text-success");
          cardHeader.html(
            '<i id="iconoEstado" class="fas fa-check-circle me-2"></i>Estado de cuenta al día'
          );
          cardTitle
            .removeClass("text-danger")
            .addClass("text-success")
            .text("Estás al día en tus pagos");
        } else {
          estadoCuentaCard
            .removeClass("border-success")
            .addClass("border-danger");
          cardHeader.removeClass("text-success").addClass("text-danger");
          cardHeader.html(
            '<i id="iconoEstado" class="fas fa-exclamation-circle me-2"></i>Estado de cuenta pendiente'
          );
          cardTitle
            .removeClass("text-success")
            .addClass("text-danger")
            .text("No estás al día en tus pagos");
        }
      },
      error: function () {
        alert("Error al verificar el estado de la cuenta.");
      },
    });
  }
});
