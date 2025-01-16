<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Carga familiar</title>

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
                                    <h2 class="card-title">Gestión de Carga familiar de trabajadores</h2>
                                </div>
                                <div class="col-auto">

                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalFamilia" id='btn_registrar'>
                                        Registrar
                                    </button>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="tablaFamilia" class="table table-hover table-striped mt-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">id_trabajadores</th>
                                            <th>ID</th>
                                            <th>Trabajador</th>
                                            <th>Familiar</th>
                                            <th>Movimiento</th>
                                            <th>Nacionalidad</th>
                                            <th>Cédula del Familiar</th>
                                            <th>Fecha de Nacimiento</th>
                                            <th>Parentesco</th>
                                            <th>Género</th>
                                            <th>Cuenta Bancaria</th>
                                            <th>Correo</th>
                                            <th>Fecha de Ingreso</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                   
                                       <?php foreach ($consultas as $consulta) : ?>
                                            <tr>
                                                <td class="d-none"><?= $consulta["id_trabajadores"] ?></td>
                                                <td><?= $consulta["id"] ?></td>
                                                <td><?= $consulta["nombre"] ?></td>
                                                <td><?= $consulta["nombre2"] ?></td>
                                                <td><?= $consulta["movimiento"] ?></td>
                                                <td><?= $consulta["nacionalidad"] ?></td>
                                                <td><?= $consulta["cedula"] ?></td>
                                                <td><?= $consulta["fecha_nacimiento"] ?></td>
                                                <td><?= $consulta["parentesco"] ?></td>
                                                <td><?= $consulta["genero"] ?></td>
                                                <td><?= $consulta["cuenta"] ?></td>
                                                <td><?= $consulta["correo"] ?></td>
                                                <td><?= $consulta["fecha_ingreso"] ?></td>
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
    <div class="modal fade" id="modalFamilia" tabindex="-1" aria-labelledby="modalFamiliaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalFamiliaLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="formFamilia" action="" method="POST">
                        
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

                       <input type="text" class="d-none" id="id" placeholder="id">
                                    
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-control" name="movimiento" id="movimiento">
                                        <option value="" hidden="" selected="hidden">Seleccionar Opcion</option>
                                        <option value=""></option>
                                        <option value="alta">Alta</option> 
                                        <option value="baja">Baja</option>
                                    </select>
                                    <label for="movimiento">Movimiento</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nacionalidad" placeholder="nacionalidad">
                                    <label for="nacionalidad">Nacionalidad del Familiar</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="cedula" placeholder="cedula">
                                    <label for="cedula">Cédula del familiar</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="fecha_nacimiento" placeholder="fecha_nacimiento">
                                    <label for="fecha_nacimiento">Fecha de nacimiento</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                                    <label for="nombre">Nombre del familiar</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-control" name="parentesco" id="parentesco">
                                        <option value="" hidden="" selected="hidden">Seleccionar Opcion</option>
                                        <option value=""></option>
                                        <option value="madre">Madre</option> 
                                        <option value="padre">Padre</option> 
                                        <option value="hijo">Hijo(a)</option>
                                        <option value="hermano">Hermano(a)</option> 
                                    </select>
                                    <label for="parentesco">Parentesco</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-control" name="genero" id="genero">
                                        <option value="" hidden="" selected="hidden">Seleccionar Opcion</option>
                                        <option value=""></option>
                                        <option value="masculino">Masculino</option> 
                                        <option value="femenino">Femenino</option>
                                    </select>
                                    <label for="genero">Género</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="cuenta" placeholder="cuenta">
                                    <label for="cuenta">Cuenta Bancaria</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="correo" placeholder="correo">
                                    <label for="correo">Correo electrónico</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="fecha_ingreso" placeholder="fecha_ingreso">
                                    <label for="fecha_ingreso">Fecha de Ingreso</label>
                                </div>
                            </div>
                        </div>
                        
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formFamilia" id="registrar" class="btn btn-success">registrar</button>
                    <button type="submit" form="formFamilia" id="modificar" class="btn btn-primary">modificar</button>
                </div>
            </div>
        </div>
    </div>



    <script src="assets/js/carga_familiar.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>