<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Morbilidad Pediatrica</title>

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
                                    <h2 class="card-title">Gestión de Morbilidad Pediátrica</h2>
                                </div>
                                <div class="col-auto">

                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalConsulta" id='btn_registrar'>
                                        Registrar
                                    </button>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="tablaConsulta_Pediatrica" class="table table-hover table-striped mt-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">id_trabajadores</th>
                                            <th>ID</th>
                                            <th>Representante</th>
                                            <th>Fecha de la consulta</th>
                                            <th>Nombre del paciente</th>
                                            <th>Cedula del paciente</th>
                                            <th>Fecha de nacimiento</th>
                                            <th>Genero del Paciente</th>
                                            <th>Telefono</th>
                                            <th>Especialidad</th>
                                            <th>Observacion</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                   
                                       <?php foreach ($consultas as $consulta) : ?>
                                            <tr>
                                                <td class="d-none"><?= $consulta["id_trabajadores"] ?></td>
                                                <td><?= $consulta["id"] ?></td>
                                                <td><?= $consulta["nombre"] ?></td>
                                                <td><?= $consulta["fecha_consulta"] ?></td>
                                                <td><?= $consulta["nombre_paciente"] ?></td>
                                                <td><?= $consulta["cedula_paciente"] ?></td>
                                                <td><?= $consulta["fecha_nacimiento"] ?></td>
                                                <td><?= $consulta["genero"] ?></td>
                                                <td><?= $consulta["telefono"] ?></td>
                                                <td><?= $consulta["doctor"] ?></td>
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
                                    <select class="selectpicker form-control" name="representante" id="representante" data-live-search="true" data-show-subtext="true">
                                        <option value=""></option>
                                        <?php foreach ($consulta_trabajadores as $trabajador) : ?>
                                            <option value="<?= $trabajador['id'] ?>"><?= $trabajador['nombre'] ?>
                                            </option>
                                        <?php endforeach ?>
                                    </select>
                                    <label for="representante">Representante</label>
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
                                    <input type="date" class="form-control" id="fecha_nacimiento" placeholder="fecha_nacimiento">
                                    <label for="fecha_nacimiento">Fecha de nacimiento</label>
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
                                    <input type="text" class="form-control" id="telefono" placeholder="telefono">
                                    <label for="telefono">Telefono</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">                            
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select class="form-control" name="doctor" id="doctor">
                                        <option value="" hidden="" selected="hidden">Seleccionar Opcion</option>
                                        <option value=""></option>
                                        <option value="Pediatria">Dra. Marisabel Rodríguez</option>
                                    </select>
                                    <label for="doctor">Doctor(a) que lo atendió</label>
                                </div>
                            </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="observacion" placeholder="observacion">
                                <label for="observacion">Observación</label>
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



    <script src="assets/js/consultasPediatricas.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>