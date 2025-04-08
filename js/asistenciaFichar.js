function init() {

  $("#formularioAsis").on("submit", function (e) {
      registrar_asistencia(e);
  });
}

function limpiar() {
  $("#codigo_persona").val("");
  setTimeout('document.location.reload()', 2000);
}

function registrar_asistencia(e) {

  e.preventDefault();

  var formData = new FormData($("#formularioAsis")[0]);

  $.ajax({
      /*url: "admin/ajax/asistencia.php?op=registrar_asistencia",*/
      url: "asistencia.php?op=registrar_asistencia",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      
  });

  limpiar();
}

init();
