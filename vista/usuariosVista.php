<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Usuarios</title>

    <?php require_once('comunes/head.php') ?>

</head>

<body class="sb-nav-fixed">
    <!-- menu arriba -->
    <?php require_once("comunes/menu.php"); ?>
    <!-- contenedor de menu lateral y main -->
    <div id="layoutSidenav">
        <!-- menu lateral -->
        <div id="layoutSidenav_nav">
            <?php require_once("comunes/menu_lateral.php"); ?>
        </div>
        <!-- contenido de la pagina -->
        <div id="layoutSidenav_content">
            <main class="bg-color-gray">
                <!-- Aqui va todo el contenido -->
                <div class="container-fluid px-3">

                    <div class="card shadow-sm rounded mt-3">
                        <div class="card-body">

                            <div class="row mt-2 mb-4">
                                <div class="col-auto me-auto mb-2">
                                    <h2 class="card-title">Gestión de usuarios</h2>
                                </div>
                                <div class="col-auto">

                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalUsuarios" id='btn_registrar'>
                                        Registrar
                                    </button>

                                </div>
                            </div>

                            <table id="tablaUsuarios" class="table table-hover table-striped mt-3" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cedula</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>
                </div>

            </main>
        </div>

    </div>

    <!-- Modal Gestion-->
    <div class="modal fade" id="modalUsuarios" tabindex="-1" aria-labelledby="modalUsuariosLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalUsuariosLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="formUsuarios" action="" method="POST">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="cedula" placeholder="cedula">
                                    <label for="cedula">Cedula</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nombre" placeholder="nombre">
                                    <label for="nombre">Nombre</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3" id="row_password">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="contrasena" placeholder="contrasena">
                                    <label for="contrasena">Contraseña</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="contrasena2" placeholder="contrasena2">
                                    <label for="contrasena2">Confirmar contraseña</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="correo" placeholder="correo">
                                    <label for="correo">Correo</label>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formUsuarios" id="registrar" class="btn btn-success">registrar</button>
                    <button type="submit" form="formUsuarios" id="modificar" class="btn btn-primary">modificar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal contrasena-->

    <div class="modal fade" id="modalPassword" tabindex="-1" aria-labelledby="modalPasswordLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalPasswordLabel">Gestión Contraseña</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="formPassword" action="" method="POST">

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" disabled id="cedula_editar" placeholder="cedula_editar">
                                    <label for="cedula_editar">Cedula</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="contrasena_editar" placeholder="contrasena_editar">
                                    <label for="contrasena_editar">Contraseña</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="contrasena2_editar" placeholder="contrasena2_editar">
                                    <label for="contrasena2_editar">Confirmar contraseña</label>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formPassword" id="cambiar" class="btn btn-warning">Cambiar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/usuarios.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>
<!-- 
<div class='btn-group' role='group' aria-label='optiones buttons'>
    <button onclick="modalModificar(this)" class="btn btn-primary">
        <i class="bi bi-pencil-square"></i>
    </button>
    <button onclick="modalPassword(this)" class="btn btn-warning">
        <i class="bi bi-key-fill"></i>
    </button>
    <button onclick="eliminar(this)" id="btn_eliminar" class="btn btn-danger">
        <i class="bi bi-trash-fill"></i>
    </button>
</div> -->