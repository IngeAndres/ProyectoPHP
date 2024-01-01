$(document).ready(function () {
  $("#btnCambiarClave").click(function () {
    let claveActual = $("#txtClaveActual").val().trim();
    let claveNueva = $("#txtClaveNueva").val().trim();
    let repetirClaveNueva = $("#txtRepetirClaveNueva").val().trim();

    // Validar campos vacíos
    if (camposVacios([claveActual, claveNueva, repetirClaveNueva])) {
      mensaje("Por favor, complete todos los campos");
      return;
    }

    // Validar contraseñas
    if (claveActual === claveNueva) {
      mensaje("La contraseña nueva es igual a la actual");
    } else if (claveNueva !== repetirClaveNueva) {
      mensaje("Las contraseñas no coinciden");
    } else {
      cambiarClave(claveActual, claveNueva);
    }
  });
});

function camposVacios(campos) {
  return campos.some((campo) => campo === "");
}

function cambiarClave(claveActual, claveNueva) {
  $.ajax({
    type: "POST",
    url: "controller/CambiarClave.php",
    data: { nuevaClave: claveNueva, claveActual: claveActual },
    dataType: "json",
    success: function (response) {
      if (response.resultado === false) {
        mensaje("Contraseña Actual incorrecta");
      } else {
        mensaje("Contraseña cambiada exitosamente");
        //$("#myModal").modal("toggle");
        limpiarCampos();
      }
    },
    error: function (error) {
      console.error(error);
    },
  });
}

function mensaje(mensaje) {
  $("#divAlert").show();
  $("#divAlert").text(mensaje);

  setTimeout(function () {
    $("#divAlert").hide();
  }, 3000);
}

function limpiarCampos() {
  $("#txtClaveActual, #txtClaveNueva, #txtRepetirClaveNueva").val("");
}
