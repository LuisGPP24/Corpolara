<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bitacora</title>

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
                                    <h2 class="card-title">Bitácora de Usuarios</h2>
                                </div>
                                <div class="col-auto">

                                    <button class="btn btn-danger" data-bs-toggle="modal" id='btn_vaciar' >
                                        <i class="bi bi-trash"></i> Vaciar
                                    </button>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="tablaBitacora" class="table table-hover table-striped mt-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Nombre</th>
                                            <th>Módulo</th>
                                            <th>Fecha de Registro</th>
                                            <th>Hora de registro</th>
                                            <th>Acción realizada</th>
                                        </tr>
                                    </thead>
                                   
                                        <?php foreach ($consultas as $consulta) : ?>
                                            <tr>
                                                <td><?= $consulta["cedula"] ?></td>
                                                <td><?= $consulta["nombre_usuario"] ?></td>
                                                <td><?= $consulta["nombre_modulo"] ?></td>
                                                <td><?= $consulta["fecha_registro"] ?></td>
                                                <td><?= $consulta["hora_registro"] ?></td>
                                                <td><?= $consulta["accion"] ?></td>
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

    <script src="assets/js/bitacora.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>