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
            $("#alertError").show().delay(3000).fadeOut();
          }
        },
        error: function () {
          console.error("Error making AJAX request");
        },
      });
    } else {
      // Show validation messages in the form
      form.addClass("was-validated");
    }
  });

  function encrypt(message) {
    return CryptoJS.SHA256(message).toString(CryptoJS.enc.Hex);
  }
});
