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
        $("#modalSalidaInsumoLabel").text('Registro de Salida de Insumo');
        $("#registrar").show();
        $("#modificar").hide();
        $("#cantidad").removeAttr("disabled")
        borrarForm();
    });
    
    $("#modalSalidaInsumo").submit(function (e) { 
        e.preventDefault();
        
        const data = new FormData();

        const btn_clicked = e.originalEvent.submitter.id;

        data.append("accion", btn_clicked);
        data.append("id", $("#id").val());
        data.append("fecha", $("#fecha").val());
        data.append("insumo", $("#insumo").val());
        data.append("trabajador", $("#trabajador").val());
        data.append("cantidad", $("#cantidad").val());
        data.append("entregado", $("#entregado").val());
        
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
                $("#modalSalidaInsumo").modal("hide");
            borrarForm();
                
            },
        });
    });

    $("#insumo").change(function (e) {
        e.preventDefault();
        
        const data = new FormData();
        data.append("accion", "cantidad");
        data.append("insumo", $("#insumo").val());
        $.ajax({
            async: true,
            url: " ",
            type: "POST",
            contentType: false,
            data: data,
            processData: false,
            cache: false,

            success: function (response) {
                console.log(response);
                $("#cantidad_insumo").val(response);
            },
            error: function ({ responseText }, status, error) {
                Toast.fire({
                    icon: "error al cargar la cantidad disponible",
                    title: `${responseText}`,
                });
            },
        });
    });
});

function borrarForm() {

   $('#id').val('');
   $('#fecha').val('');
   $('#insumo').val('');
   $('#trabajador').val('');
   $('#cantidad').val('');
   $('#entregado').val('');
   
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
            const id = $(linea).find("td:eq(2)");

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