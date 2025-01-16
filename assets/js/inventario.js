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
        $("#modalInventarioLabel").text('Registro de Insumos Médicos');
        $("#registrar").show();
        $("#modificar").hide();
        $("#codigo").removeAttr("disabled")
        borrarForm();
    });
    
    $("#modalInventario").submit(function (e) { 
        e.preventDefault();
        
        const data = new FormData();

        const btn_clicked = e.originalEvent.submitter.id;

        data.append("accion", btn_clicked);
        data.append("id", $("#id").val());
        data.append("codigo", $("#codigo").val());
        data.append("insumo", $("#insumo").val());
        data.append("cantidad", $("#cantidad").val());
        data.append("fecha", $("#fecha").val());
        
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
                $("#modalInventario").modal("hide");
            borrarForm();
                
            },
        });
    });
});

function borrarForm() {

   $('#id').val('');
   $('#codigo').val('');
   $('#insumo').val('');
   $('#cantidad').val('');
   $('#fecha').val('');
   
}

function modalModificar(fila) {
   $("#modalInventarioLabel").text("Modificar Insumo Médico");

  $("#registrar").hide();
  $("#modificar").show();
   

   $("#modalInventario").modal("show");
     
   const linea = $(fila).closest("tr");
   const id = $(linea).find("td:eq(0)");
   const codigo = $(linea).find("td:eq(1)");
   const insumo = $(linea).find("td:eq(2)");
   const cantidad = $(linea).find("td:eq(3)");
   const fecha = $(linea).find("td:eq(4)");
   
   $("#codigo").attr('disabled','disabled');
   $("#id").val(id.text());
   $("#codigo").val(codigo.text());
   $("#insumo").val(insumo.text());
   $("#cantidad").val(cantidad.text());
   $("#fecha").val(fecha.text());     
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