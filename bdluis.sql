-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-02-2025 a las 18:37:56
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `antecedentes`
--

INSERT INTO `antecedentes` (`id`, `id_trabajadores`, `ant_cardiovasculares`, `ant_pulmonares`, `ant_digestivos`, `ant_diabetes`, `ant_renales`, `alergias`, `otros`, `tratamiento`, `especificacion_tratamiento`, `int_quirurjico`, `fecha_intervencion`, `edad_intervencion`, `descripcion_intervencion`, `accidentes`, `fecha_accidente`, `edad_accidente`, `descripcion_accidente`, `ant_tabaquismo`, `ant_alcoholismo`) VALUES
(6, 1, 'No', 'No', 'No', 'No', 'No', 'Ninguna', 'No', 'Ninguno', 'Ninguno', 'Nunca', '2025-01-13', '10 años', 'nada', 'ninguno', '2025-01-13', '20 años', 'nada', 'ninguno', 'ninguno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` int(11) NOT NULL,
  `cedula_usuario` varchar(15) NOT NULL,
  `id_modulos` int(11) NOT NULL,
  `accion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `fecha_registro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `expedientes`
--

INSERT INTO `expedientes` (`id`, `id_trabajadores`, `fecha_registro`) VALUES
(11, 1, '2025-02-10'),
(12, 4, '2025-02-10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `id_solicitudes` int(11) NOT NULL,
  `numero_factura` varchar(12) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `monto` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `id_solicitudes`, `numero_factura`, `descripcion`, `monto`) VALUES
(2, 12, '0001', 'Ciplofloxacina', '300,00');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `codigo_insumo`, `nombre_insumo`, `cantidad`, `fecha_caducidad`) VALUES
(1, '0001-O-2025', 'Omeprazol 500mg', '20', '2025-01-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `nombre`) VALUES
(1, 'Gestionar de Trabajadores'),
(2, 'Gestionar Antecedentes'),
(3, 'Gestionar Carga Familiar'),
(4, 'Gestionar Expedientes'),
(5, 'Gestionar Solicitudes'),
(6, 'Gestionar Farmacia'),
(7, 'Gestionar Estudios Médicos'),
(8, 'Gestionar Funeraria'),
(9, 'Ficha de personal'),
(10, 'Planillas de Solicitudes'),
(11, 'Reportes Estadísticos'),
(12, 'Gestionar Facturas'),
(13, 'Gestionar Consultas Médicas'),
(14, 'Gestionar Consultas Pediátricas'),
(15, 'Gestionar Salida de Insumos'),
(16, 'Inventario'),
(17, 'Usuarios'),
(18, 'Permisos'),
(19, 'Bitácora'),
(20, 'Manual de usuario');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `morbilidad_pediatrica`
--

INSERT INTO `morbilidad_pediatrica` (`id`, `id_trabajadores`, `fecha_consulta`, `nombre_paciente`, `cedula_paciente`, `fecha_nacimiento`, `genero`, `telefono`, `doctor`, `observacion`) VALUES
(11, 1, '2025-01-07', 'Génesis Gúzman', '30591237', '2025-01-07', 'femenino', '04141392278', 'Pediatria', 'Nada que ver');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_modulos` int(11) NOT NULL,
  `acceso` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `id_rol`, `id_modulos`, `acceso`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL COMMENT 'nombre del rol',
  `descripcion` varchar(250) NOT NULL COMMENT 'descripcion del papel que cumple el rol en el sistema'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Super Usuario', 'Acceso a todo el sistema');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `salida_insumos`
--

CREATE TABLE `salida_insumos` (
  `id` int(11) NOT NULL,
  `id_trabajadores` int(11) NOT NULL,
  `id_inventario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `cantidad` int(20) NOT NULL,
  `entregado_por` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `salida_insumos`
--

INSERT INTO `salida_insumos` (`id`, `id_trabajadores`, `id_inventario`, `fecha`, `cantidad`, `entregado_por`) VALUES
(2, 1, 1, '2025-02-11', 20, 'Raymar Rodríguez');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `id_trabajadores`, `codigo_registro`, `numero_registro`, `cedula_solicitante`, `nombre_solicitante`, `telefono_solicitante`, `tipo_solicitud`, `sub_tipo_solicitud`, `estado_solicitud`, `descripcion_solicitud`, `financiado`, `remitido`, `monto`, `monto_aprobado`, `fecha_registro`, `condicion`, `estatus`, `observacion`) VALUES
(6, 1, '0004', '0004', '20922600', 'Diego Alejandro', '04161221526', 'estudios', 'ninguna', 'jubilado', 'ninguna', 'corpolara', 'nadie', '600,00', '600,00', '2024-12-18', 'beneficiario', 'aprobado', 'ninguna'),
(7, 1, '001', '0002', '30591237', 'Luis Perdomo', '04141392278', 'consultas', 'ninguna', 'activo', 'ninguna', 'corpolara', 'nadie', '600,00', '600,00', '2025-01-13', 'beneficiario', 'negado', 'nada'),
(8, 1, '0005', '0001', '30591237', 'Luis Perdomo', '04141392278', 'farmacia', 'ninguna', 'activo', 'ninguna', 'corpolara', 'nadie', '600,00', '600,00', '2025-01-13', 'titular', 'en_proceso', 'nada'),
(10, 1, '0007', '0007', '30591237', 'Luis Perdomo', '04141392278', 'funeraria', 'ninguna', 'activo', 'ninguna', 'corpolara', 'nadie', '600,00', '600,00', '2025-01-13', 'titular', 'anulado', 'ninguna'),
(11, 1, '0008', '0008', '30591237', 'Luis Perdomo', '04141392278', 'estudios', 'ninguna', 'activo', 'ninguna', 'corpolara', 'nadie', '600,00', '600,00', '2025-01-13', 'titular', 'aprobado', 'ninguna'),
(12, 1, '0009', '0009', '30591237', 'Luis Perdomo', '04141392278', 'reembolso', 'ninguna', 'activo', 'Ciplofloxacina', 'corpolara', 'nadie', '600,00', '600,00', '2025-02-10', 'titular', 'aprobado', 'ninguna');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `contrasena` text NOT NULL,
  `correo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `cedula`, `id_rol`, `nombre`, `contrasena`, `correo`) VALUES
(1, '30591237', 1, 'Luis Gustavo Perdomo', '$2y$12$KatNCVerHyJ4Yh8m5JPu4eZJZjsUSLLGV/amOrRnLkADSdB5y1I6G', 'luis@gmail.com'),
(3, '29831184', 1, 'Diego Aguilar', '$2y$12$u790W0TIjEsleBEFftTEW.v8r0D12LgZSbjZgaBTgimUKVle42g6q', 'diego@gmail.com'),
(5, '30591244', 1, 'Diego Alejandro', '$2y$12$efMoz5Uc.r5hC4PRoxxf2.95GqF5ApzsmPX.teP7uUFFv0WW5Eb..', 'diegoAAA@gmail.com');

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
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cedula` (`cedula_usuario`),
  ADD KEY `id_modulos` (`id_modulos`);

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
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_solicitudes` (`id_solicitudes`);

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
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
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
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_modulos` (`id_modulos`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `salida_insumos`
--
ALTER TABLE `salida_insumos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_inventario` (`id_inventario`),
  ADD KEY `fk_trabajadores` (`id_trabajadores`);

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
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `antecedentes`
--
ALTER TABLE `antecedentes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estudios_medicos`
--
ALTER TABLE `estudios_medicos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `expedientes`
--
ALTER TABLE `expedientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `salida_insumos`
--
ALTER TABLE `salida_insumos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `antecedentes`
--
ALTER TABLE `antecedentes`
  ADD CONSTRAINT `antecedentes_ibfk_1` FOREIGN KEY (`id_trabajadores`) REFERENCES `trabajadores` (`id`);

--
-- Filtros para la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD CONSTRAINT `fk_cedula` FOREIGN KEY (`cedula_usuario`) REFERENCES `usuarios` (`cedula`),
  ADD CONSTRAINT `fk_id_modulo` FOREIGN KEY (`id_modulos`) REFERENCES `modulos` (`id`);

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
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `fk_solicitudes` FOREIGN KEY (`id_solicitudes`) REFERENCES `solicitudes` (`id`);

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
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `fk_id_modulos` FOREIGN KEY (`id_modulos`) REFERENCES `modulos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `salida_insumos`
--
ALTER TABLE `salida_insumos`
  ADD CONSTRAINT `fk_inventario` FOREIGN KEY (`id_inventario`) REFERENCES `inventario` (`id`),
  ADD CONSTRAINT `fk_trabajadores` FOREIGN KEY (`id_trabajadores`) REFERENCES `trabajadores` (`id`);

--
-- Filtros para la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD CONSTRAINT `solicitudes_ibfk_1` FOREIGN KEY (`id_trabajadores`) REFERENCES `trabajadores` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
