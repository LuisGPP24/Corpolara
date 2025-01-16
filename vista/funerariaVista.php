<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funeraria</title>

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
                                    <h2 class="card-title">Gestión de Solicitudes de Funeraria</h2>
                                </div>
                                <div class="col-auto">

                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalFuneraria" id='btn_registrar'>
                                        Registrar
                                    </button>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="tablaFuneraria" class="table table-hover table-striped mt-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">id_trabajadores</th>
                                            <th>ID</th>
                                            <th>Codigo del registro</th>
                                            <th>Ente</th>                                            
                                            <th>Trabajador/Titular</th>
                                            <th>Cedula del trabajador</th>
                                            <th>Nombre del beneficiario</th>
                                            <th>Cedula del beneficiario</th>
                                            <th>Tipo de Solicitud</th>
                                            <th>Telefono</th>
                                            <th>Defunción del paciente</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                   
                                        <?php foreach ($consultas as $consulta) : ?>
                                            <tr>
                                                <td class="d-none"><?= $consulta["id_solicitudes"] ?></td>
                                                <td><?= $consulta["id"] ?></td>
                                                <td><?= $consulta["codigo_registro"] ?></td>
                                                <td><?= $consulta["ente"] ?></td>                                                
                                                <td><?= $consulta["nombre"] ?></td>
                                                <td><?= $consulta["cedula"] ?></td>                                                 
                                                <td><?= $consulta["nombre_solicitante"] ?></td>
                                                <td><?= $consulta["cedula_solicitante"] ?></td>
                                                <td><?= $consulta["tipo_solicitud"] ?></td>
                                                <td><?= $consulta["telefono_solicitante"] ?></td>
                                                <td><?= $consulta["defuncion_paciente"] ?></td>
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
    <div class="modal fade" id="modalFuneraria" tabindex="-1" aria-labelledby="modalFunerariaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalFunerariaLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="formFuneraria" action="" method="POST">

                        <input type="text" class="d-none" id="id" placeholder="id">

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="selectpicker form-control" name="codigo_registro" id="codigo_registro" data-live-search="true" data-show-subtext="true">
                                        <option value=""></option>
                                        <?php foreach ($consulta_solicitudes as $solicitudes) : ?>
                                            <option value="<?= $solicitudes['id'] ?>"> 
                                                <?= $solicitudes['codigo_registro'] ?> -- <?= $solicitudes['nombre_solicitante'] ?> -- <?= $solicitudes['tipo_solicitud'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                    <label for="codigo_registro">Codigo Del Registro</label>
                                </div>
                            </div>
                        </div>                        

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="ente" placeholder="ente">
                                        <label for="ente">Ente</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="defuncion_paciente" placeholder="defuncion_paciente">
                                    <label for="defuncion_paciente">Defunción del Paciente</label>
                                </div>
                            </div>
                        </div>                          
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formFuneraria" id="registrar" class="btn btn-success">registrar</button>
                    <button type="submit" form="formFuneraria" id="modificar" class="btn btn-primary">modificar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/funeraria.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>