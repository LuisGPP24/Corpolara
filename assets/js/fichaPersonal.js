$(function () {
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
          console.log("Error al generar el reporte:", xhr.responseText);
        },
      });
    });
});

