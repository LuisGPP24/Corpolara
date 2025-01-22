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
        $("#modalExpedienteLabel").text('Registro de Expedientes');
        $("#registrar").show();
        $("#modificar").hide();
        $("#trabajador").removeAttr("disabled")
        borrarForm();
    });
    
    $("#modalExpediente").submit(function (e) { 
        e.preventDefault();
        
        const data = new FormData();

        const btn_clicked = e.originalEvent.submitter.id;

        data.append("accion", btn_clicked);
        data.append("id", $("#id").val());
        data.append("trabajador", $("#trabajador").val());
        data.append("fecha_registro", $("#fecha_registro").val());
        data.append("expediente", $("#expediente")[0].files[0]);
        
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
                $("#modalExpediente").modal("hide");
            borrarForm();
                
            },
        });
    });
});

function borrarForm() {

   $('#id').val('');
   $('#trabajador').val('');
   $('#fecha_registro').val('');
   
}

function modalModificar(fila) {
   $("#modalExpedienteLabel").text("Modificar Expediente de trabajador");

  $("#registrar").hide();
  $("#modificar").show();
   

   $("#modalExpediente").modal("show");
     
   const linea = $(fila).closest("tr");
   const id = $(linea).find("td:eq(1)");
   const trabajador = $(linea).find("td:eq(0)");
   const fecha_registro = $(linea).find("td:eq(5)");
   
   $("#trabajador").attr('disabled','disabled');
   $("#id").val(id.text());
   $("#trabajador").val(trabajador.text());
   $("#fecha_registro").val(fecha_registro.text());  
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
            const id = $(linea).find("td:eq(1)");

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