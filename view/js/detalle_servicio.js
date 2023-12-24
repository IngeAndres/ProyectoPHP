$(document).ready(function () {
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
});
