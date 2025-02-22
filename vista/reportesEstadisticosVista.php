<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes Estadisticos</title>

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
                            <div class="container-fluid">

                                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                                    <h1 class="h3 mb-0 text-gray-800">
                                    	Resportes Estadísticos de la Atención Primaria de Salud
                                    </h1>
                                </div>

                                <div class="row">

                                <!-- div de trabajadores -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs text-primary text-uppercase mb-1">
                                                        Trabajadores Activos registrados
                                                    </div>
                                                    <div class="h5 mb-0 text-gray-800">
                                                        117
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pending Requests Card Example -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-warning shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs text-warning text-uppercase mb-1">
                                                        Trabajadores Jubilados registrados
                                                    </div>
                                                    <div class="h5 mb-0 text-gray-800">
                                                        97
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- div de solicitudes -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-success shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs text-success text-uppercase mb-1">
                                                        Número de Solicitudes Registradas
                                                    </div>
                                                    <div class="h5 mb-0 text-gray-800">
                                            	        1,000
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- div de gastos -->
                                <div class="col-xl-3 col-md-6 mb-4">
                                    <div class="card border-left-info shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs text-info text-uppercase mb-1">
                                                    	Cantidad de Bs. Aprobados en Solicitudes
                                                    </div>
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col-auto">
                                                            <div class="h5 mb-0 mr-3 text-gray-800">
                                                            	1.000.000,00
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>                        
                            </div>

                            <div class="row">

                                <div class="col-lg-6">                          
                                    <div class="card shadow mb-4">
                                        <div class="card-header text-xs text-danger text-uppercase mb-1">
                                            ACÁ VA LA GRÁFICA DE LOS TIPOS DE ESTADOS DE SOLICITUDES
                                        </div>
                                        <div class="card-body">
                                            GRÁFICA
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="card shadow mb-4">
                                        <div class="card-header text-xs text-danger text-uppercase mb-1">
                                            ACÁ VA LA GRÁFICA DE LOS TIPOS DE ESTADOS DE SOLICITUDES
                                        </div>
                                        <div class="card-body">
                                            GRÁFICA
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

<script src="assets/js/reportesEstadisticos.js"></script>
<script src="assets/js/scripts.js"></script>

</body>

</html>