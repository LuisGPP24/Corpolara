-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-01-2025 a las 18:30:10
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdluis`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `antecedentes`
--

CREATE TABLE `antecedentes` (
  `id` int(100) NOT NULL,
  `id_trabajadores` int(100) NOT NULL,
  `ant_cardiovasculares` varchar(50) NOT NULL,
  `ant_pulmonares` varchar(50) NOT NULL,
  `ant_digestivos` varchar(50) NOT NULL,
  `ant_diabetes` varchar(50) NOT NULL,
  `ant_renales` varchar(50) NOT NULL,
  `alergias` varchar(50) NOT NULL,
  `otros` varchar(100) NOT NULL,
  `tratamiento` varchar(150) NOT NULL,
  `especificacion_tratamiento` varchar(150) NOT NULL,
  `int_quirurjico` varchar(50) NOT NULL,
  `fecha_intervencion` date NOT NULL,
  `edad_intervencion` varchar(50) NOT NULL,
  `descripcion_intervencion` varchar(150) NOT NULL,
  `accidentes` varchar(50) NOT NULL,
  `fecha_accidente` date NOT NULL,
  `edad_accidente` varchar(50) NOT NULL,
  `descripcion_accidente` varchar(150) NOT NULL,
  `ant_tabaquismo` varchar(50) NOT NULL,
  `ant_alcoholismo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `antecedentes`
--

