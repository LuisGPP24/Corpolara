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
                                                            <?= $trabajadores['trabajadores_activos'] ?>
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
                                                            <?= $trabajadores['trabajadores_jubilados'] ?>
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
                                                            <?= $solicitudes ?>
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
                                                                    <?= $monto_aprobado ?>
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
                                                TIPOS DE ESTADOS DE SOLICITUDES
                                            </div>
                                            <div class="card-body">
                                                <div with="100%" height="100%" class="text-center">
                                                    <span id="info_solicitudes"></span>
                                                    <canvas id="solicitudes"></canvas>
                                                </div>
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
    <script src="assets/js/librerias/chart.js"></script>

    <script>
        $(document).ready(function() {


            const estatus = <?= $solicitudes_por_status ?>;
            
            if (estatus.length !== 0) {
                const label = 'Solicitudes por Estatus';
                crearGraficaPastel('solicitudes', label, estatus);
            } else {
                document.getElementById('info_solicitudes').innerHTML = '<p class="text-center">No hay datos para mostrar</p>';
            }

        });

        function crearGraficaPastel(etiqueta, label, info) {
            const colors = [
                "#FF6384",
                "#36A2EB",
                "#FFCE56",
                "#4BC0C0",
                "#9966FF",
                "#FF9F40",
                "#E7E9ED",
                "#8E44AD",
                "#3498DB",
                "#1ABC9C",
                "#F39C12",
                "#D35400",
            ];
            const data = {
                labels: info.map(item => item.estatus),
                datasets: [{
                    label: label,
                    data: info.map(item => item.cantidad),
                    backgroundColor: colors.map(color => color),
                    hoverOffset: 20
                }]
            };
            const config = {
                type: 'pie',
                data: data,
            };


            new Chart(document.getElementById(etiqueta), config);

        }
    </script>


</body>

</html>