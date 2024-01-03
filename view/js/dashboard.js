$(document).ready(function () {
  verificarEstadoCuenta(getCookie("cliente_id"));

  function actualizarInterfazUsuario(
    card,
    statusClass,
    headerClass,
    icon,
    title,
    text
  ) {
    card.removeClass("border-success border-danger").addClass(statusClass);
    card
      .find(".card-header")
      .removeClass("text-success text-danger")
      .addClass(headerClass)
      .html('<i id="iconoEstado" class="fas ' + icon + ' me-2"></i>' + title);
    card
      .find(".card-title")
      .removeClass("text-success text-danger")
      .addClass(headerClass)
      .html(text.title + "<br><br>" + text.body);
    card.find(".card-text").remove();
  }

  function verificarEstadoCuenta(codiServ) {
    $.ajax({
      url: "controller/VerificarEstado.php",
      type: "POST",
      data: { codiServ: codiServ },
      dataType: "json",
      success: function (resultado, xhr) {
        if (xhr.status === 401) {
          window.location.href = "index.php";
          return;
        }

        var deudaCuentaCard = $("#deudaCuentaCard");
        var estadoServicioCard = $("#estadoServicioCard");

        if (resultado.status) {
          actualizarInterfazUsuario(
            deudaCuentaCard,
            "border-danger text-danger",
            "border-danger text-danger",
            "fa-exclamation-circle",
            "ESTADO DE CUENTA PENDIENTE",
            {
              title: "No estás al día en tus pagos.",
              body:
                '<div class="deuda-actual">Deuda actual:<br>S/.' +
                resultado.data[0].montDeud.toFixed(2) +
                "</div>",
            }
          );
          $("#deudasLink").attr("data-codiserv", resultado.data[0].codiServ);
        } else {
          actualizarInterfazUsuario(
            deudaCuentaCard,
            "border-success text-success",
            "border-danger text-danger",
            "fa-check-circle",
            "ESTADO DE CUENTA AL DÍA",
            {
              title: "Estás al día en tus pagos",
              body: '<div class="deuda-actual">Deuda actual:<br>S/.0.00</div>',
            }
          );
        }

        var estadoText =
          resultado.data[0].estdServ === "V" ? "ACTIVO" : "INACTIVO";
        var estadoClass =
          resultado.data[0].estdServ === "V"
            ? "border-success text-success"
            : "border-danger text-danger";

        actualizarInterfazUsuario(
          estadoServicioCard,
          estadoClass,
          estadoClass,
          resultado.data[0].estdServ === "V"
            ? "fa-check-circle"
            : "fa-exclamation-circle",
          "ESTADO DEL SERVICIO",
          {
            title: "Estado actual:",
            body: estadoText,
          }
        );
      },
      error: function (xhr, status, error) {
        if (xhr.status == 401) {
          window.location.replace("index.php");
        } else {
          console.error("Error al verificar el estado de la cuenta:", error);
        }
      },
    });
  }

  $("#deudasLink").click(function (e) {
    e.preventDefault();

    var codiServ = $(this).data("codiserv");
    window.location.href = "deudas.php?codiServ=" + codiServ;
  });

  function getCookie(cookieName) {
    var name = cookieName + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var cookieArray = decodedCookie.split(";");

    for (var i = 0; i < cookieArray.length; i++) {
      var cookie = cookieArray[i].trim();
      if (cookie.indexOf(name) == 0) {
        return cookie.substring(name.length, cookie.length);
      }
    }
    return "";
  }
});
