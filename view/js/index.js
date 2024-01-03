$(document).ready(function () {
  $("#iniciarSesion").click(function () {
    var numeDocu = $("#numeDocu").val();
    var passClie = $("#passClie").val();
    var form = $("form");

    if (form[0].checkValidity()) {
      $.ajax({
        type: "POST",
        url: "controller/IniciarSesion.php",
        data: { numeDocu: numeDocu, passClie: encrypt(passClie) },
        dataType: "json",
        success: function (response) {
          if (response.resultado === "ok") {
            window.location.href = "dashboard.php";
          } else {
            showError("Credenciales incorrectas, intente nuevamente.");
          }
        },
        error: function () {
          showError("Error interno en el servidor, intente nuevamente.");
        },
      });
    } else {
      form.addClass("was-validated");
    }
  });

  function encrypt(message) {
    return CryptoJS.SHA256(message).toString(CryptoJS.enc.Hex);
  }

  function showError(message) {
    $("#mensajeError").text(message);
    $("#alertError").show().delay(3000).fadeOut();
  }
});
