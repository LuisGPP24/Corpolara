<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles y permisos</title>

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
                                    <h2 class="card-title">Roles y Permisos</h2>
                                </div>
                                <div class="col-auto">

                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalSolicitudes" id='btn_registrar'>
                                        Registrar
                                    </button>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="tablaSolicitudes" class="table table-hover table-striped mt-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($consultas as $consulta) : ?>
                                            <tr>
                                                <td><?= $consulta["id"] ?></td>
                                                <td><?= $consulta["nombre"] ?></td>
                                                <td><?= $consulta["descripcion"] ?></td>
                                                <td>
                                                    <div class='btn-group' role='group' aria-label='optiones buttons'>
                                                        <button onclick="modalPermisos(this)" id="btn-permisos" class="btn btn-warning">
                                                            <i class="bi bi-key"></i>
                                                        </button>
                                                        <button onclick="modalModificar(this)" id="btn-modificar" class="btn btn-primary">
                                                            <i class="bi bi-pencil-square"></i>
                                                        </button>
                                                        <button onclick="eliminar(this)" id="btn_eliminar" class="btn btn-danger">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>

    </div>

    <!-- Modal Gestion-->
    <div class="modal fade" id="modalSolicitudes" tabindex="-1" aria-labelledby="modalSolicitudesLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalSolicitudesLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="formSolicitudes" action="" method="POST">

                        <input type="text" class="d-none" id="id" placeholder="id">

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nombre" placeholder="nombre">
                                    <label for="nombre">Nombre del Rol</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="descripcion" placeholder="descripcion">
                                        <label for="descripcion">Descripción del rol</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formSolicitudes" id="registrar" class="btn btn-success">registrar</button>
                    <button type="submit" form="formSolicitudes" id="modificar" class="btn btn-primary">modificar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Permisos de rol-->

    <div class="modal fade" id="modalPassword" tabindex="-1" aria-labelledby="modalPasswordLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalPasswordLabel">Permisos de Rol: <span id="rol-titulo"> </span> </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Botón único para alternar selección -->
                             <div class="row text-end mb-2">
                                <div class="col">

                                    <button id="btn-toggle-seleccion" class="btn btn-primary btn-sm">Seleccionar Todos</button>
                                </div>
                             </div>
                            <form id="formulario_permisos" method="post">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <div class="table-responsive card">
                                            <table class="table table-hover">
                                                <thead>
                                                    <th class="text-center">#</th>
                                                    <th>Listado de Módulos</th>
                                                    <th class="text-center">Acceso</th>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($lista_permisos as $permiso) : ?>
                                                        <tr id="fila-modulo-<?= $permiso["id"] ?>">
                                                            <td class="text-center"><?= $permiso["id"] ?></td>
                                                            <td><?= $permiso["nombre"] ?></td>
                                                            <td class="text-center">
                                                                <input type="checkbox" class="form-check-input x-permiso" name="acceso[<?= $permiso["id"] ?>]">
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formulario_permisos" id="cambiar" class="btn btn-warning">Cambiar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/permisos.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>