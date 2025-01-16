<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Antecedentes</title>

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
                                    <h2 class="card-title">Gestión de Antecedentes de trabajadores</h2>
                                </div>
                                <div class="col-auto">

                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAntecedentes" id='btn_registrar'>
                                        Registrar
                                    </button>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="tablaAntecedentes" class="table table-hover table-striped mt-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">id_trabajadores</th>
                                            <th>ID</th>
                                            <th>Cedula</th>
                                            <th>Trabajador</th>
                                            <th>Antecedentes cardiovasculares</th>
                                            <th>Antecedentes pulmonares</th>
                                            <th>Antecedentes digestivos</th>
                                            <th>Antecedentes de diabetes</th>
                                            <th>Antecedentes renales</th>
                                            <th>Alergias</th>
                                            <th>Otros</th>
                                            <th>Tratamientos</th>
                                            <th>Especificaciones de tratamientos</th>
                                            <th>Intervenido quirúrjicamente</th>
                                            <th>Fecha de intervención</th>
                                            <th>Edad en la intervención</th>
                                            <th>Descripción de la intervención</th>
                                            <th>Accidentes</th>
                                            <th>Fecha del accidente</th>
                                            <th>Edad en el accidente</th>
                                            <th>Descripción del accidente</th>
                                            <th>Antecedentes de tabaquismo</th>
                                            <th>Antecedentes de alcoholismo</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($consultas as $consulta) : ?>
                                            <tr>
                                                <td class="d-none"><?= $consulta["id_trabajadores"] ?></td>
                                                <td><?= $consulta["id"] ?></td>
                                                <td><?= $consulta["cedula"] ?></td>
                                                <td><?= $consulta["nombre"] ?></td>
                                                <td><?= $consulta["ant_cardiovasculares"] ?></td>
                                                <td><?= $consulta["ant_pulmonares"] ?></td>
                                                <td><?= $consulta["ant_digestivos"] ?></td>
                                                <td><?= $consulta["ant_diabetes"] ?></td>
                                                <td><?= $consulta["ant_renales"] ?></td>
                                                <td><?= $consulta["alergias"] ?></td>
                                                <td><?= $consulta["otros"] ?></td>
                                                <td><?= $consulta["tratamiento"] ?></td>
                                                <td><?= $consulta["especificacion_tratamiento"] ?></td>
                                                <td><?= $consulta["int_quirurjico"] ?></td>
                                                <td><?= $consulta["fecha_intervencion"] ?></td>
                                                <td><?= $consulta["edad_intervencion"] ?></td>
                                                <td><?= $consulta["descripcion_intervencion"] ?></td>
                                                <td><?= $consulta["accidentes"] ?></td>
                                                <td><?= $consulta["fecha_accidente"] ?></td>
                                                <td><?= $consulta["edad_accidente"] ?></td>
                                                <td><?= $consulta["descripcion_accidente"] ?></td>
                                                <td><?= $consulta["ant_tabaquismo"] ?></td>
                                                <td><?= $consulta["ant_alcoholismo"] ?></td>
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
    <div class="modal fade" id="modalAntecedentes" tabindex="-1" aria-labelledby="modalAntecedentesLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalAntecedentesLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="formAntecedentes" action="" method="POST">

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="selectpicker form-control" name="trabajador" id="trabajador" data-live-search="true" data-show-subtext="true">
                                        <!--<option value="" hidden="" selected="hidden">Seleccione una Opcion</option>-->
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
                                    <input type="text" class="form-control" id="antecedentes_cardiovasculares" placeholder="Antecedentes cardiovasculares">
                                    <label for="antecedentes_cardiovasculares">Antecedentes cardiovasculares</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="antecedentes_pulmonares" placeholder="Antecedentes pulmonares">
                                    <label for="antecedentes_pulmonares">Antecedentes Pulmonares</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="antecedentes_digestivos" placeholder="Antecedentes digestivos">
                                    <label for="antecedentes_digestivos">Antecedentes digestivos</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="antecedentes_diabeticos" placeholder="Antecedentes de diabetes">
                                    <label for="antecedentes_diabeticos">Antecedentes de diabetes</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="antecedentes_renales" placeholder="Antecedentes renales">
                                    <label for="antecedentes_renales">Antecedentes renales</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="alergias" placeholder="Alergias">
                                    <label for="alergias">Alergias</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="otros" placeholder="otros">
                                    <label for="otros">Otros</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="tratamientos" placeholder="tratamientos">
                                    <label for="tratamientos">Tratamientos</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="especificaciones_tratamiento" placeholder="especificaciones_tratamiento">
                                    <label for="especificaciones_tratamiento">Especificaciones del tratamiento</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="intervenciones" placeholder="intervenciones">
                                    <label for="intervenciones">Intervenido quirurjicamente</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="fecha_intervencion" placeholder="fecha_intervencion">
                                    <label for="fecha_intervencion">Fecha de la intervención</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="edad_intervencion" placeholder="edad_intervencion">
                                    <label for="edad_intervencion">Edad de su intervención</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="descripcion_intervencion" placeholder="descripcion_intervencion">
                                    <label for="descripcion_intervencion">Descripción de la intervención</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="accidentes" placeholder="accidentes">
                                    <label for="accidentes">Accidentes</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="fecha_accidente" placeholder="fecha_accidente">
                                    <label for="fecha_accidente">Fecha del accidente</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="edad_accidente" placeholder="edad_accidente">
                                    <label for="edad_accidente">Edad que tenia</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="descripcion_accidente" placeholder="descripcion_accidente">
                                    <label for="descripcion_accidente">Descripción del accidente</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="antecedentes_tabaquismo" placeholder="antecedentes_tabaquismo">
                                    <label for="antecedentes_tabaquismo">Antecedentes de Tabaquismo</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="antecedentes_alcoholismo" placeholder="antecedentes_alcoholismo">
                                    <label for="antecedentes_alcoholismo">Antecedentes de Alcoholismo</label>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formAntecedentes" id="registrar" class="btn btn-success">registrar</button>
                    <button type="submit" form="formAntecedentes" id="modificar" class="btn btn-primary">modificar</button>
                </div>
            </div>
        </div>
    </div>



    <script src="assets/js/antecedentes.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>