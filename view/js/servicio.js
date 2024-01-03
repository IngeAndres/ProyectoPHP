$(document).ready(function () {
  $("#itemServicio").removeClass("collapsed");
  $("#itemDashboard").addClass("collapsed");
  $.ajax({
    url: "controller/ListarServicios.php",
    type: "GET",
    dataType: "json",
    success: function (data) {
      mostrarServicios(data);
    },
    error: function (xhr, status, error) {
      if (xhr.status == 401) {
        window.location.replace("index.php");
      } else {
        console.error("Error al obtener los datos de los servicios: ", error);
      }
    },
  });

  function mostrarServicios(data) {
    var serviciosContainer = $("#serviciosContainer");

    if (data.length > 0) {
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

      tablaServicios += "</tbody></table>";

      serviciosContainer.html(tablaServicios);

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

      $("#tablaServicios").on("click", ".btn-warning", function () {
        var codiServ = $(this).data("codiserv");
        window.location.href = "historial_pago.php?codiServ=" + codiServ;
      });
    } else {
      serviciosContainer.html(
        "<p>No hay servicios disponibles para este cliente</p>"
      );
    }
  }
});
