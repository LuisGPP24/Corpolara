<!DOCTYPE html>
<html lang="es">

<head>
  <title>CorpoLara</title>
  <link rel="icon" href="assets/icons/logo.webp">

  <script src="assets/js/librerias/jquery-3.7.1.min.js"></script>
  <script src="assets/js/librerias/sweetalert2.all.min.js"></script>

  <script src="assets/js/librerias/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>

  <section class="vh-100" style="background-color: #8b0000;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-xl-10">
          <div class="card" style="border-radius: 1rem;">
            <div class="row g-0">

              <div class="col-md-6 col-lg-5 d-none d-md-block">
                <img src="assets/img/corpolara.jpg" alt="logo corpolara" class="img-fluid" style="border-radius: 1rem 0 0 1rem;width:500px" />
              </div>

              <div class="col-md-6 col-lg-7 d-flex align-items-center">
                <div class="card-body p-4 p-lg-5 text-black">

                  <form class="login-form" action="" method="POST" id="inicio_sesion">

                    <center>
                      <h1>BIENVENIDO</h1>
                    </center>

                    <center>
                      <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Iniciar Sesión</h5>
                      <center>

                        <div data-mdb-input-init class="mb-4">
                          <input type="text" id="cedula" name="cedula" class="form-control form-control-lg" placeholder="Cedula" />
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                          <input type="password" id="contrasena" name="contrasena" class="form-control form-control-lg" placeholder="Contraseña" />
                        </div>

                        <div class="pt-1 mb-4">
                          <button data-mdb-button-init data-mdb-ripple-init class="btn btn-dark btn-lg btn-block" type="submit" id="enviar_datos">Entrar</button>
                        </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script src="assets/js/login.js"></script>
</body>

</html>