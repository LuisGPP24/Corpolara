<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Solicitudes</title>

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
                                    <h2 class="card-title">Gestión de Solicitudes</h2>
                                </div>
                                <div class="col-auto">

                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#" id=''>
                                        Exportar
                                    </button>

                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalSolicitudes" id='btn_registrar'>
                                        Registrar
                                    </button>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="tablaSolicitudes" class="table table-hover table-striped mt-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">id_trabajadores</th>
                                            <th>ID</th>
                                            <th>Codigo del registro</th>
                                            <th>N° del registro</th>
                                            <th>Trabajador/Titular</th>
                                            <th>Cedula del solicitante</th>
                                            <th>Nombre del Solicitante</th>
                                            <th>Telefono del Solicitante</th>
                                            <th>Tipo de Solicitud</th>
                                            <th>Sub-tipo de Solicitud</th>
                                            <th>Estado</th>
                                            <th>Descripción de la Solicitud</th>
                                            <th>Financiado por:</th>
                                            <th>Remitido a:</th>
                                            <th>Monto Solicitado</th>
                                            <th>Monto Aprobado</th>
                                            <th>Fecha de Registro</th>
                                            <th>Condición</th>
                                            <th>Estatus</th>
                                            <th>Observación</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                   
                                        <?php foreach ($consultas as $consulta) : ?>
                                            <tr>
                                                <td class="d-none"><?= $consulta["id_trabajadores"] ?></td>
                                                <td><?= $consulta["id"] ?></td>
                                                <td><?= $consulta["codigo_registro"] ?></td>
                                                <td><?= $consulta["numero_registro"] ?></td>
                                                <td><?= $consulta["nombre"] ?></td>
                                                <td><?= $consulta["cedula_solicitante"] ?></td>
                                                <td><?= $consulta["nombre_solicitante"] ?></td>
                                                <td><?= $consulta["telefono_solicitante"] ?></td>
                                                <td><?= $consulta["tipo_solicitud"] ?></td>
                                                <td><?= $consulta["sub_tipo_solicitud"] ?></td>
                                                <td><?= $consulta["estado_solicitud"] ?></td>
                                                <td><?= $consulta["descripcion_solicitud"] ?></td>
                                                <td><?= $consulta["financiado"] ?></td>
                                                <td><?= $consulta["remitido"] ?></td>
                                                <td><?= $consulta["monto"] ?></td>
                                                <td><?= $consulta["monto_aprobado"] ?></td>
                                                <td><?= $consulta["fecha_registro"] ?></td>
                                                <td><?= $consulta["condicion"] ?></td>
                                                <td><?= $consulta["estatus"] ?></td>
                                                <td><?= $consulta["observacion"] ?></td>
                                                <td>
                                                    <div class='btn-group' role='group' aria-label='optiones buttons'>
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
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="codigo" placeholder="codigo">
                                    <label for="codigo">Codigo del Registro</label>
                                </div>
                            </div>
                            <div class="col-md-6"> 
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="numero_registro" placeholder="numero_registro">
                                    <label for="numero_registro">N° del Registro</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="selectpicker form-control" name="trabajador" id="trabajador" data-live-search="true" data-show-subtext="true">
                                        <option value=""></option>
                                        <?php foreach ($consulta_trabajadores as $trabajador) : ?>
                                            <option value="<?= $trabajador['id'] ?>"> 
                                                <?= $trabajador['cedula'] ?> -- <?= $trabajador['nombre'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                    <label for="trabajador">Trabajador</label>
                                </div>
                            </div>
                        </div>                        

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="cedula" placeholder="cedula">
                                        <label for="cedula">Cedula del Solicitante</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nombre" placeholder="nombre">
                                    <label for="nombre">Nombre del Solicitante</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="telefono" placeholder="telefono">
                                    <label for="telefono">Telefono del Solicitante</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-control" name="tipo_solicitud" id="tipo_solicitud">
                                        <option value="" hidden="" selected="hidden">Seleccionar Opcion</option>
                                        <option value=""></option>
                                        <option value="consultas">Consultas</option> 
                                        <option value="ecografias">Ecografías</option> 
                                        <option value="estudios">Estudios</option>
                                        <option value="examenes">Examenes</option> 
                                        <option value="farmacia">Farmacia</option> 
                                        <option value="funeraria">Funeraria</option> 
                                        <option value="reembolso">Reembolso</option> 
                                    </select>
                                    <label for="tipo_solicitud">Tipo de Solicitud</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="sub_tipo_solicitud" placeholder="sub_tipo_solicitud">
                                    <label for="sub_tipo_solicitud">Sub-tipo de Solicitud</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-control" name="estado_solicitud" id="estado_solicitud">
                                        <option value="" hidden="" selected="hidden">Seleccionar Opcion</option>
                                        <option value=""></option>
                                        <option value="activo">Activo</option> 
                                        <option value="jubilado">Jubilado</option>
                                    </select>
                                    <label for="estado_solicitud">Estado</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="descripcion" placeholder="descripcion">
                                    <label for="descripcion">Descripción de la Solicitud</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="financiado" placeholder="financiado">
                                    <label for="financiado">Financiado por:</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="remitido" placeholder="remitido">
                                    <label for="remitido">Remitido a:</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="monto_solicitado" placeholder="monto_solicitado">
                                    <label for="monto_solicitado">Monto Solicitado</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="monto_aprobado" placeholder="monto_aprobado">
                                    <label for="monto_aprobado">Monto aprobado</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="fecha_registro" placeholder="fecha_registro">
                                    <label for="fecha_registro">Fecha de registro</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-control" name="condicion" id="condicion">
                                        <option value="" hidden="" selected="hidden">Seleccionar Opcion</option>
                                        <option value=""></option>
                                        <option value="titular">Titular</option> 
                                        <option value="beneficiario">Beneficiario</option>
                                    </select>
                                    <label for="condicion">Condición</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-control" name="estatus" id="estatus">
                                        <option value="" hidden="" selected="hidden">Seleccionar Opcion</option>
                                        <option value=""></option>
                                        <option value="anulado">Anulado</option>
                                        <option value="aprobado">Aprobado</option> 
                                        <option value="atendido">Atendido</option>
                                        <option value="autorizado">Autorizado</option>
                                        <option value="cerrado">Cerrado</option>
                                        <option value="devuelto">Devuelto</option>
                                        <option value="diferido">Diferido</option>
                                        <option value="en_estudio">En estudio</option>
                                        <option value="en_proceso">En proceso</option>
                                        <option value="procesado">Procesado</option>
                                        <option value="negado">Negado</option>
                                    </select>
                                    <label for="estatus">Estatus</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="observacion" placeholder="observacion">
                                    <label for="observacion">Observación</label>
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

    <script src="assets/js/solicitudes.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>