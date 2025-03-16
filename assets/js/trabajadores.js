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
        $("#modalTrabajadoresLabel").text('Registro de trabajador');
        $("#registrar").show();
        $("#modificar").hide();
        $("#cedula").removeAttr("disabled")
        borrarForm();
    });
    
    $("#formTrabajadores").submit(function (e) { 
        e.preventDefault();
        
        const data = new FormData();

        const btn_clicked = e.originalEvent.submitter.id;

        data.append("accion", btn_clicked);
        data.append("fecha_registro", $("#fecha_registro").val());
        data.append("personal", $("#personal").val());
        data.append("cedula", $("#cedula").val());
        data.append("nombre", $("#nombre").val());
        data.append("unidad_organizativa", $("#unidad_organizativa").val());
        data.append("fecha_nacimiento", $("#fecha_nacimiento").val());
        data.append("pais", $("#pais_nacimiento").val());
        data.append("estado", $("#estado").val());
        data.append("municipio", $("#municipio").val());
        data.append("telefono", $("#telefono").val());
        data.append("correo", $("#correo").val());
        data.append("direccion", $("#direccion").val());
        data.append("cuenta", $("#cuenta").val());
        data.append("profesion", $("#profesion").val());
        data.append("genero", $("#genero").val());
        data.append("estado_civil", $("#estado_civil").val());
        data.append("talla_camisa", $("#camisa").val());
        data.append("talla_calzado", $("#calzado").val());
        data.append("talla_pantalon", $("#pantalon").val());
        data.append("sangre", $("#sangre").val());
        data.append("vacuna", $("#vacuna").val());
        data.append("covid", $("#covid").val());

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
                $("#modalTrabajadores").modal("hide");
            borrarForm();
                
            },
        });
    });
});

function borrarForm() {
    $('#fecha_registro').val('');
    $('#personal').val('');
    $('#cedula').val('');
    $("#nombre").val('');
    $("#unidad_organizativa").val('');
    $('#fecha_nacimiento').val('');
    $("#pais_nacimiento").val('');
    $("#estado").val('');
    $("#municipio").val('');
    $("#telefono").val('');
    $("#correo").val('');
    $("#direccion").val('');
    $("#cuenta").val('');
    $("#profesion").val('');
    $("#genero").val('');
    $("#estado_civil").val('');
    $("#camisa").val('');
    $("#calzado").val('');
    $("#pantalon").val('');
    $("#sangre").val('');
    $("#vacuna").val('');
    $("#covid").val('');
}

function modalModificar(fila) {
   $("#modalTrabajadoresLabel").text("Modificar Trabajador");

  $("#registrar").hide();
  $("#modificar").show();
   

   $("#modalTrabajadores").modal("show");
     
   const linea = $(fila).closest("tr");
   const cedula = $(linea).find("td:eq(1)");
   const nombre = $(linea).find("td:eq(2)");
   const fecha_registro = $(linea).find("td:eq(3)");
   const personal = $(linea).find("td:eq(4)");
   const unidad_organizativa = $(linea).find("td:eq(5)");
   const fecha_nacimiento = $(linea).find("td:eq(6)");
   const pais_nacimiento = $(linea).find("td:eq(7)");
   const estado = $(linea).find("td:eq(8)");
   const municipio = $(linea).find("td:eq(9)");
   const telefono = $(linea).find("td:eq(10)");
   const correo = $(linea).find("td:eq(11)");
   const direccion = $(linea).find("td:eq(12)");
   const cuenta = $(linea).find("td:eq(13)");
   const profesion = $(linea).find("td:eq(14)");
   const genero = $(linea).find("td:eq(15)");
   const estado_civil = $(linea).find("td:eq(16)");
   const camisa = $(linea).find("td:eq(17)");
   const calzado = $(linea).find("td:eq(18)");
   const pantalon = $(linea).find("td:eq(19)");
   const sangre = $(linea).find("td:eq(20)");
   const vacuna = $(linea).find("td:eq(21)");
   const covid = $(linea).find("td:eq(22)");

   $("#cedula").attr('disabled','disabled');
   $("#cedula").val(cedula.text());
   $("#nombre").val(nombre.text());
   $("#fecha_registro").val(fecha_registro.text());
   $("#personal").val(personal.text());
   $("#unidad_organizativa").val(unidad_organizativa.text());
   $("#fecha_nacimiento").val(fecha_nacimiento.text());
   $("#pais_nacimiento").val(pais_nacimiento.text());
   $("#estado").val(estado.text());
   $("#municipio").val(municipio.text());
   $("#telefono").val(telefono.text());
   $("#correo").val(correo.text());
   $("#direccion").val(direccion.text());
   $("#cuenta").val(cuenta.text());
   $("#profesion").val(profesion.text());
   $("#genero").val(genero.text());
   $("#estado_civil").val(estado_civil.text());
   $("#camisa").val(camisa.text());
   $("#calzado").val(calzado.text());
   $("#pantalon").val(pantalon.text());
   $("#sangre").val(sangre.text());
   $("#vacuna").val(vacuna.text());
   $("#covid").val(covid.text());

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
            const cedula = $(linea).find("td:eq(1)");

            const data = new FormData();
            data.append("accion", "eliminar");
            data.append("cedula", cedula.text());
            
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
                       text: "el trabajador ha sido eliminado con exito con cedula ",
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