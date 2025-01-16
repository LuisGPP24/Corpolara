<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario</title>

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
                                  <h2 class="card-title">Gestión de Insumos de Servicios Médicos</h2>
                              </div>                                
                          </div>

                          <div class="col-auto me-auto mb-2">
                            <h5 class="card-title">Registro de insumos</h5>
                        </div>


                        <form id="formInventario" action="" method="POST">

                            <div class="row mb-3">                        
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="codigo" placeholder="codigo">
                                        <label for="codigo">Código</label>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="insumo" placeholder="insumo">
                                        <label for="insumo">Isumo médico</label>
                                    </div>
                                </div>                            
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="cantidad" placeholder="cantidad">
                                        <label for="cantidad">Cantidad</label>
                                    </div>
                                </div>                            
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="caducidad" placeholder="caducidad">
                                        <label for="caducidad">Fecha de caducidad</label>
                                    </div>
                                </div>
                            </div>                        
                        </form>

                        <div class="row my-3 justify-content-center">
                            <div class="col-md-3 my-3">
                                <button type="button" class="btn btn-success" id="registrar_insumo" name="registrar_insumo">Registrar</button>
                            </div>
                        </div>             

                        <hr>

                        <div class="modal-content">

                            <div>
                                <h5 class="card-title">Listado de Insumos</h5>
                            </div>

                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Código</th>
                                        <th>Insumo</th>
                                        <th>Cantidad</th>
                                        <th>Fecha de caducidad</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>CD-001-2024</td>
                                        <td>Pastillas</td>
                                        <td>5</td>
                                        <td>24-05-2024</td>
                                        <td><div class='btn-group' role='group' aria-label='optiones buttons'>
                                            <button onclick="modalModificar(this)" id="btn-modificar" class="btn btn-primary"><i class="bi bi-pencil-square"></i></button><button onclick="eliminar(this)" id="btn_eliminar" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>CD-002-2024</td>
                                        <td>Tabletas</td>
                                        <td>4</td>
                                        <td>24-05-2024</td>
                                        <td><div class='btn-group' role='group' aria-label='optiones buttons'>
                                            <button onclick="modalModificar(this)" id="btn-modificar" class="btn btn-primary"><i class="bi bi-pencil-square"></i></button><button onclick="eliminar(this)" id="btn_eliminar" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>CD-001-2024</td>
                                        <td>Vitamina C</td>
                                        <td>3</td>
                                        <td>24-05-2024</td>
                                        <td><div class='btn-group' role='group' aria-label='optiones buttons'><button onclick="modalModificar(this)" id="btn-modificar" class="btn btn-primary"><i class="bi bi-pencil-square"></i></button><button onclick="eliminar(this)" id="btn_eliminar" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button></div>
                                        </td>                                        
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>CD-001-2024</td>
                                        <td>Vitamina C</td>
                                        <td>3</td>
                                        <td>24-05-2024</td>
                                        <td><div class='btn-group' role='group' aria-label='optiones buttons'><button onclick="modalModificar(this)" id="btn-modificar" class="btn btn-primary"><i class="bi bi-pencil-square"></i></button><button onclick="eliminar(this)" id="btn_eliminar" class="btn btn-danger"><i class="bi bi-trash-fill"></i></button></div>
                                        </td>                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </main>
            </div>

        </div>

    <!--<script src="assets/js/trabajadores.js"></script>
        <script src="assets/js/scripts.js"></script>-->

    </body>

    </html>