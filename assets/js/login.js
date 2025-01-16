$(document).ready(function () {
    
    $("#inicio_sesion").submit(function (e) { 
        e.preventDefault();
        
        const data = new FormData();


        data.append("accion", "login");
        data.append("cedula", $("#cedula").val());
        data.append("contrasena", $("#contrasena").val());

        $.ajax({
          async: true,
          url: " ",
          type: "POST",
          contentType: false,
          data: data,
          processData: false,
          cache: false,
          success: function (response) {
              
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
              Toast.fire({
                icon: "success",
                title: `${response}`,
                text: "Tus datos fueron enviados de manera exitosa!",
                //title: "Muy bien!!",
              });
            
             setTimeout(() => location = "?pagina=home", 3000);
          },
          error: function ({ responseText }, status, error) {
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
            Toast.fire({
              icon: "error",
              title: `${responseText}`,
            });
          },
        });
    });
});