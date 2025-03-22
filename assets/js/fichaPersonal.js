const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  },
});
$(function () {

  $("#trabajador").change(function (e) {
    e.preventDefault();

    const data = new FormData();
    
    data.append("accion", "getSolicitantes");
    data.append("trabajador", $("#trabajador").val());
    $.ajax({
      async: true,
      url: " ",
      type: "POST",
      data: data,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.error) {
          console.log("Error: " + response.error);
          return;
        }

        $("#solicitante").empty();
        $("#solicitante").append(
          `<option selected disabled value="">Seleccione un solicitante</option>`
        );
        response.forEach((solicitante) => {
          $("#solicitante").append(
            `<option value="${solicitante.cedula}">${solicitante.nombre}</option>`
          );
        });
      },
      error: function (xhr, status, error) {
        Toast.fire({
          icon: "error",
          title: `${xhr.responseText}`,
        });
      },
    });
  });

  $("#generarReporte").click(function (e) {
    const data = new FormData();

    data.append("accion", "generarReporte");
    data.append("trabajador", $("#trabajador").val());
    data.append("solicitante", $("#solicitante").val());
    console.log($("#trabajador").val());
    console.log($("#solicitante").val());
    $.ajax({
      type: "POST",
      data: data,
      processData: false,
      contentType: false,
      dataType: "json",
      success: function (response) {
        if (response.error) {
          console.log("Error: " + response.error);
          return;
        }

        // Convertir base64 a Blob y abrir el PDF en una nueva pestaña
        let byteCharacters = atob(response.pdf);
        let byteNumbers = new Array(byteCharacters.length);
        for (let i = 0; i < byteCharacters.length; i++) {
          byteNumbers[i] = byteCharacters.charCodeAt(i);
        }
        let byteArray = new Uint8Array(byteNumbers);
        let file = new Blob([byteArray], { type: "application/pdf" });

        let fileURL = URL.createObjectURL(file);
        window.open(fileURL); // Abre el PDF en una nueva pestaña
      },
      error: function (xhr, status, error) {
        // const respuesta = JSON.parse(xhr.responseText);
        Toast.fire({
          icon: "error",
          title: `Error al generar el reporte: "${xhr.responseText}"`,
        });
      },
    });
  });
});
