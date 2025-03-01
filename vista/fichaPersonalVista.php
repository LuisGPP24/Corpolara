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
                                    <h2 class="card-title">Ficha de Personal</h2>
                                </div>

                            </div>

                            <div class="container-fluid">

                                <form id="formReportes" action="" method="POST">

                                    <div class="row mb-3">

                                    <div class="row mb-2 justify-content-center">

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <select class="selectpicker form-control" name="trabajador" id="trabajador" name="trabajador">
                                                    <option value=""></option>
                                                    <option value="1">diego</option>
                                                    <option value="2">jose</option>
                                                    <option value="3">jose</option>
                                                    <option value="4">jose</option>
                                                    <option value="5">jose</option>
                                                </select>
                                                <label for="trabajador">trabajador</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating">
                                                <div class="form-floating">
                                                    <input type="text" name="solicitante" id="solicitante" class="form-control">
                                                    <label for="solicitante">solicitante</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 text-center mb-3">
                                
                                        </div>
                                    </div>

                                    <div class="row mb-2 justify-content-center">
                                        <div class="row mb-2 justify-content-center">
                                            <button type="button" id="generarReporte" class="btn btn-danger w-50">generar</button>
                                        </div>                                        
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>                 
                </div>
            </main>
        </div>
    </div>



    <script src="assets/js/fichaPersonal.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>