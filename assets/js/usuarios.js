var tabla;

const Toast = Swal.mixin({
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

  tabla = $("#tablaUsuarios").DataTable({
    language: {
      url: "./assets/es-ES.json",
    },
    pagingType: "simple_numbers",
    ajax: {
      url: " ",
      type: "POST",
      dataSrc: "data",
      data: { accion: "listar" },
    },
    columns: [
      { data: "id" },
      { data: "cedula" },
      { data: "nombre" },
      { data: "correo" },
      { data: "rol" },
      { data: "id_rol", visible: false },
      { target: -1, defaultContent: "" },
    ],
    columnDefs: [
      {
        target: -1,
        searchable: false,
        render: function (data, type, row, meta) {
          const btn_modificar =
            "<button onclick='modalModificar(this)'  class='btn btn-primary'><i class='bi bi-pencil-square'></i></button>";
          const btn_password =
            "<button onclick='modalPassword(this)' class='btn btn-warning'><i class='bi bi-key-fill'></i></button>";
          const btn_eliminar =
            " <button  onclick='eliminar(this)' class='btn btn-danger'><i class='bi bi-trash-fill'></i></button>";

          return (
            "<div class='btn-group' role='group' aria-label='optiones buttons'>" +
            btn_modificar +
            btn_password +
            btn_eliminar +
            "</div>"
          );
        },
      },
    ],
    drawCallback: function (settings, json) {
      // Agregar atributo data-id a cada fila después de que se haya inicializado la tabla
      this.api()
        .rows()
        .every(function () {
          let data = this.data();
          let id = data.id; // Suponiendo que "id" es el ID único de la fila
          $(this.node()).attr("data-id", id);
        });
    },
  });

    $("#btn_registrar").click(function (e) {
        $("#modalUsuariosLabel").text('Gestión Registro');
        $("#registrar").show();
        $("#modificar").hide();
        $("#row_password").show();
        $("#cedula").removeAttr("disabled")
        borrarForm();
    });
    
    
    $("#formPassword").submit(function (event) {
      event.preventDefault();

      const data = new FormData();


        data.append("accion", "cambiar");
        data.append("cedula", $("#cedula_editar").val());
        data.append("contrasena", $("#contrasena_editar").val());
        data.append("contrasena2", $("#contrasena2_editar").val());
      

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
            title: `exito`,
            text: `${response}`,
          });

        },
        error: function ({ responseText }, status, error) {
          Toast.fire({
            icon: "error",
            title: `${responseText}`,
          });
        },
        complete: function () {
            $("#modalPassword").modal("hide");
            borrarForm();
        },
      });
    });

    $("#formUsuarios").submit(function (event) { 
        event.preventDefault();
        
        const data = new FormData();
        

        const btn_clicked = event.originalEvent.submitter.id;

        data.append("accion", btn_clicked);
        data.append("cedula", $("#cedula").val());
        data.append("nombre", $("#nombre").val());
        data.append("correo", $("#correo").val());
        data.append("rol", $("#rol").val());
        
        if (btn_clicked === 'registrar') {
            
            data.append("contrasena", $("#contrasena").val());
            data.append("contrasena2", $("#contrasena2").val());

        } 
        
        
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
                    title: `exito`,
                    text: `${response}`
                });
                
              tabla.ajax.reload(null, false);
            },
            error: function ({ responseText }, status, error) {
                Toast.fire({
                    icon: "error",
                    title: `${responseText}`,
                });
            }, 
            complete: function () {
                $("#modalUsuarios").modal("hide");
            borrarForm();
                
            }
        });
    });

    
});
function modalPassword(fila) {
    const linea = $(fila).closest("tr");
    const cedula = $(linea).find("td:eq(1)");
    $("#cedula_editar").val(cedula.text());


    $("#modalPassword").modal("show");
}
 function modalModificar(fila) {
   $("#modalUsuariosLabel").text("Gestión Modificar");

   $("#registrar").hide();
   $("#modificar").show();
   $("#row_password").hide();

   $("#modalUsuarios").modal("show");

   const idFila = $(fila).closest("tr").data("id");
   // Buscar el índice de la fila correspondiente al ID único
   let indiceFila = tabla.row('[data-id="' + idFila + '"]').index();

   const cedula = tabla.cell(indiceFila, 1).data();
   const nombre = tabla.cell(indiceFila, 2).data();
   const correo = tabla.cell(indiceFila, 3).data();
   const rol = tabla.cell(indiceFila, 5).data();
   
   $("#cedula").attr("disabled", "disabled");
   $("#cedula").val(cedula);
   $("#nombre").val(nombre);
   $("#correo").val(correo);
    $("#rol").val(rol);
 }
 
function borrarForm() {
    $('#cedula').val('');
    $('#nombre').val('');
    $('#correo').val('');
    $("#contrasena").val('');
    $("#contrasena2").val('');
    $("#rol").val('');

    $('#cedula_editar').val('');
    $("#contrasena_editar").val('');
    $("#contrasena2_editar").val('');
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
                       text: "el usuario ha sido eliminado con exito con cedula ",
                       icon: "success",
                    });
                  
                  tabla.ajax.reload(null, false);
                  
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