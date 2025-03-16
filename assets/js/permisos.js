var Toast = Swal.mixin({
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

$(document).ready(function () {
  let seleccionados = false; // Estado inicial

  $("#formulario_permisos").on("submit", function (e) {
    e.preventDefault();

    const permisos = [];

    $(".x-permiso").each(function (index, item) {
      let id = $(this).closest("tr").find("td:eq(0)").text().trim();
      let acceso = $(this).is(":checked") ? 1 : 0;
      permisos.push({ id: id, acceso: acceso });
    });

    const idRol = $("#rol-titulo").text().split("-")[0].trim();
    const data = new FormData();

    data.append("accion", "guardar_permisos");
    data.append("idRol", idRol);
    data.append("permisos", JSON.stringify(permisos));

    $.ajax({
      async: true,
      url: " ",
      type: "POST",
      contentType: false,
      data: data,
      processData: false,
      cache: false,

      success: function (response) {
        Toast.fire({
          icon: "success",
          title: `exito`,
          text: `${response}`,
        });
      },
      error: function ({ responseText }, status, error) {
        Toast.fire({
          icon: "error",
          title: `${responseText}`,
        });
      },
      complete: function () {
        $("#modalPassword").modal("hide");
      },
    });
  });

  $("#btn_registrar").click(function (e) {
    $("#modalSolicitudesLabel").text("Registro de Permiso");
    $("#registrar").show();
    $("#modificar").hide();
    $("#nombre").removeAttr("disabled");
    borrarForm();
  });

  $("#modalSolicitudes").submit(function (e) {
    e.preventDefault();

    const data = new FormData();

    const btn_clicked = e.originalEvent.submitter.id;

    data.append("accion", btn_clicked);
    data.append("id", $("#id").val());
    data.append("nombre", $("#nombre").val());
    data.append("descripcion", $("#descripcion").val());

    $.ajax({
      async: true,
      url: " ",
      type: "POST",
      contentType: false,
      data: data,
      processData: false,
      cache: false,
      success: function (response) {
        Toast.fire({
          icon: "success",
          text: response,
          title: "Muy Bien!!",
        });
      },
      error: function ({ responseText }, status, error) {
        Toast.fire({
          icon: "error",
          title: `${responseText}`,
        });
      },
      complete: function () {
        $("#modalSolicitudes").modal("hide");
        borrarForm();
      },
    });
  });

  $("#btn-toggle-seleccion").click(function (e) {
    e.preventDefault();

    // Alternar el estado de los checkboxes
    $(".x-permiso").prop("checked", !seleccionados);

    // Cambiar el estado de la variable
    seleccionados = !seleccionados;

    // Cambiar el texto del botón según el estado
    $(this).text(seleccionados ? "Deseleccionar Todos" : "Seleccionar Todos");
  });
});

function modalPermisos(fila) {
  $("#rol-titulo").text("");
    const linea = $(fila).closest("tr");
    const id = $(linea).find("td:eq(0)");
  const nombreRol = $(linea).find("td:eq(1)");
  
  $("#id").val(id.text());
  
  $("#rol-titulo").text(`${id.text()} - ${nombreRol.text()}`);

  const permisos = document.querySelectorAll(".x-permiso");

  permisos.forEach((permiso) => {
    if (permiso.checked) {
      permiso.checked = false;
    }
  });

  const data = new FormData();

  data.append("accion", "consulta_accesos");
  data.append("id", $("#id").val());

  $.ajax({
    async: true,
    url: " ",
    type: "POST",
    contentType: false,
    data: data,
    processData: false,
    cache: false,
    success: function (response) {
      const result = JSON.parse(response);
      result.forEach((item) => {
        let checkbox = $(`#fila-modulo-${item.id_modulos} .x-permiso`);
        if (checkbox.length) {
          checkbox.prop("checked", item.acceso == 1);
        }
      });
    },
    error: function ({ responseText }, status, error) {
      Toast.fire({
        icon: "error",
        title: `${responseText}`,
      });
    },
    
  });


    $("#modalPassword").modal("show");
}

function borrarForm() {

   $('#id').val('');
   $('#nombre').val('');
   $('#descripcion').val('');
   
}

function modalModificar(fila) {
   $("#modalSolicitudesLabel").text("Modificar Permiso");

  $("#registrar").hide();
  $("#modificar").show();
   

   $("#modalSolicitudes").modal("show");
     
   const linea = $(fila).closest("tr");
   const id = $(linea).find("td:eq(0)");
   const nombre = $(linea).find("td:eq(1)");
   const descripcion = $(linea).find("td:eq(2)");
   

   $("#nombre").attr('disabled','disabled');
   $("#id").val(id.text());
   $("#nombre").val(nombre.text());
   $("#descripcion").val(descripcion.text());
}

function eliminar(fila) {
    Swal.fire({
        title: "¿Estas seguro que quieres realizar esta acción?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3B71CA",
        confirmButtonText: "Si, eliminar",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        
        if (result.isConfirmed) {

            const linea = $(fila).closest("tr");
            const id = $(linea).find("td:eq(0)");

            const data = new FormData();
            data.append("accion", "eliminar");
            data.append("id", id.text());
            
            $.ajax({
                async: true,
                url: " ",
                type: "POST",
                contentType: false,
                data: data,
                processData: false,
                cache: false,

                success: function (response) {
                    Swal.fire({
                       title: "Eliminacion exitosa",
                       text: "La solicitud fue eliminada con éxito!",
                       icon: "success",
                    });
                },
                error: function ({ responseText }, status, error) {
                    Toast.fire({
                        icon: "error",
                        title: `${responseText}`,
                    });
                },
            });
            

            
        } 
    })
}