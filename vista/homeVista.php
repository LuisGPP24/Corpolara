	<!DOCTYPE html>
	<html lang="es">

	<head>
	    <meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>Inicio</title>

	    <?php require_once('comunes/head.php') ?>

	</head>

	<body class="sb-nav-fixed">
	    <!-- menu arriba -->
	    <?php require_once("comunes/menu.php"); ?>
	    <!-- contenedor de menu lateral y main -->
	    <div id="layoutSidenav">
	        <!-- menu lateral -->
	        <div id="layoutSidenav_nav">
	            <?php require_once("comunes/menu_lateral.php");?>
	        </div>
	        <!-- contenido de la pagina -->
	         <div id="layoutSidenav_content">
	            <main class="bg-color-gray">
	                <!-- Aqui va todo el contenido -->
	                <div class="container-fluid px-3">

	                	<div class="card shadow-sm rounded mt-3">
	                        <div class="card-body">

	                            <div class="h3 font-italic text-center">
									¡Bienvenido! <?php if (!empty($_SESSION['nombre'])) {
										echo $_SESSION['nombre'];
									}?>

									<div> <br> </div>
								
									<div>
										<img src="assets/img/imagen.jpg" style="width:225px">
										<img src="assets/img/MPPP.jpg">
                                        <img src="assets/img/corpolara.jpg">
                                        <img src="assets/img/bandera.jpg" style="width:225px" alt="Bandera de Venezuela">
                                     </div>

								</div>

	                           <div class="mt-3">
									
									<div class="card-body">
										<div class="h5">
											Visión de CORPOLARA.
										</div>
										
										<div class="mt-3">
											<p class="font-weight-normal text-justify">
												"Ser la organización pública nacional impulsora del desarrollo socialista en los estados Lara, Yaracuy y Portuguesa; promotora de la organización popular para la construcción del buen vivir de los ciudadanos y ciudadanas de la Región, basado en principios humanistas y sustentando en condiciones morales y éticas de progreso social".
											</p>
										</div>

										<div class="h5">
											Misión de CORPOLARA.
										</div>
		
										<div class="mt-3">
											<p class="font-weight-normal text-justify">
												"Somos la organización del Ejecutivo Nacional responsable del Desarrollo Integral, Armónico, Ordenado y Sustentable de la Región Centro Occidental de la República Bolivariana de Venezuela; desarrollamos y usamos tecnologías avanzadas en materia de organización y gestión pública, para contribuir en la solución de problemas de planificación, organización, administración de recursos, ejecución de planes, proyectos y pogramas, evaluación y control de la gestión, mediante serviccios de: diseño e implementación de políticas públicas nacionales; financiamiento, subsidios, subvenciones e incentivos; realización de estudios e investigaciones; asistencia técnica especializada; ejecución de infraestructura y promoción de fundaciones, asociaciones y sociedades. Buscamos la más alta productividad, eficacia política y calidad revolucionaria en la construcción del estado social de justicia y derecho".
											</p>
										</div>
		
										<div class="h5">
											Valores de CORPOLARA.
										</div>
		
										<div class="accordion accordion-flush" id="accordionFlushExample">
	                             
	                                        <div class="accordion-item">

	                                                <h2 class="accordion-header">
	                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
	                                                    Ver Valores
	                                                    </button>
	                                                </h2>

	                                                <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">

		                                                    <div class="accordion-body">
	                                                        - Socialismo.
		                                                    </div>

		                                                    <div class="accordion-body">
	                                                        - Respeto por la persona humana y el ambiente.
		                                                    </div>

		                                                    <div class="accordion-body">
	                                                        - Participación ciudadana.
		                                                    </div>

		                                                    <div class="accordion-body">
	                                                        - Vocación de servicio.
		                                                    </div>

		                                                    <div class="accordion-body">
	                                                        - Compromiso y responsabilidad social.
		                                                    </div>

		                                                    <div class="accordion-body">
	                                                        - Transparencia (Ética y Honestidad).
		                                                    </div>

		                                                    <div class="accordion-body">
	                                                        - Integridad.
		                                                    </div>

		                                                    <div class="accordion-body">
	                                                        - Sostenibilidad y sustentabilidad.
		                                                    </div>

		                                                    <div class="accordion-body">
	                                                        - Trabajo en equipo.
		                                                    </div>

		                                                    <div class="accordion-body">
	                                                        - Respuesta oportuna.
		                                                    </div>
	                                                </div>
	                                        </div>
	  
	                                    </div>
	                                    </div>
		
									</div>
								</div>
	                        </div>
	                    </div>
	                </div>
	            </main>
	        </div>

	    <script src="assets/js/home.js"></script>
	    <script src="assets/js/scripts.js"></script>

	</body>

	</html>