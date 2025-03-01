<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salida de Insumos</title>

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
                                    <h2 class="card-title">Salida de Insumos - Servicios Médicos</h2>
                                </div>
                                <div class="col-auto">

                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalSalidaInsumo" id='btn_registrar'>
                                        Registrar
                                    </button>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="tablaSalidaInsumo" class="table table-hover table-striped mt-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">id_trabajadores</th>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>Nombre y apellido</th>
                                            <th>Cédula</th>
                                            <th>Unidad Organizativa</th>
                                            <th>Insumo Utilizado</th>
                                            <th>Cantidad suministrada</th>
                                            <th>Entregado por:</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>

                                    <?php foreach ($consultas as $consulta) : ?>
                                        <tr>
                                            <td class="d-none"><?= $consulta["id_trabajadores"] ?></td>
                                            <td class="d-none"><?= $consulta["id_inventario"] ?></td>
                                            <td><?= $consulta["id"] ?></td>
                                            <td><?= $consulta["fecha"] ?></td>
                                            <td><?= $consulta["nombre"] ?></td>
                                            <td><?= $consulta["cedula"] ?></td>
                                            <td><?= $consulta["unidad_organizativa"] ?></td>
                                            <td><?= $consulta["nombre_insumo"] ?></td>
                                            <td><?= $consulta["cantidad"] ?></td>
                                            <td><?= $consulta["entregado_por"] ?></td>
                                            <td>
                                                <div class='btn-group' role='group' aria-label='optiones buttons'>
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
    <div class="modal fade" id="modalSalidaInsumo" tabindex="-1" aria-labelledby="modalSalidaInsumoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalSalidaInsumoLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="formSalidaInsumo" action="" method="POST">

                        <input type="text" class="d-none" id="id" placeholder="id">

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="fecha" placeholder="fecha">
                                        <label for="fecha">Fecha</label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row mb-3">
                            <div class="col-md-8">
                                <div class="form-floating">
                                    <select class="form-control" name="insumo" id="insumo">
                                        <option value=""></option>
                                        <?php foreach ($consulta_inventario as $inventario) : ?>
                                            <option value="<?= $inventario['id'] ?>">
                                                <?= $inventario['codigo_insumo'] ?> -- <?= $inventario['nombre_insumo'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                    <label for="insumo">Insumo</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="cantidad_insumo" placeholder="Cantidad Disponible" disabled>
                                    <label for="cantidad_insumo">Cantidad</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="selectpicker form-control" name="trabajador" id="trabajador" data-live-search="true" data-show-subtext="true">
                                        <option value=""></option>
                                        <?php foreach ($consulta_trabajadores as $trabajadores) : ?>
                                            <option value="<?= $trabajadores['id'] ?>">
                                                <?= $trabajadores['cedula'] ?> -- <?= $trabajadores['nombre'] ?>
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
                                        <input type="text" class="form-control" id="cantidad" placeholder="cantidad">
                                        <label for="cantidad">Cantidad suministrada</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="entregado" placeholder="entregado">
                                        <label for="entregado">Entregado por</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formSalidaInsumo" id="registrar" class="btn btn-success">registrar</button>
                    <button type="submit" form="formSalidaInsumo" id="modificar" class="btn btn-primary">modificar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/salidaInsumos.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>