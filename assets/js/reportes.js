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
    data.append("categoria", $("#categoria").val());
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

  $("#categoria").change(function (e) {
    e.preventDefault();

    const data = new FormData();
    
    data.append("accion", "getTrabajadores");
    data.append("categoria", $("#categoria").val());
    
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

        $("#trabajador").empty();
        $("#solicitante").empty();

        $("#trabajador").append(
          `<option selected disabled value="">Seleccione un trabajador</option>`
        );
        $("#solicitante").append(
          `<option selected disabled value="">Seleccione un trabajador</option>`
        );
        response.forEach((trabajador) => {
          $("#trabajador").append(
            `<option value="${trabajador.id}">${trabajador.nombre}</option>`
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

  $("#consultar").click(function (e) {
    e.preventDefault();

    const data = new FormData();
        
    data.append("accion", "getSolicitudes");
    data.append("trabajador", $("#trabajador").val());
    data.append("solicitante", $("#solicitante").val());
    data.append("categoria", $("#categoria").val());

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

        // Aquí puedes manejar la respuesta y mostrar los datos en la tabla
        console.log(response);

        $("#tbodyResultadosSolicitudes").empty(); // Limpiar la tabla antes de agregar nuevos datos
        response.forEach((solicitud) => {
          $("#tbodyResultadosSolicitudes").append(
            `<tr>
              <td><button class="btn btn-danger" onclick="generarReporte(${solicitud.id})" >Generar <i class="bi bi-filetype-pdf"></i></button></td>
              <td>${solicitud.id}</td>
              <td>${solicitud.codigo}</td>
              <td>${solicitud.numero}</td>
              <td>${solicitud.nombre_trabajador}</td>
              <td>${solicitud.cedula_trabajador}</td>
              <td>${solicitud.cedula_solicitante}</td>
              <td>${solicitud.nombre_solicitante}</td>
              <td>${solicitud.descripcion}</td>
              <td>${solicitud.fecha}</td>
            </tr>`
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

 
  
});

 function generarReporte(id_solicitud) {
  
   const data = new FormData();

   data.append("accion", "generarReporte");
   data.append("trabajador", $("#trabajador").val());
   data.append("solicitante", $("#solicitante").val());
   data.append("categoria", $("#categoria").val());
   data.append("id_solicitud", id_solicitud);

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

      window.location.href = "?pagina=reportes&file=" + encodeURIComponent(response.file);
    },
    error: function (xhr, status, error) {
      Toast.fire({
        icon: "error",
        title: `Error al generar el reporte: "${xhr.responseText}"`,
      });
    },
  });
  
 }