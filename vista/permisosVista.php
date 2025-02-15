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
                    <h1 class="modal-title fs-5" id="modalPasswordLabel">Permisos de Rol:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">                            
                            <form id="formulario_permisos" method="post">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                         <div class="table-responsive card">
                                            <table class="table table-hover">
                                                <thead>
                                                    <th class="text-center">Listado de Módulos</th>
                                                    <th class="text-center">Acceso</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Gestionar de Trabajadores</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_trabajadores" name="modulo_trabajadores[]">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gestionar Antecedentes</td>
                                                            <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_antecedentes" name="modulo_antecedentes">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gestionar Carga Familiar</td>
                                                            <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_carga_familiar" name="modulo_carga_familiar">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gestionar Expedientes</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_expedientes" name="modulo_expedientes">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gestionar Solicitudes</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_registro_solicitudes" name="modulo_registro_solicitudes">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gestionar Farmacia</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_farmacia" name="modulo_farmacia">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gestionar Estudios Médicos</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_estudios_medicos" name="modulo_estudios_medicos">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gestionar Funeraria</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_funeraria" name="modulo_funeraria">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ficha de personal</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_ficha" name="modulo_ficha">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Planillas de Solicitudes</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_planillas" name="modulo_planillas">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Reportes Estadísticos</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_reportes_estadisticos" name="modulo_reportes_estadisticos">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gestionar Facturas</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_facturas" name="modulo_facturas">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gestionar Consultas Médicas</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_consultas_medicas" name="modulo_consultas_medicas">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gestionar Consultas Pediátricas</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_consultas_pediatricas" name="modulo_consultas_pediatricas">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gestionar Salida de Insumos</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_salida_insumos" name="modulo_salida_insumos">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Inventario</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_inventarios" name="modulo_inventarios">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Usuarios</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_usuarios" name="modulo_usuarios">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Permisos</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_permisos" name="modulo_permisos">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Bitácora</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_bitacora" name="modulo_bitacora">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Manual de usuario</td>
                                                        <td class="text-center">
                                                            <input type="checkbox" class="form-check-input" id="modulo_manual" name="modulo_manual">
                                                        </td>
                                                    </tr>
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
                    <button type="submit" form="formPassword" id="cambiar" class="btn btn-warning">Cambiar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/permisos.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>