<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Trabajadores</title>

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
                                    <h2 class="card-title">Gestión de trabajadores</h2>
                                </div>
                                <div class="col-auto">

                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalTrabajadores" id='btn_registrar'>
                                        Registrar
                                    </button>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="tablaTrabajadores" class="table table-hover table-striped mt-3" style="width:100%">
                                    <thead>
                                        <tr>
                                           <th>ID</th>
                                           <th>Cedula</th>
                                           <th>Nombre</th>
                                           <th>Fecha de registro</th>
                                           <th>Tipo de personal</th>
                                           <th>Unidad organizativa</th>
                                           <th>Fecha de nacimiento</th>
                                           <th>País de nacimiento</th>
                                           <th>Estado de nacimiento</th>
                                           <th>Municipio de nacimiento</th>
                                           <th>Teléfono</th>
                                           <th>Correo</th>
                                           <th>Dirección</th>
                                           <th>Cuenta bancaria</th>
                                           <th>Profesión</th>
                                           <th>Genero</th>
                                           <th>Estado civil</th>
                                           <th>Talla de camisa</th>
                                           <th>Talla de calzado</th>
                                           <th>Talla de pantalón</th>
                                           <th>Tipo de sangre</th>
                                           <th>Vacunas</th>
                                           <th>Covid</th>
                                           <th>Opciones</th>
                                           </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($consultas as $consulta) : ?>
                                            <tr>
                                                <td><?= $consulta["id"] ?></td>
                                                <td><?= $consulta["cedula"] ?></td>
                                                <td><?= $consulta["nombre"] ?></td>
                                                <td><?= $consulta["fecha_registro"] ?></td>
                                                <td><?= $consulta["personal_contratado"] ?></td>
                                                <td><?= $consulta["unidad_organizativa"] ?></td>
                                                <td><?= $consulta["fecha"] ?></td>
                                                <td><?= $consulta["pais"] ?></td>
                                                <td><?= $consulta["estado"] ?></td>
                                                <td><?= $consulta["municipio"] ?></td>
                                                <td><?= $consulta["telefono"] ?></td>
                                                <td><?= $consulta["correo"] ?></td>
                                                <td><?= $consulta["direccion"] ?></td>
                                                <td><?= $consulta["cuenta"] ?></td>
                                                <td><?= $consulta["profesion"] ?></td>
                                                <td><?= $consulta["genero"] ?></td>
                                                <td><?= $consulta["estado_civil"] ?></td>
                                                <td><?= $consulta["talla_camisa"] ?></td>
                                                <td><?= $consulta["talla_calzado"] ?></td>
                                                <td><?= $consulta["talla_pantalon"] ?></td>
                                                <td><?= $consulta["tipo_sangre"] ?></td>
                                                <td><?= $consulta["vacunas"] ?></td>
                                                <td><?= $consulta["covid"] ?></td>
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
    <div class="modal fade" id="modalTrabajadores" tabindex="-1" aria-labelledby="modalTrabajadoresLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTrabajadoresLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="formTrabajadores" action="" method="POST">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="fecha_registro" placeholder="fecha">
                                    <label for="fecha_registro">Fecha</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                	<select class="form-control" name="personal" id="personal">
                                        <option value="" hidden="" selected="hidden">Seleccionar Opcion</option>
                                        <option value=""></option>
                                        <option value="activo">Activo</option> 
                                        <option value="jubilado">Jubilado</option>
                                    </select>
                                    <label for="personal">Tipo de personal</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="cedula" placeholder="cedula">
                                    <label for="cedula">Cedula</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nombre" placeholder="nombre">
                                    <label for="nombre">Nombre Completo</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="unidad_organizativa" placeholder="unidad_organizativa">
                                    <label for="unidad_organizativa">Unidad organizativa</label>
                                </div>
                            </div>                           
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="fecha_nacimiento" placeholder="fecha_nacimiento">
                                    <label for="fecha_nacimiento">Fecha de nacimiento</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="pais_nacimiento" placeholder="pais_nacimiento">
                                    <label for="pais_nacimiento">País de nacimiento</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="estado" placeholder="estado">
                                    <label for="estado">Estado de nacimiento</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="municipio" placeholder="municipio">
                                    <label for="municipio">Municipio de nacimiento</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="telefono" placeholder="telefono">
                                    <label for="telefono">Teléfono</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="correo" placeholder="correo">
                                    <label for="correo">Correo electrónico</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="direccion" placeholder="direccion">
                                    <label for="direccion">Dirección</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="cuenta" placeholder="cuenta">
                                    <label for="cuenta">Cuenta bancaria</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="profesion" placeholder="profesion">
                                    <label for="profesion">Profesión u oficio</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
	                                    <select class=" form-control" name="genero" id="genero">
								            <option value="" hidden="" selected="hidden">Seleccionar Opcion</option>
								            <option value=""></option>
								            <option value="Masculino">Masculino</option>
								            <option value="Femenino">Femenino</option>
							            </select> 
							            <label for="genero">Genero</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-floating">
	                                    <select class=" form-control" name="estado_civil" id="estado_civil">
								            <option value="" hidden="" selected="hidden">Seleccionar Opcion</option>
								            <option value=""></option>
								            <option value="Casado">Casado(a)</option>
								            <option value="Soltero">Soltero(a)</option>
							            </select> 
							            <label for="estado_civil">Estado Civil</label>
                                </div>
                            </div>                           
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="camisa" placeholder="camisa">
                                    <label for="camisa">Talla de camisa</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="calzado" placeholder="calzado">
                                    <label for="calzado">Talla de calzado</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="pantalon" placeholder="pantalon">
                                    <label for="pantalon">Talla de pantalón</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="sangre" placeholder="sangre">
                                    <label for="sangre">Tipo de sangre</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="vacuna" placeholder="vacuna">
                                    <label for="vacuna">Vacunas</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="covid" placeholder="covid">
                                    <label for="covid">Covid</label>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formTrabajadores" id="registrar" class="btn btn-success">registrar</button>
                    <button type="submit" form="formTrabajadores" id="modificar" class="btn btn-primary">modificar</button>
                </div>
            </div>
        </div>
    </div>



    <script src="assets/js/trabajadores.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>