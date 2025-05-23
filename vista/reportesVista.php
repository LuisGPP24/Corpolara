<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>

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
                                <div class="container-fluid text-center me-auto mb-2">
                                    <h2 class="card-title">Planilla de Atención</h2>
                                </div>

                            </div>

                            <div class="container-fluid">

                                <form id="formReportes" action="" method="POST">

                                    <div class="row mb-3">

                                        <div class="row mb-6 justify-content-center">

                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <div class="form-floating">
                                                        <select class="selectpicker form-control" name="categoria" id="categoria">
                                                            <option selected disabled value="">Seleccione una categoria</option>
                                                            <option value="farmacia">Farmacia</option>
                                                            <option value="estudios">Estudios Medicos</option>
                                                            <option value="funeraria">Funeraria</option>
                                                        </select>
                                                        <label for="categoria">Categoria</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <select class="selectpicker form-control" name="trabajador" id="trabajador" name="trabajador">
                                                        <option selected disabled value="">Seleccione un trabajador</option>

                                                    </select>
                                                    <label for="trabajador">Trabajador</label>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-floating">
                                                    <div class="form-floating">
                                                        <select class="selectpicker form-control" name="solicitante" id="solicitante">
                                                            <option selected disabled value="">Seleccione un solicitante</option>

                                                        </select>
                                                        <label for="solicitante">Solicitante</label>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>

                                        <div class="row">
                                            <div class="col-md-12 text-center mb-3">

                                            </div>
                                        </div>

                                        <!-- <div class="row mb-2 justify-content-center">
                                            <div class="row mb-2 justify-content-center">
                                                <button type="button" id="generarReporte" class="btn btn-danger w-50">generar</button>
                                            </div>
                                        </div> -->
                                        <div class="row mb-2 justify-content-center">
                                            <div class="row mb-2 justify-content-center">
                                                <button type="button" id="consultar" class="btn btn-danger w-50">Consultar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>


                            <div class="container-fluid" id="resultado">
                                <div class="row mb-2 justify-content-center">
                                    <div class="col-md-12 text-center mb-3">
                                        <h4>Resultados</h4>
                                    </div>
                                </div>
                                <div class="row mb-2 justify-content-center">
                                    <div class="col-md-12 text-center mb-3">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover" id="tablaResultadosSolicitudes">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>Opciones</th>
                                                        <th>ID</th>
                                                        <th>Codigo del registro</th>
                                                        <th>N° del registro</th>
                                                        <th>nombre del trabajador</th>
                                                        <th>cedula trabajador</th>
                                                        <th>nombre del solicitante</th>
                                                        <th>cedula del solicitante</th>
                                                        <th>Descripción de la Solicitud</th>
                                                        <th>Fecha de Registro</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbodyResultadosSolicitudes">
                                                    <!-- Aquí se llenarán los resultados de las solicitudes -->

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
            </main>
        </div>
    </div>



    <script src="assets/js/reportes.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>