<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expedientes de trabajadores</title>

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
                                    <h2 class="card-title">Expedientes de trabajadores</h2>
                                </div>
                                <div class="col-auto">

                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalExpediente" id='btn_registrar'>
                                        Registrar
                                    </button>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="tablaExpedientes" class="table table-hover table-striped mt-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">id_trabajadores</th>
                                            <th>ID</th>
                                            <th>Nombre del trabajador</th>
                                            <th>Cedula</th>
                                            <th>Unidad Organizativa</th>
                                            <th>Fecha de registro<th>
                                            <th>Expediente</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                   
                                        <?php foreach ($consultas as $consulta) : ?>
                                            <tr>
                                                <td class="d-none"><?= $consulta["id_trabajadores"] ?></td>
                                                <td><?= $consulta["id"] ?></td>
                                                <td><?= $consulta["nombre"] ?></td>
                                                <td><?= $consulta["cedula"] ?></td>
                                                <td><?= $consulta["unidad_organizativa"] ?></td>
                                                <td><?= $consulta["fecha_registro"] ?></td>
                                                <td colspan="2" class="text-center">
                                                <a href="assets/expediente-<?= $consulta["cedula"] ?>.pdf" target="_blank">
                                                    <i class="bi bi-filetype-pdf"></i>
                                                </a>
                                            </td>
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
    <div class="modal fade" id="modalExpediente" tabindex="-1" aria-labelledby="modalExpedienteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalExpedienteLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="formExpediente" action="" method="POST" enctype="multipart/form-data">

                        <input type="text" class="d-none" id="id" placeholder="id">

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="selectpicker form-control" name="trabajador" id="trabajador" name="trabajador" data-live-search="true" data-show-subtext="true">
                                        <option value=""></option>
                                        <?php foreach ($consulta_trabajadores as $trabajadores) : ?>
                                            <option value="<?= $trabajadores['id'] ?>"> 
                                                <?= $trabajadores['cedula'] ?> -- <?= $trabajadores['nombre'] ?> -- <?= $trabajadores['unidad_organizativa'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                    <label for="trabajador">Trabajador</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="fecha_registro" name="fecha_registro" placeholder="fecha">
                                    <label for="fecha_registro">Fecha de registro</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="expediente" class="form-label">Expediente del trabajador</label>
                                <input class="form-control" id="expediente" name="expediente" type="file" accept=".pdf">
                            </div>
                        </div>

                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formExpediente" id="registrar" class="btn btn-success">registrar</button>
                    <button type="submit" form="formExpediente" id="modificar" class="btn btn-primary">modificar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/expedientes.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>