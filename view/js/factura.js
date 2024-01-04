$(document).ready(function () {
  $("#itemServicio").removeClass("collapsed");
  $("#itemDashboard").addClass("collapsed");
  
  $("#btnDescargarPDF").click(function () {
    var codiReci = $(this).data("codireci");

    console.log(codiReci);

    $.ajax({
      type: "POST",
      url: "controller/GenerarPDF.php",
      success: function (response) {
        if (response.status === "Token is valid") {
          window.open(
            "../factura/generaFactura.php?codiReci=" + codiReci,
            "_blank"
          );
        }
      },
      error: function (xhr, status, error) {
        if (xhr.status == 401) {
          window.location.replace("index.php");
        } else {
          console.error("Error al generar el PDF:", error);
        }
      },
    });
  });
});
