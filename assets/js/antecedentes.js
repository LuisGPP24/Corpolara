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
        $("#modalAntecedentesLabel").text('Registro de Antecedentes del trabajador');
        $("#registrar").show();
        $("#modificar").hide();
        $("#trabajador").removeAttr("disabled")
        borrarForm();
    });
    
    $("#formAntecedentes").submit(function (e) { 
        e.preventDefault();
        
        const data = new FormData();

        const btn_clicked = e.originalEvent.submitter.id;

        data.append("accion", btn_clicked);
        data.append("trabajador", $("#trabajador").val());
        data.append("antecedentes_cardiovasculares", $("#antecedentes_cardiovasculares").val());
        data.append("antecedentes_pulmonares", $("#antecedentes_pulmonares").val());
        data.append("antecedentes_digestivos", $("#antecedentes_digestivos").val());
        data.append("antecedentes_diabeticos", $("#antecedentes_diabeticos").val());
        data.append("antecedentes_renales", $("#antecedentes_renales").val());
        data.append("alergias", $("#alergias").val());
        data.append("otros", $("#otros").val());
        data.append("tratamientos", $("#tratamientos").val());
        data.append("especificaciones_tratamiento", $("#especificaciones_tratamiento").val());
        data.append("intervenciones", $("#intervenciones").val());
        data.append("fecha_intervencion", $("#fecha_intervencion").val());
        data.append("edad_intervencion", $("#edad_intervencion").val());
        data.append("descripcion_intervencion", $("#descripcion_intervencion").val());
        data.append("accidentes", $("#accidentes").val());
        data.append("fecha_accidente", $("#fecha_accidente").val());
        data.append("edad_accidente", $("#edad_accidente").val());
        data.append("descripcion_accidente", $("#descripcion_accidente").val());
        data.append("antecedentes_tabaquismo", $("#antecedentes_tabaquismo").val());
        data.append("antecedentes_alcoholismo", $("#antecedentes_alcoholismo").val());

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
                $("#modalAntecedentes").modal("hide");
            borrarForm();
                
            },
        });
    });
});

function borrarForm() {

   $('#trabajador').val('');
   $('#antecedentes_cardiovasculares').val('');
   $('#antecedentes_pulmonares').val('');
   $('#antecedentes_digestivos').val('');
   $('#antecedentes_diabeticos').val('');
   $('#antecedentes_renales').val('');
   $('#alergias').val('');
   $('#otros').val('');
   $('#tratamientos').val('');
   $('#especificaciones_tratamiento').val('');
   $('#intervenciones').val('');
   $('#fecha_intervencion').val('');
   $('#edad_intervencion').val('');
   $('#descripcion_intervencion').val('');
   $('#accidentes').val('');
   $('#fecha_accidente').val('');
   $('#edad_accidente').val('');
   $('#descripcion_accidente').val('');
   $('#antecedentes_tabaquismo').val('');
   $('#antecedentes_alcoholismo').val('');
}

function modalModificar(fila) {
   $("#modalAntecedentesLabel").text("Modificar Antecedentes del Trabajador");

  $("#registrar").hide();
  $("#modificar").show();
   

   $("#modalAntecedentes").modal("show");
     
   const linea = $(fila).closest("tr");
   const trabajador = $(linea).find("td:eq(0)");
   const antecedentes_cardiovasculares = $(linea).find("td:eq(4)");
   const antecedentes_pulmonares = $(linea).find("td:eq(5)");
   const antecedentes_digestivos = $(linea).find("td:eq(6)");
   const antecedentes_diabeticos = $(linea).find("td:eq(7)");
   const antecedentes_renales = $(linea).find("td:eq(8)");
   const alergias = $(linea).find("td:eq(9)");
   const otros = $(linea).find("td:eq(10)");
   const tratamientos = $(linea).find("td:eq(11)");
   const especificaciones_tratamiento = $(linea).find("td:eq(12)");
   const intervenciones = $(linea).find("td:eq(13)");
   const fecha_intervencion = $(linea).find("td:eq(14)");
   const edad_intervencion = $(linea).find("td:eq(15)");
   const descripcion_intervencion = $(linea).find("td:eq(16)");
   const accidentes = $(linea).find("td:eq(17)");
   const fecha_accidente = $(linea).find("td:eq(18)");
   const edad_accidente = $(linea).find("td:eq(19)");
   const descripcion_accidente = $(linea).find("td:eq(20)");
   const antecedentes_tabaquismo = $(linea).find("td:eq(21)");
   const antecedentes_alcoholismo = $(linea).find("td:eq(22)");

   $("#trabajador").attr('disabled','disabled');
   $("#trabajador").val(trabajador.text());
   $("#antecedentes_cardiovasculares").val(antecedentes_cardiovasculares.text());
   $("#antecedentes_pulmonares").val(antecedentes_pulmonares.text());
   $("#antecedentes_digestivos").val(antecedentes_digestivos.text());
   $("#antecedentes_diabeticos").val(antecedentes_diabeticos.text());
   $("#antecedentes_renales").val(antecedentes_renales.text());
   $("#alergias").val(alergias.text());
   $("#otros").val(otros.text());
   $("#tratamientos").val(tratamientos.text());
   $("#especificaciones_tratamiento").val(especificaciones_tratamiento.text());
   $("#intervenciones").val(intervenciones.text());
   $("#fecha_intervencion").val(fecha_intervencion.text());
   $("#edad_intervencion").val(edad_intervencion.text());
   $("#descripcion_intervencion").val(descripcion_intervencion.text());
   $("#accidentes").val(accidentes.text());
   $("#fecha_accidente").val(fecha_accidente.text());
   $("#edad_accidente").val(edad_accidente.text());
   $("#descripcion_accidente").val(descripcion_accidente.text());
   $("#antecedentes_tabaquismo").val(antecedentes_tabaquismo.text());
   $("#antecedentes_alcoholismo").val(antecedentes_alcoholismo.text());

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
            const trabajador = $(linea).find("td:eq(0)");

            const data = new FormData();
            data.append("accion", "eliminar");
            data.append("trabajador", trabajador.text());
            
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
                       text: "Los antecedentes del trabajador fueron eliminados con éxito",
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