$(document).ready(function () {
  $("#itemServicio").removeClass("collapsed");
  $("#itemDashboard").addClass("collapsed");
  cargarHistorialPago();

  function cargarHistorialPago() {
    var codiServ = obtenerParametroUrl("codiServ");
    if (codiServ) {
      $.ajax({
        url: "controller/ListarPagos.php?codiServ=" + codiServ,
        method: "GET",
        dataType: "json",
        success: function (data) {
          mostrarDatosHistorialPago(data);
        },
        error: function (xhr, status, error) {
          if (xhr.status == 401) {
            window.location.replace("index.php");
          } else {
            console.error("Error al obtener el historial de pago:", error);
          }
        },
      });
    }
  }

  function mostrarDatosHistorialPago(data) {
    var historialPagoContainer = $("#historialPagoContainer");

    if (data.length > 0) {
      var tablaHistorialPago =
        '<table id="tablaHistorialPago" class="table table-hover table-bordered">' +
        "<thead>" +
        "<tr class='table table-success'>" +
        '<th style="text-align: center;">Código</th>' +
        '<th style="text-align: center;">N° Recibo</th>' +
        '<th style="text-align: center;">Concepto</th>' +
        '<th style="text-align: center;">Emitido</th>' +
        '<th style="text-align: center;">Vencimiento</th>' +
        '<th style="text-align: center;">Pagado</th>' +
        '<th style="text-align: center;">Monto</th>' +
        '<th style="text-align: center;">Estado</th>' +
        '<th style="text-align: center;">Recibo</th>' +
        "</tr>" +
        "</thead>" +
        "<tbody>";

      data.forEach(function (pago) {
        tablaHistorialPago +=
          "<tr>" +
          '<td style="text-align: center;">' +
          (pago.codiReci !== null ? pago.codiReci : "-") +
          "</td>" +
          '<td style="text-align: center;">' +
          (pago.numeReci !== null ? pago.numeReci : "-") +
          "</td>" +
          '<td style="text-align: center;">' +
          (pago.nombConc !== null ? pago.nombConc : "-") +
          "</td>" +
          '<td style="text-align: center;">' +
          formatDate(pago.fechRegiEmis) +
          "</td>" +
          '<td style="text-align: center;">' +
          (pago.fechVenc !== null ? formatDate(pago.fechVenc) : "00/00/0000") +
          "</td>" +
          '<td style="text-align: center;">' +
          (pago.fechRegiAlta !== null
            ? formatDate(pago.fechRegiAlta)
            : "00/00/0000") +
          "</td>" +
          '<td style="text-align: center;">' +
          "S/." +
          Number(pago.montConc).toFixed(2) +
          "</td>" +
          '<td style="text-align: center;">' +
          mostrarEstadoConc(pago.estdConc) +
          "</td>" +
          '<td style="text-align: center;">' +
          '<button type="button" class="btn btn-info btn-sm text-white" data-codireci="' +
          pago.codiReci +
          '"><i class="fas fa-file-pdf"></i></button>' +
          "</td>" +
          "</tr>";
      });

      tablaHistorialPago += "</tbody></table>";

      historialPagoContainer.html(tablaHistorialPago);

      $("#tablaHistorialPago").DataTable({
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

      mostrarInformacionServicio(data);
    } else {
      historialPagoContainer.html(
        "<p>No hay historial de pago disponible para este servicio</p>"
      );
    }

    $("#tablaHistorialPago").on("click", ".btn-info", function () {
      var codiReci = $(this).data("codireci");

      window.location.href = "recibo.php?codiReci=" + codiReci;
    });
  }

  function obtenerParametroUrl(nombreParametro) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(nombreParametro);
  }

  function mostrarEstadoConc(estado) {
    switch (estado) {
      case "P":
        return '<span class="badge badge-success">Pagado</span>';
      case "D":
        return '<span class="badge badge-warning">No pagado</span>';
      case "A":
        return '<span class="badge badge-danger">Anulado</span>';
      default:
        return '<span class="badge badge-secondary">Desconocido</span>';
    }
  }

  function mostrarInformacionServicio(data) {
    $("#informacionServicio").empty();

    if (data && data.length > 0) {
      var servicio = data[0];

      var informacionHTML =
        "<h5 class='card-title'>Detalles del servicio:</h5>" +
        "<p><strong>Código:</strong> " +
        servicio.codiServ +
        "</p>" +
        "<p><strong>Ciudad:</strong> " +
        servicio.nombUbig +
        "</p>" +
        "<p><strong>Nombre:</strong> " +
        servicio.raznSociClie +
        "</p>" +
        "<p><strong>Dirección:</strong> " +
        servicio.direServ +
        "</p>";

      $("#informacionServicio").html(informacionHTML);
    }
  }

  function formatDate(data) {
    if (data) {
      const fecha = new Date(data);
      const dia = String(fecha.getDate()).padStart(2, "0");
      const mes = String(fecha.getMonth() + 1).padStart(2, "0");
      const año = fecha.getFullYear();

      return `${dia}/${mes}/${año}`;
    } else {
      return "00/00/0000";
    }
  }
});