INSERT INTO `antecedentes` (`id`, `id_trabajadores`, `ant_cardiovasculares`, `ant_pulmonares`, `ant_digestivos`, `ant_diabetes`, `ant_renales`, `alergias`, `otros`, `tratamiento`, `especificacion_tratamiento`, `int_quirurjico`, `fecha_intervencion`, `edad_intervencion`, `descripcion_intervencion`, `accidentes`, `fecha_accidente`, `edad_accidente`, `descripcion_accidente`, `ant_tabaquismo`, `ant_alcoholismo`) VALUES
(6, 1, 'No', 'No', 'No', 'No', 'No', 'Ninguna', 'No', 'Ninguno', 'Ninguno', 'Nunca', '2025-01-13', '10 años', 'nada', 'ninguno', '2025-01-13', '20 años', 'nada', 'ninguno', 'ninguno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudios_medicos`
--

CREATE TABLE `estudios_medicos` (
  `id` int(11) NOT NULL,
  `id_solicitudes` int(11) NOT NULL,
  `ente` varchar(11) NOT NULL,
  `descripcion_solicitud` varchar(300) NOT NULL,
  `patologia` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estudios_medicos`
--

INSERT INTO `estudios_medicos` (`id`, `id_solicitudes`, `ente`, `descripcion_solicitud`, `patologia`) VALUES
(1, 6, 'CORPOLARA', 'Estudios medicos', 'Estudios medicos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expedientes`
--

CREATE TABLE `expedientes` (
  `id` int(11) NOT NULL,
  `id_trabajadores` int(11) NOT NULL,
  `fecha_registro` int(11) NOT NULL,
  `nombre_foto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familiares`
--

CREATE TABLE `familiares` (
  `id` int(11) NOT NULL,
  `id_trabajadores` int(11) NOT NULL,
  `movimiento` text NOT NULL,
  `nacionalidad` varchar(50) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `parentesco` varchar(50) NOT NULL,
  `genero` varchar(20) NOT NULL,
  `cuenta` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `fecha_ingreso` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `familiares`
--

INSERT INTO `familiares` (`id`, `id_trabajadores`, `movimiento`, `nacionalidad`, `cedula`, `fecha_nacimiento`, `nombre`, `parentesco`, `genero`, `cuenta`, `correo`, `fecha_ingreso`) VALUES
(15, 1, 'baja', 'Venezolana', '30591238', '2024-12-11', 'Luis Gustavo Perdomo', 'hermano', 'masculino', '111111111111112', 'luis@gmail.com', '2024-12-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `farmacia`
--

CREATE TABLE `farmacia` (
  `id` int(11) NOT NULL,
  `id_solicitudes` int(11) NOT NULL,
  `ente` varchar(11) NOT NULL,
  `descripcion_solicitud` varchar(300) NOT NULL,
  `patologia` varchar(300) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `parentesco` varchar(50) NOT NULL,
  `proveedor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `farmacia`
--

INSERT INTO `farmacia` (`id`, `id_solicitudes`, `ente`, `descripcion_solicitud`, `patologia`, `fecha_nacimiento`, `parentesco`, `proveedor`) VALUES
(2, 8, '', 'Diarrea crónica, tos y dolor de garganta', 'Diarrea de todo tipo', '2025-01-13', 'hijo', 'nueva fe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `funeraria`
--

CREATE TABLE `funeraria` (
  `id` int(11) NOT NULL,
  `id_solicitudes` int(11) NOT NULL,
  `ente` varchar(11) NOT NULL,
  `defuncion_paciente` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `funeraria`
--

INSERT INTO `funeraria` (`id`, `id_solicitudes`, `ente`, `defuncion_paciente`) VALUES
(2, 10, 'CORPOLARA', 'ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `codigo_insumo` varchar(50) NOT NULL,
  `nombre_insumo` varchar(50) NOT NULL,
  `cantidad` varchar(20) NOT NULL,
  `fecha_caducidad` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `codigo_insumo`, `nombre_insumo`, `cantidad`, `fecha_caducidad`) VALUES
(1, '0001-O-2025', 'Omeprazol 500mg', '8', '2025-01-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `morbilidad`
--

CREATE TABLE `morbilidad` (
  `id` int(11) NOT NULL,
  `id_trabajadores` int(11) NOT NULL,
  `fecha_consulta` date NOT NULL,
  `nombre_paciente` varchar(100) NOT NULL,
  `cedula` int(10) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `edad_paciente` int(5) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `gerencia` varchar(30) NOT NULL,
  `telefono` varchar(25) NOT NULL,
  `motivo` varchar(200) NOT NULL,
  `especialidad` varchar(20) NOT NULL,
  `parentesco` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `morbilidad`
--

INSERT INTO `morbilidad` (`id`, `id_trabajadores`, `fecha_consulta`, `nombre_paciente`, `cedula`, `genero`, `edad_paciente`, `direccion`, `gerencia`, `telefono`, `motivo`, `especialidad`, `parentesco`) VALUES
(9, 1, '2024-12-26', 'Naudy Peña', 27816338, 'masculino', 24, 'trinitarias', 'talento humano', '04141392278', 'Desconocida', 'Psicologia', 'hijo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `morbilidad_pediatrica`
--

CREATE TABLE `morbilidad_pediatrica` (
  `id` int(11) NOT NULL,
  `id_trabajadores` int(11) NOT NULL,
  `fecha_consulta` date NOT NULL,
  `nombre_paciente` varchar(80) NOT NULL,
  `cedula_paciente` varchar(30) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `genero` varchar(10) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `doctor` varchar(20) NOT NULL,
  `observacion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `morbilidad_pediatrica`
--

INSERT INTO `morbilidad_pediatrica` (`id`, `id_trabajadores`, `fecha_consulta`, `nombre_paciente`, `cedula_paciente`, `fecha_nacimiento`, `genero`, `telefono`, `doctor`, `observacion`) VALUES
(11, 1, '2025-01-07', 'Génesis Gúzman', '30591237', '2025-01-07', 'femenino', '04141392278', 'Pediatria', 'Nada que reportar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int(11) NOT NULL,
  `id_trabajadores` int(11) NOT NULL,
  `codigo_registro` varchar(20) NOT NULL,
  `numero_registro` varchar(20) NOT NULL,
  `cedula_solicitante` varchar(10) NOT NULL,
  `nombre_solicitante` varchar(50) NOT NULL,
  `telefono_solicitante` varchar(20) NOT NULL,
  `tipo_solicitud` varchar(50) DEFAULT NULL,
  `sub_tipo_solicitud` varchar(30) NOT NULL,
  `estado_solicitud` varchar(20) NOT NULL,
  `descripcion_solicitud` varchar(100) NOT NULL,
  `financiado` varchar(30) NOT NULL,
  `remitido` varchar(30) NOT NULL,
  `monto` varchar(20) NOT NULL,
  `monto_aprobado` varchar(20) NOT NULL,
  `fecha_registro` date NOT NULL,
  `condicion` varchar(30) NOT NULL,
  `estatus` varchar(20) NOT NULL,
  `observacion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `id_trabajadores`, `codigo_registro`, `numero_registro`, `cedula_solicitante`, `nombre_solicitante`, `telefono_solicitante`, `tipo_solicitud`, `sub_tipo_solicitud`, `estado_solicitud`, `descripcion_solicitud`, `financiado`, `remitido`, `monto`, `monto_aprobado`, `fecha_registro`, `condicion`, `estatus`, `observacion`) VALUES
(6, 1, '0004', '0004', '20922600', 'Diego Alejandro', '04161221526', 'estudios', 'ninguna', 'jubilado', 'ninguna', 'corpolara', 'nadie', '600,00', '600,00', '2024-12-18', 'beneficiario', 'aprobado', 'ninguna'),
(7, 1, '001', '0002', '30591237', 'Luis Perdomo', '04141392278', 'consultas', 'ninguna', 'activo', 'ninguna', 'corpolara', 'nadie', '600,00', '600,00', '2025-01-13', 'beneficiario', 'negado', 'nada'),
(8, 1, '0005', '0001', '30591237', 'Luis Perdomo', '04141392278', 'farmacia', 'ninguna', 'activo', 'ninguna', 'corpolara', 'nadie', '600,00', '600,00', '2025-01-13', 'titular', 'en_proceso', 'nada'),
(10, 1, '0007', '0007', '30591237', 'Luis Perdomo', '04141392278', 'funeraria', 'ninguna', 'activo', 'ninguna', 'corpolara', 'nadie', '600,00', '600,00', '2025-01-13', 'titular', 'anulado', 'ninguna'),
(11, 1, '0008', '0008', '30591237', 'Luis Perdomo', '04141392278', 'estudios', 'ninguna', 'activo', 'ninguna', 'corpolara', 'nadie', '600,00', '600,00', '2025-01-13', 'titular', 'aprobado', 'ninguna');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `id` int(11) NOT NULL,
  `fecha_registro` date NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `personal_contratado` varchar(30) NOT NULL,
  `cedula` varchar(20) NOT NULL,
  `unidad_organizativa` varchar(30) NOT NULL,
  `fecha` date NOT NULL,
  `pais` varchar(30) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `municipio` varchar(30) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `cuenta` varchar(30) NOT NULL,
  `profesion` varchar(30) NOT NULL,
  `genero` varchar(30) NOT NULL,
  `talla_camisa` varchar(20) NOT NULL,
  `talla_calzado` varchar(20) NOT NULL,
  `talla_pantalon` varchar(20) NOT NULL,
  `tipo_sangre` varchar(20) NOT NULL,
  `vacunas` varchar(20) NOT NULL,
  `covid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`id`, `fecha_registro`, `nombre`, `personal_contratado`, `cedula`, `unidad_organizativa`, `fecha`, `pais`, `estado`, `municipio`, `telefono`, `correo`, `direccion`, `cuenta`, `profesion`, `genero`, `talla_camisa`, `talla_calzado`, `talla_pantalon`, `tipo_sangre`, `vacunas`, `covid`) VALUES
(1, '2024-09-05', 'Cirez Barriga', 'activo', '29831184', 'Talento Humano', '2024-10-03', 'Caracas', 'MG', 'la ime', '3121286800', 'Diego@gmail.com', 'Rua Inexistente, 2000', '0909009', 'njnjnjn dfefe', 'Masculino', '23', '87', 'm', 'o', 'jjjn', 'no'),
(4, '2025-01-13', 'Ana Cecilia Pérez Perdomo', 'activo', '7417445', 'coordinación de administración', '2025-01-13', 'venezuela', 'lara', 'iribarren', '04141392278', 'aa@aaa.com', 'el trigal cabudare', '111111111111111', 'Contador público', 'Femenino', '23', '87', 'm', 'aaa', 'aaa', 'aaa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `cedula` varchar(12) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `contrasena` text NOT NULL,
  `correo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `cedula`, `nombre`, `contrasena`, `correo`) VALUES
(1, '29831184', 'Diego Aguilar', '$2y$12$5/1gevweacTxrXSlA.SIU.182dNYTsO6T8HVo9RHKxo51rmhSZlAq', 'diego@gmail.com'),
(2, '30591237', 'Luis Perdomo', '$2y$12$yz0o41YKAf6bVU4Ebs26YefKW9MAPbl2fnJfPaGfs4uL3aEup.SGS', 'lustavoguis@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `antecedentes`
--
ALTER TABLE `antecedentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_trabajadores` (`id_trabajadores`);

--
-- Indices de la tabla `estudios_medicos`
--
ALTER TABLE `estudios_medicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitudes` (`id_solicitudes`);

--
-- Indices de la tabla `expedientes`
--
ALTER TABLE `expedientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_trabajadores` (`id_trabajadores`);

--
-- Indices de la tabla `familiares`
--
ALTER TABLE `familiares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trabajadores` (`id_trabajadores`);

--
-- Indices de la tabla `farmacia`
--
ALTER TABLE `farmacia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitudes` (`id_solicitudes`);

--
-- Indices de la tabla `funeraria`
--
ALTER TABLE `funeraria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitudes` (`id_solicitudes`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `morbilidad`
--
ALTER TABLE `morbilidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_trabajadores` (`id_trabajadores`);

--
-- Indices de la tabla `morbilidad_pediatrica`
--
ALTER TABLE `morbilidad_pediatrica`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_trabajadores` (`id_trabajadores`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_trabajadores` (`id_trabajadores`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `antecedentes`
--
ALTER TABLE `antecedentes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estudios_medicos`
--
ALTER TABLE `estudios_medicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `expedientes`
--
ALTER TABLE `expedientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `familiares`
--
ALTER TABLE `familiares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `farmacia`
--
ALTER TABLE `farmacia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `funeraria`
--
ALTER TABLE `funeraria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `morbilidad`
--
ALTER TABLE `morbilidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `morbilidad_pediatrica`
--
ALTER TABLE `morbilidad_pediatrica`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `antecedentes`
--
ALTER TABLE `antecedentes`
  ADD CONSTRAINT `antecedentes_ibfk_1` FOREIGN KEY (`id_trabajadores`) REFERENCES `trabajadores` (`id`);

--
-- Filtros para la tabla `estudios_medicos`
--
ALTER TABLE `estudios_medicos`
  ADD CONSTRAINT `estudios_medicos_ibfk_1` FOREIGN KEY (`id_solicitudes`) REFERENCES `solicitudes` (`id`);

--
-- Filtros para la tabla `expedientes`
--
ALTER TABLE `expedientes`
  ADD CONSTRAINT `expedientes_ibfk_1` FOREIGN KEY (`id_trabajadores`) REFERENCES `trabajadores` (`id`);

--
-- Filtros para la tabla `familiares`
--
ALTER TABLE `familiares`
  ADD CONSTRAINT `familiares_ibfk_1` FOREIGN KEY (`id_trabajadores`) REFERENCES `trabajadores` (`id`);

--
-- Filtros para la tabla `farmacia`
--
ALTER TABLE `farmacia`
  ADD CONSTRAINT `farmacia_ibfk_1` FOREIGN KEY (`id_solicitudes`) REFERENCES `solicitudes` (`id`);

--
-- Filtros para la tabla `funeraria`
--
ALTER TABLE `funeraria`
  ADD CONSTRAINT `funeraria_ibfk_1` FOREIGN KEY (`id_solicitudes`) REFERENCES `solicitudes` (`id`);

--
-- Filtros para la tabla `morbilidad`
--
ALTER TABLE `morbilidad`
  ADD CONSTRAINT `morbilidad_ibfk_1` FOREIGN KEY (`id_trabajadores`) REFERENCES `trabajadores` (`id`);

--
-- Filtros para la tabla `morbilidad_pediatrica`
--
ALTER TABLE `morbilidad_pediatrica`
  ADD CONSTRAINT `morbilidad_pediatrica_ibfk_1` FOREIGN KEY (`id_trabajadores`) REFERENCES `trabajadores` (`id`);

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`id_trabajadores`) REFERENCES `trabajadores` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
