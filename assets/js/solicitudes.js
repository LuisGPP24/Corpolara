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

$(document).ready(function (){    

    $("#exportar_excel").click(function (e) {
      e.preventDefault();

      const data = new FormData();
      data.append("accion", "exportarExcel");

      $.ajax({
        url: " ", 
        type: "POST",
        contentType: false,
        data: data,
        processData: false,
        cache: false,
        dataType: "json", 
        success: function (response) {
          
          if (!response.success) {
            Toast.fire({
              icon: "error",
              title: `${response.message}`,
            });
          }

          const datos = response.data;

          // Crear contenido para Excel separado por tabulaciones
          let contenido = "";

          // Agregar encabezados (columnas)
          contenido += Object.keys(datos[0]).join("\t") + "\n";

          // Agregar filas de datos
          datos.forEach(row => {
            contenido += Object.values(row).join("\t") + "\n";
          });

          // Convertir el contenido a Blob
          const blob = new Blob([contenido], { type: "application/vnd.ms-excel" });

          // Crear enlace de descarga
          const url = window.URL.createObjectURL(blob);
          const a = document.createElement("a");
          a.href = url;
          a.download = "solicitudes.xls";
          document.body.appendChild(a);
          a.click();

          // Limpiar recursos
          window.URL.revokeObjectURL(url);
          document.body.removeChild(a);
        },
        error: function ({ responseText }, status, error) {
          Toast.fire({
          icon: "error",
          title: `${responseText}`,
        });
        },
      });

  });
    
      
  $("#btn_registrar").click(function (e) {       
  $("#modalSolicitudesLabel").text('Registro de Solicitudes');       
  $("#registrar").show();
  $("#modificar").hide();        
  $("#codigo").removeAttr("disabled");        
  $("#numero_registro").removeAttr("disabled");        
  $("#trabajador").removeAttr("disabled");        
  borrarForm();    
});     
  
$("#modalSolicitudes").submit(function (e) {        
    e.preventDefault();

        
    const montoSolicitado = $("#monto_solicitado").val();        
    const montoAprobado = $("#monto_aprobado").val();  
        
    const regex = /^[0-9]{1,12}[.]{0,1}[0-9]{2}$/; 
      
    if (!regex.test(montoSolicitado)) {            
                                 
        Toast.fire({                
            icon: "error",                
            title: "Escriba bien el monto solicitado, Por favor.",              
        });

        return;        
    }

    if (!regex.test(montoAprobado)) {            
        
        Toast.fire({                
            icon: "error",                
            title: "Escriba bien el monto aprobado, Por favor.",              
        });

        return;
    }
        const data = new FormData();
        const btn_clicked = e.originalEvent.submitter.id;
        data.append("accion", btn_clicked);
        data.append("id", $("#id").val());        
        data.append("codigo", $("#codigo").val());        
        data.append("numero_registro", $("#numero_registro").val());        
        data.append("trabajador", $("#trabajador").val());        
        data.append("cedula", $("#cedula").val());        
        data.append("nombre", $("#nombre").val());        
        data.append("telefono", $("#telefono").val());        
        data.append("tipo_solicitud", $("#tipo_solicitud").val());        
        data.append("sub_tipo_solicitud", $("#sub_tipo_solicitud").val());        
        data.append("estado_solicitud", $("#estado_solicitud").val());        
        data.append("descripcion", $("#descripcion").val());        
        data.append("financiado", $("#financiado").val());        
        data.append("remitido", $("#remitido").val());        
        data.append("monto_solicitado", montoSolicitado);        
        data.append("monto_aprobado", montoAprobado);   
        data.append("monto_divisas", $("#monto_divisas").val());     
        data.append("fecha_registro", $("#fecha_registro").val());        
        data.append("condicion", $("#condicion").val());        
        data.append("estatus", $("#estatus").val());        
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
              title: responseText,            
            });          
          },          
          complete: function () {                
            $("#modalSolicitudes").modal("hide");                
            borrarForm();            
          },        
        });    
    });
});

function borrarForm() {

   $('#id').val('');
   $('#codigo').val('');
   $('#numero_registro').val('');
   $('#trabajador').val('');
   $('#cedula').val('');
   $('#nombre').val('');
   $('#telefono').val('');
   $('#tipo_solicitud').val('');
   $('#sub_tipo_solicitud').val('');
   $('#estado_solicitud').val('');
   $('#descripcion').val('');
   $('#financiado').val('');
   $('#remitido').val('');
   $('#monto_solicitado').val('');
   $('#monto_aprobado').val('');
   $('#monto_divisas').val('');
   $('#fecha_registro').val('');
   $('#condicion').val('');
   $('#estatus').val('');
   $('#observacion').val('');
   
}

function modalModificar(fila) {
   $("#modalSolicitudesLabel").text("Modificar Solicitud");

  $("#registrar").hide();
  $("#modificar").show();
   

   $("#modalSolicitudes").modal("show");
     
   const linea = $(fila).closest("tr");
   const id = $(linea).find("td:eq(1)");
   const codigo = $(linea).find("td:eq(2)");
   const numero_registro = $(linea).find("td:eq(3)");
   const trabajador = $(linea).find("td:eq(0)");
   const cedula = $(linea).find("td:eq(5)");
   const nombre = $(linea).find("td:eq(6)");
   const telefono = $(linea).find("td:eq(7)");
   const tipo_solicitud = $(linea).find("td:eq(8)");
   const sub_tipo_solicitud = $(linea).find("td:eq(9)");
   const estado_solicitud = $(linea).find("td:eq(10)");
   const descripcion = $(linea).find("td:eq(11)");
   const financiado = $(linea).find("td:eq(12)");
   const remitido = $(linea).find("td:eq(13)");
   const monto_solicitado = $(linea).find("td:eq(14)");
   const monto_aprobado = $(linea).find("td:eq(15)");
   const monto_divisas = $(linea).find("td:eq(16)");
   const fecha_registro = $(linea).find("td:eq(17)");
   const condicion = $(linea).find("td:eq(18)");
   const estatus = $(linea).find("td:eq(19)");
   const observacion = $(linea).find("td:eq(20)");
   

   $("#trabajador").attr('disabled','disabled');
   $("#codigo").attr('disabled','disabled');
   $("#numero_registro").attr('disabled','disabled');
   $("#id").val(id.text());
   $("#codigo").val(codigo.text());
   $("#numero_registro").val(numero_registro.text());
   $("#trabajador").val(trabajador.text());
   $("#cedula").val(cedula.text());
   $("#nombre").val(nombre.text());
   $("#telefono").val(telefono.text()); 
   $("#tipo_solicitud").val(tipo_solicitud.text());
   $("#sub_tipo_solicitud").val(sub_tipo_solicitud.text());
   $("#estado_solicitud").val(estado_solicitud.text()); 
   $("#descripcion").val(descripcion.text());
   $("#financiado").val(financiado.text()); 
   $("#remitido").val(remitido.text()); 
   $("#monto_solicitado").val(monto_solicitado.text());
   $("#monto_aprobado").val(monto_aprobado.text());
   $("#monto_divisas").val(monto_divisas.text()); 
   $("#fecha_registro").val(fecha_registro.text());
   $("#condicion").val(condicion.text());
   $("#estatus").val(estatus.text());
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
