$(document).ready(function () {
  $("#btnDescargarPDF").click(function () {
    var codiReci = $(this).data("codireci");

    console.log(codiReci);
    window.open("../factura/generaFactura.php?codiReci=" + codiReci, "_blank");
  });
});
