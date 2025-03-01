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
        $("#modalFacturasLabel").text('Registro de Facturas');
        $("#registrar").show();
        $("#modificar").hide();
        $("#codigo_registro").removeAttr("disabled")
        borrarForm();
    });
    
    $("#btn_vaciar").on("click", function () {
    vaciar();
  });

});

//ACÁ EMPIEZA EL EJEMPLO

function vaciar() {
  Swal.fire({
    title: "¿Estas Seguro?",
    html: "Eliminarás todos los registros de la tabla. <br>¡No podrás revertir esta accion!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3B71CA",
    confirmButtonText: "Si, vaciar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      let datos = new FormData();
      datos.append("accion", "vaciar");

      $.ajax({
        async: true,
        url: "",
        type: "POST",
        contentType: false,
        data: datos,
        processData: false,
        cache: false,
        success: function (respuesta) {
          try {
            if (respuesta == "Tabla vaciada correcctamente") {
              Swal.fire({
                title: "¡Limpieza Exitosa!",
                text: "La información ha sido eliminada.",
                icon: "success",
              });
              tabla.ajax.reload(null, false);
            } else {
             mensajemodal(respuesta);
              
            }
          } catch (e) {
            mensajemodal(respuesta);
          }
        },
        error: function (respuesta) {
          Swal.fire({
            title: `${respuesta.responseText}`,
            icon: "error",
          });
        },
      });
    }
  });
}

//ACÁ TERMINA EL EJEMPLO


/*function vaciar() {
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
}*/