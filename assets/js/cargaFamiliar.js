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
        $("#modalFamiliaLabel").text('Registro de Familiares del trabajador');
        $("#registrar").show();
        $("#modificar").hide();
        $("#trabajador").removeAttr("disabled")
        $("#cedula").removeAttr("disabled")
        borrarForm();
    });
    
    $("#modalFamilia").submit(function (e) { 
        e.preventDefault();
        
        const data = new FormData();

        const btn_clicked = e.originalEvent.submitter.id;

        data.append("accion", btn_clicked);
        data.append("id", $("#id").val());
        data.append("trabajador", $("#trabajador").val());
        data.append("movimiento", $("#movimiento").val());
        data.append("nacionalidad", $("#nacionalidad").val());
        data.append("cedula", $("#cedula").val());
        data.append("fecha_nacimiento", $("#fecha_nacimiento").val());
        data.append("nombre", $("#nombre").val());
        data.append("parentesco", $("#parentesco").val());
        data.append("genero", $("#genero").val());
        data.append("cuenta", $("#cuenta").val());
        data.append("correo", $("#correo").val());
        data.append("fecha_ingreso", $("#fecha_ingreso").val());
                
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
                $("#modalFamilia").modal("hide");
            borrarForm();
                
            },
        });
    });
});

function borrarForm() {

   $('#trabajador').val('');
   $('#movimiento').val('');
   $('#nacionalidad').val('');
   $('#cedula').val('');
   $('#fecha_nacimiento').val('');
   $('#nombre').val('');
   $('#parentesco').val('');
   $('#genero').val('');
   $('#cuenta').val('');
   $('#correo').val('');
   $('#fecha_ingreso').val('');
   
}

function modalModificar(fila) {
   $("#modalFamiliaLabel").text("Modificar Familiar del Trabajador");

  $("#registrar").hide();
  $("#modificar").show();
   

   $("#modalFamilia").modal("show");
     
   const linea = $(fila).closest("tr");
   const trabajador = $(linea).find("td:eq(0)");
   const id = $(linea).find("td:eq(1)");
   const movimiento = $(linea).find("td:eq(4)");
   const nacionalidad = $(linea).find("td:eq(5)");
   const cedula = $(linea).find("td:eq(6)");
   const fecha_nacimiento = $(linea).find("td:eq(7)");
   const nombre = $(linea).find("td:eq(3)");
   const parentesco = $(linea).find("td:eq(8)");
   const genero = $(linea).find("td:eq(9)");
   const cuenta = $(linea).find("td:eq(10)");
   const correo = $(linea).find("td:eq(11)");
   const fecha_ingreso = $(linea).find("td:eq(12)");

   $("#trabajador").attr('disabled','disabled');
   $("#id").val(id.text());
   $("#trabajador").val(trabajador.text());
   $("#movimiento").val(movimiento.text());
   $("#nacionalidad").val(nacionalidad.text());
   $("#cedula").attr('disabled','disabled');
   $("#cedula").val(cedula.text());
   $("#fecha_nacimiento").val(fecha_nacimiento.text());
   $("#nombre").val(nombre.text());
   $("#parentesco").val(parentesco.text());
   $("#genero").val(genero.text());
   $("#cuenta").val(cuenta.text());
   $("#correo").val(correo.text());
   $("#fecha_ingreso").val(fecha_ingreso.text());
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
                       text: "El Familiar del trabajador fue eliminado con éxito!",
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