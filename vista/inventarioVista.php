<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina de Inventario</title>

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
                                    <h2 class="card-title">Inventario de insumos - Servicios Médicos</h2>
                                </div>
                                <div class="col-auto">

                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalInventario" id='btn_registrar'>
                                        Registrar
                                    </button>

                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="tablaInventario" class="table table-hover table-striped mt-3" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Codigo</th>
                                            <th>Isumo médico</th>
                                            <th>Cantidad</th>
                                            <th>Fecha de caducidad</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                   
                                        <?php foreach ($consultas as $consulta) : ?>
                                            <tr>
                                                <td><?= $consulta["id"] ?></td>
                                                <td><?= $consulta["codigo_insumo"] ?></td>
                                                <td><?= $consulta["nombre_insumo"] ?></td>
                                                <td><?= $consulta["cantidad"] ?></td>
                                                <td><?= $consulta["fecha_caducidad"] ?></td>
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
    <div class="modal fade" id="modalInventario" tabindex="-1" aria-labelledby="modalInventarioLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalInventarioLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="formInventario" action="" method="POST">

                        <input type="text" class="d-none" id="id" placeholder="id">

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="codigo" placeholder="codigo">
                                    <label for="codigo">Codigo del Insumo</label>
                                </div>
                            </div>
                            <div class="col-md-6"> 
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="insumo" placeholder="insumo">
                                    <label for="insumo">Nombre del Insumo</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="cantidad" placeholder="cantidad">
                                        <label for="cantidad">Cantidad</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" class="form-control" id="fecha" placeholder="fecha">
                                    <label for="fecha">Fecha de caducidad</label>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" form="formInventario" id="registrar" class="btn btn-success">registrar</button>
                    <button type="submit" form="formInventario" id="modificar" class="btn btn-primary">modificar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/inventario.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>

</html>