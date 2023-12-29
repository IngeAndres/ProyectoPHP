$(document).ready(function () {
  cargarHistorialPago();

  function cargarHistorialPago() {
    var codiServ = obtenerParametroUrl("codiServ");
    if (codiServ) {
      $.ajax({
        url: "controller/ajax/listar_pagos.php?codiServ=" + codiServ,
        method: "GET",
        dataType: "json",
        success: function (data) {
          mostrarDatosHistorialPago(data);
        },
        error: function (error) {
          console.error("Error al cargar historial de pago:", error);
        },
      });
    }
  }

  function mostrarDatosHistorialPago(data) {
    // Limpiar la tabla antes de agregar nuevos datos
    $("#tablaHistorialPago").DataTable().clear().destroy();

    // Volver a inicializar la tabla con los nuevos datos
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
      data: data, // Asignar los datos al cuerpo de la tabla
      columns: [
        {
          data: "codiReci",
          className: "text-center",
          render: function (data) {
            return data !== null ? data : "-";
          },
        },
        { data: "nombMes", className: "text-center" },
        {
          data: "fechRegiEmis",
          render: function (data) {
            return formatDate(data);
          },
          className: "text-center",
        },
        {
          data: "fechRegiAlta",
          render: function (data) {
            return formatDate(data);
          },
          className: "text-center",
        },
        {
          data: "montConc",
          render: function (data) {
            return "S/." + Number(data).toFixed(2);
          },
          className: "text-center",
        },
        {
          data: "estdConc",
          render: function (data) {
            return mostrarEstadoConc(data);
          },
          className: "text-center",
        },
        {
          data: null,
          render: function (data, type, row) {
            return '<button type="button" class="btn btn-info btn-sm text-white" data-codireci="' + row.codiReci + '"><i class="fas fa-file-pdf"></i></button>';
          },
          className: "text-center",
        }
        
      ],
    });
    // Mostrar la información del servicio
    mostrarInformacionServicio(data);
  }

  // Agregar evento click al botón de PDF
  $("#tablaHistorialPago").on("click", ".btn-info", function () {
    var codiReci = $(this).data("codireci");
    console.log(codiReci);
    window.open('../factura/generaFactura.php?codiReci=' + codiReci, '_blank');
  });


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
    // Limpiar el contenido actual del contenedor
    $("#informacionServicio").empty();

    // Verificar si hay datos disponibles
    if (data && data.length > 0) {
      var servicio = data[0];

      // Construir y agregar la información del servicio al contenedor
      var informacionHTML =
        "<h5 class='card-title'>Información:</h5>" +
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
