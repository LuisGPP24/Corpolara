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

                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalFarmacia" id='btn_registrar'>
                                        Registrar
                                    </button>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="tablaFarmacia" class="table table-hover table-striped mt-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="d-none">id_trabajadores</th>
                                            <th>ID</th>
                                            <th>Codigo del registro</th>
                                            <th>Fecha de la Solicitud</th>
                                            <th>Ente</th>                               
                                            <th>Trabajador/Titular</th>
                                            <th>Cedula del trabajador</th>
                                            <th>Nombre del beneficiario</th>
                                            <th>Cedula del beneficiario</th>
                                            <th>Fecha de nacimiento</th>
                                            <th>Parentesco</th>
                                            <th>Tipo de Solicitud</th>
                                            <th>Descripcion de Solicitud</th>
                                            <th>Telefono</th>
                                            <th>Patología/Sintomatologia</th>
                                            <th>Proveedor</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                   
                                        <!--<?php foreach ($consultas as $consulta) : ?>
                                            <tr>
                                                <td class="d-none"><?= $consulta["id_solicitudes"] ?></td>
                                                <td><?= $consulta["id"] ?></td>
                                                <td><?= $consulta["codigo_registro"] ?></td>
                                                <td><?= $consulta["fecha_registro"] ?></td>
                                                <td><?= $consulta["ente"] ?></td>                                                
                                                <td><?= $consulta["nombre"] ?></td>
                                                <td><?= $consulta["cedula"] ?></td>                                                 
                                                <td><?= $consulta["nombre_solicitante"] ?></td>
                                                <td><?= $consulta["cedula_solicitante"] ?></td>
                                                <td><?= $consulta["fecha_nacimiento"] ?></td>
                                                <td><?= $consulta["parentesco"] ?></td>
                                                <td><?= $consulta["tipo_solicitud"] ?></td>
                                                <td><?= $consulta["descripcion_solicitud"] ?></td>
                                                <td><?= $consulta["telefono_solicitante"] ?></td>
                                                <td><?= $consulta["patologia"] ?></td>                                                
                                                <td><?= $consulta["proveedor"] ?></td>
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
    <div class="modal fade" id="modalFarmacia" tabindex="-1" aria-labelledby="modalFarmaciaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalFarmaciaLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="formFarmacia" action="" method="POST">

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
                                    <input type="text" class="form-control" id="descripcion_solicitud" placeholder="descripcion_solicitud">
                                    <label for="descripcion_solicitud">Descripción de la Solicitud</label>
                                </div>
                            </div>
                        </div>  

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="fecha_nacimiento" placeholder="fecha_nacimiento">
                                        <label for="fecha_nacimiento">Fecha de nacimiento</label>
                                    </div>
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
                                        <option value="hermano">Hermano</option>
                                    </select>
                                    <label for="parentesco">Parentesco</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="patologia" placeholder="patologia">
                                        <label for="patologia">Patología/Sintomatologia</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="proveedor" placeholder="proveedor">
                                        <label for="proveedor">Proveedor</label>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formFarmacia" id="registrar" class="btn btn-success">registrar</button>
                    <button type="submit" form="formFarmacia" id="modificar" class="btn btn-primary">modificar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/salidaInsumos.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>