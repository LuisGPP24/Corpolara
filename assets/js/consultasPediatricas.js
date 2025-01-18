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
        $("#modalConsultaLabel").text('Registro de Consultas Pediátricas');
        $("#registrar").show();
        $("#modificar").hide();
        $("#trabajador").removeAttr("disabled")
        $("#cedula_paciente").removeAttr("disabled")
        borrarForm();
    });
    
    $("#modalConsulta").submit(function (e) { 
        e.preventDefault();
        
        const data = new FormData();

        const btn_clicked = e.originalEvent.submitter.id;

        data.append("accion", btn_clicked);
        data.append("id", $("#id").val());
        data.append("representante", $("#representante").val());
        data.append("fecha_consulta", $("#fecha_consulta").val());
        data.append("nombre_paciente", $("#nombre_paciente").val());
        data.append("cedula_paciente", $("#cedula_paciente").val());
        data.append("fecha_nacimiento", $("#fecha_nacimiento").val());
        data.append("genero", $("#genero").val());
        data.append("telefono", $("#telefono").val());
        data.append("doctor", $("#doctor").val());
        data.append("observacion", $("#observacion").val());
                
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
                $("#modalConsulta").modal("hide");
            borrarForm();
                
            },
        });
    });
});

function borrarForm() {

   $('#id').val('');
   $('#representante').val('');
   $('#fecha_consulta').val('');
   $('#nombre_paciente').val('');
   $('#cedula_paciente').val('');
   $('#fecha_nacimiento').val('');
   $('#genero').val('');
   $('#telefono').val('');
   $('#doctor').val('');
   $('#observacion').val('');
   
}

function modalModificar(fila) {
   $("#modalConsultaLabel").text("Modificar Consultas Pediátricas");

  $("#registrar").hide();
  $("#modificar").show();
   

   $("#modalConsulta").modal("show");

  
   const linea = $(fila).closest("tr");
   const representante = $(linea).find("td:eq(0)");
   const id = $(linea).find("td:eq(1)");
   const fecha_consulta = $(linea).find("td:eq(3)");
   const nombre_paciente = $(linea).find("td:eq(4)");
   const cedula_paciente = $(linea).find("td:eq(5)");
   const fecha_nacimiento = $(linea).find("td:eq(6)");
   const genero = $(linea).find("td:eq(7)");
   const telefono = $(linea).find("td:eq(8)");
   const doctor = $(linea).find("td:eq(9)");
   const observacion = $(linea).find("td:eq(10)");

   $("#trabajador").attr('disabled','disabled');
   $("#id").val(id.text());
   $("#representante").val(representante.text());
   $("#fecha_consulta").val(fecha_consulta.text());
   $("#nombre_paciente").val(nombre_paciente.text());
   $("#cedula_paciente").attr('disabled','disabled');
   $("#cedula_paciente").val(cedula_paciente.text());
   $("#fecha_nacimiento").val(fecha_nacimiento.text());
   $("#genero").val(genero.text());
   $("#telefono").val(telefono.text());
   $("#doctor").val(doctor.text());
   $("#observacion").val(observacion.text());
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