<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Morbilidad</title>

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
                                    <h2 class="card-title">Gestión de Morbilidad</h2>
                                </div>
                                <div class="col-auto">

                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalConsulta" id='btn_registrar'>
                                        Registrar
                                    </button>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="tablaConsulta" class="table table-hover table-striped mt-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">id_trabajadores</th>
                                            <th>ID</th>
                                            <th>Nombre del trabajador</th>
                                            <th>Cedula del trabajador</th>
                                            <th>Fecha de Consulta</th>
                                            <th>Nombre del Paciente</th>
                                            <th>Cedula del paciente</th>
                                            <th>Estado del Paciente</th>
                                            <th>Genero del paciente</th>
                                            <th>Edad del paciente</th>
                                            <th>Dirección del paciente</th>
                                            <th>Gerencia</th>
                                            <th>Telefono</th>
                                            <th>Motivo de la consulta</th>
                                            <th>Especialidad</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                   
                                       <?php foreach ($consultas as $consulta) : ?>
                                            <tr>
                                                <td class="d-none"><?= $consulta["id_trabajadores"] ?></td>
                                                <td><?= $consulta["id"] ?></td>
                                                <td><?= $consulta["nombre"] ?></td>
                                                <td><?= $consulta["cedula2"] ?></td>
                                                <td><?= $consulta["fecha_consulta"] ?></td>
                                                <td><?= $consulta["nombre_paciente"] ?></td>
                                                <td><?= $consulta["cedula"] ?></td>
                                                <td><?= $consulta["parentesco"] ?></td>
                                                <td><?= $consulta["genero"] ?></td>
                                                <td><?= $consulta["edad_paciente"] ?></td>
                                                <td><?= $consulta["direccion"] ?></td>
                                                <td><?= $consulta["gerencia"] ?></td>
                                                <td><?= $consulta["telefono"] ?></td>
                                                <td><?= $consulta["motivo"] ?></td>
                                                <td><?= $consulta["especialidad"] ?></td>
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
    <div class="modal fade" id="modalConsulta" tabindex="-1" aria-labelledby="modalConsultaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalConsultaLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="formConsulta" action="" method="POST">
                        
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
                                    <input type="date" class="form-control" id="fecha_consulta" placeholder="fecha_consulta">
                                    <label for="fecha_consulta">Fecha de la consulta</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nombre_paciente" placeholder="nombre_paciente">
                                    <label for="nombre_paciente">Nombre del paciente</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="cedula_paciente" placeholder="cedula_paciente">
                                    <label for="cedula_paciente">Cedula del paciente</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-control" name="parentesco" id="parentesco">
                                        <option value="" hidden="" selected="hidden">Seleccionar Opcion</option>
                                        <option value=""></option>
                                        <option value="padre">Padre</option> 
                                        <option value="madre">Madre</option>
                                        <option value="hijo">Hijo(a)</option>
                                        <option value="conyuge">Conyuge</option>
                                        <option value="servidor activo">Servidor Activo</option>
                                        <option value="jubilado">Jubilado</option>
                                    </select>
                                    <label for="parentesco">Estado del paciente</label>
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
                                    <label for="genero">Genero del paciente</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="direccion" placeholder="direccion">
                                    <label for="direccion">Dirección del paciente</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="gerencia" placeholder="gerencia">
                                    <label for="gerencia">Gerencia</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="telefono" placeholder="telefono">
                                    <label for="telefono">Telefono</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="motivo" placeholder="motivo">
                                    <label for="motivo">Motivo de consulta</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="edad" placeholder="edad">
                                    <label for="edad">Edad</label>
                                </div>
                            </div>   
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-control" name="doctor" id="doctor">
                                        <option value="" hidden="" selected="hidden">Seleccionar Opcion</option>
                                        <option value=""></option>
                                        <option value="Psicologia">Dr. Naudy Peña -- Psicologia</option> 
                                        <option value="Medicina_general">Dra. Freinfa Yustiz -- Medicina General</option>
                                        <option value="Medicina_general">Dra. Teresa Briceño -- Medicina General</option>
                                    </select>
                                    <label for="doctor">Doctor(a) que lo atendió</label>
                                </div>
                            </div>   
                        </div>                    
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formConsulta" id="registrar" class="btn btn-success">registrar</button>
                    <button type="submit" form="formConsulta" id="modificar" class="btn btn-primary">modificar</button>
                </div>
            </div>
        </div>
    </div>



    <script src="assets/js/consultasMedicas.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>