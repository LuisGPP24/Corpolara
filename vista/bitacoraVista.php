<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitacora</title>

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
                                    <h2 class="card-title">Bitácora de Usuarios</h2>
                                </div>
                                <div class="col-auto">

                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalFacturas" id='btn_registrar' >
                                        <i class="bi bi-trash"></i> Vaciar
                                    </button>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="tablaFacturas" class="table table-hover table-striped mt-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Nombre</th>
                                            <th>Modulo</th>
                                            <th>Fecha de Registro</th>
                                            <th>Hora de registro</th>
                                            <th>Acción realizada</th>
                                        </tr>
                                    </thead>
                                   
                                        <!--<?php foreach ($consultas as $consulta) : ?>
                                            <tr>
                                                <td class="d-none"><?= $consulta["id_solicitudes"] ?></td>
                                                <td><?= $consulta["id"] ?></td>
                                                <td><?= $consulta["nombre_solicitante"] ?></td>
                                                <td><?= $consulta["cedula_solicitante"] ?></td>
                                                <td><?= $consulta["codigo_registro"] ?></td>
                                                <td><?= $consulta["numero_factura"] ?></td>
                                                <td><?= $consulta["descripcion"] ?></td>
                                            </tr>
                                        <?php endforeach; ?>-->
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
    <div class="modal fade" id="modalFacturas" tabindex="-1" aria-labelledby="modalFacturasLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalFacturasLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="formFacturas" action="" method="POST">

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
                                        <input type="text" class="form-control" id="numero_factura" placeholder="numero_factura">
                                        <label for="numero_factura">Número de factura</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="descripcion" placeholder="descripcion">
                                    <label for="descripcion">Descripción/Concepto</label>
                                </div>
                            </div>
                        </div>  

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="monto" placeholder="monto">
                                        <label for="monto">Monto en Bs.</label>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formFacturas" id="registrar" class="btn btn-success">registrar</button>
                    <button type="submit" form="formFacturas" id="modificar" class="btn btn-primary">modificar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/bitacora.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>