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
        $("#modalFunerariaLabel").text('Registro de Solicitudes de Funeraria');
        $("#registrar").show();
        $("#modificar").hide();
        $("#codigo_registro").removeAttr("disabled")
        borrarForm();
    });
    
    $("#modalFuneraria").submit(function (e) { 
        e.preventDefault();
        
        const data = new FormData();

        const btn_clicked = e.originalEvent.submitter.id;

        data.append("accion", btn_clicked);
        data.append("id", $("#id").val());
        data.append("codigo_registro", $("#codigo_registro").val());
        data.append("ente", $("#ente").val());
        data.append("defuncion_paciente", $("#defuncion_paciente").val());
        
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
                $("#modalFuneraria").modal("hide");
            borrarForm();
                
            },
        });
    });
});

function borrarForm() {

   $('#id').val('');
   $('#codigo_registro').val('');
   $('#ente').val('');
   $('#defuncion_paciente').val('');
   
}

function modalModificar(fila) {
   $("#modalFunerariaLabel").text("Modificar Solicitud de Funeraria");

  $("#registrar").hide();
  $("#modificar").show();
   

   $("#modalFuneraria").modal("show");
     
   const linea = $(fila).closest("tr");
   const id = $(linea).find("td:eq(1)");
   const codigo_registro = $(linea).find("td:eq(0)");
   const ente = $(linea).find("td:eq(3)");
   const defuncion_paciente = $(linea).find("td:eq(10)");
   
   $("#codigo_registro").attr('disabled','disabled');
   $("#id").val(id.text());
   $("#codigo_registro").val(codigo_registro.text());
   $("#ente").val(ente.text());
   $("#defuncion_paciente").val(defuncion_paciente.text());     
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