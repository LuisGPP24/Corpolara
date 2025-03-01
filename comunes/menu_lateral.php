<?php
$accesos = array_column($_SESSION["permisos"], "acceso", "id_modulos");

$modulos_registro = [1, 2, 3, 4];
$modulos_solicitudes = [5, 6, 7, 8];
$modulos_seguridad = [17, 18, 19];

$acceso_registros = array_reduce($modulos_registro, function ($acumulador, $id) use ($accesos) {
    return $acumulador && !empty($accesos[$id]) && $accesos[$id] == 1;
}, true);

$acceso_solicitudes = array_reduce($modulos_solicitudes, function ($acumulador, $id) use ($accesos) {
    return $acumulador && !empty($accesos[$id]) && $accesos[$id] == 1;
}, true);

$acceso_seguridad = array_reduce($modulos_seguridad, function ($acumulador, $id) use ($accesos) {
    return $acumulador && !empty($accesos[$id]) && $accesos[$id] == 1;
}, true);
?>


<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading">Modulos de la APS</div>
            <a class="nav-link" href="?pagina=home">

                Principal
            </a>

            <!--  -->
            <?php if ($acceso_registros): ?>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseRegistro" aria-expanded="false" aria-controls="collapseRegistro">

                    Registros
                    <div class="sb-sidenav-collapse-arrow">
                        <i class="bi bi-chevron-down"></i>
                    </div>
                </a>

                <?php if (!empty($accesos[1]) && $accesos[1] == 1): ?>
                    <div class="collapse" id="collapseRegistro" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="?pagina=trabajadores">Trabajadores</a>
                        </nav>
                    </div>
                <?php endif; ?>
                <?php if (!empty($accesos[2]) && $accesos[2] == 1): ?>
                    <div class="collapse" id="collapseRegistro" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="?pagina=antecedentes">Antecedentes</a>
                        </nav>
                    </div>
                <?php endif; ?>
                <?php if (!empty($accesos[3]) && $accesos[3] == 1): ?>
                    <div class="collapse" id="collapseRegistro" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="?pagina=cargaFamiliar">Carga familiar</a>
                        </nav>
                    </div>
                <?php endif; ?>
                <?php if (!empty($accesos[4]) && $accesos[4] == 1): ?>
                    <div class="collapse" id="collapseRegistro" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="?pagina=expedientes">Expedientes</a>
                        </nav>
                    </div>
                <?php endif; ?>
            <?php endif; ?>


            <!--  -->
            <?php if ($acceso_solicitudes): ?>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseSolicitudes" aria-expanded="false" aria-controls="collapseSolicitudes">

                    Solicitudes
                    <div class="sb-sidenav-collapse-arrow">
                        <i class="bi bi-chevron-down"></i>
                    </div>
                </a>

                <div class="collapse" id="collapseSolicitudes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="?pagina=solicitudes">Registro de solicitudes</a>

                    </nav>
                </div>

                <div class="collapse" id="collapseSolicitudes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="?pagina=farmacia">Farmacia</a>

                    </nav>
                </div>

                <div class="collapse" id="collapseSolicitudes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="?pagina=estudios">Estudios médicos</a>

                    </nav>
                </div>

                <div class="collapse" id="collapseSolicitudes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="?pagina=funeraria">Funeraria</a>

                    </nav>
                </div>
            <?php endif; ?>

            <!--  -->
            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseReportes" aria-expanded="false" aria-controls="collapseReportes">

                Reportes
                <div class="sb-sidenav-collapse-arrow">
                    <i class="bi bi-chevron-down"></i>
                </div>
            </a>

            <div class="collapse" id="collapseReportes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="?pagina=reportes">Planilla de atención</a>

                </nav>
            </div>

            <div class="collapse" id="collapseReportes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="?pagina=fichaPersonal">Ficha de Personal</a>

                </nav>
            </div>

            <div class="collapse" id="collapseReportes" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="?pagina=reportesEstadisticos">Reportes Estadísticos</a>

                </nav>
            </div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseFacturas" aria-expanded="false" aria-controls="collapseFacturas">

                Facturas
                <div class="sb-sidenav-collapse-arrow">
                    <i class="bi bi-chevron-down"></i>
                </div>
            </a>

            <div class="collapse" id="collapseFacturas" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="?pagina=facturas">Registro de Facturas</a>
                </nav>
            </div>

            <!--  -->
            <div class="sb-sidenav-menu-heading">Servicios Médicos</div>

            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseServiciosMedicos" aria-expanded="false" aria-controls="collapseServiciosMedicos">

                Servicios Medicos
                <div class="sb-sidenav-collapse-arrow">
                    <i class="bi bi-chevron-down"></i>
                </div>
            </a>

            <div class="collapse" id="collapseServiciosMedicos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="?pagina=consultasMedicas">Registro de consultas medicas</a>
                </nav>
            </div>

            <div class="collapse" id="collapseServiciosMedicos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="?pagina=consultasPediatricas">Registro de consultas pediátricas</a>
                </nav>
            </div>

            <div class="collapse" id="collapseServiciosMedicos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="?pagina=salidaInsumos">Registro de salida de insumos</a>
                </nav>
            </div>

            <div class="collapse" id="collapseServiciosMedicos" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="?pagina=inventario">Inventario</a>
                </nav>
            </div>


            <?php if ($acceso_seguridad): ?>
                <div class="sb-sidenav-menu-heading">Seguridad</div>
                <?php if (!empty($accesos[17]) && $accesos[17] == 1): ?>
                    <a class="nav-link" href="?pagina=usuarios">

                        Usuarios
                    </a>
                <?php endif; ?>
                <?php if (!empty($accesos[18]) && $accesos[18] == 1): ?>
                    <a class="nav-link" href="?pagina=permisos">

                        Permisos
                    </a>
                <?php endif; ?>
                
                <a class="nav-link" href="?pagina=bitacora">
                    
                    Bitacora
                </a>
            <?php endif; ?>

            <!--  -->
            <div class="sb-sidenav-menu-heading">Info</div>

            <a class="nav-link" href="?pagina=manual">

                Manual de Usuario
            </a>

        </div>
    </div>
    <div class="sb-sidenav-footer">

    </div>
</nav>