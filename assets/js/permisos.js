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
    
    $("#btn_registrar").click(function (e) {
        $("#modalSolicitudesLabel").text('Registro de Permiso');
        $("#registrar").show();
        $("#modificar").hide();
        $("#nombre").removeAttr("disabled")
        borrarForm();
    });

    $("#formPassword").submit(function (event) {
      event.preventDefault();

      const data = new FormData();


        data.append("accion", "cambiar");
        data.append("cedula", $("#cedula_editar").val());
        data.append("contrasena", $("#contrasena_editar").val());
        data.append("contrasena2", $("#contrasena2_editar").val());
      

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
            borrarForm();
        },
      });
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
});

function modalPermisos(fila) {
    const linea = $(fila).closest("tr");
    const cedula = $(linea).find("td:eq(1)");
    $("#cedula_editar").val(cedula.text());


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