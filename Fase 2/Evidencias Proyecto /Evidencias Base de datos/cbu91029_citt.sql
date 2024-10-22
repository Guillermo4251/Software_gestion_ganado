-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 22-10-2024 a las 15:41:07
-- Versión del servidor: 10.6.17-MariaDB-cll-lve
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cbu91029_citt`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animales_trabajo`
--

CREATE TABLE `animales_trabajo` (
  `id_animal` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `foto` longblob DEFAULT NULL,
  `fecha` date NOT NULL,
  `tipo` varchar(15) NOT NULL,
  `subtipo` varchar(15) NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `tipo_foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


--
-- Estructura de tabla para la tabla `control_sanitario`
--

CREATE TABLE `control_sanitario` (
  `id_control` int(11) NOT NULL,
  `id_animal` varchar(15) NOT NULL,
  `fecha` date NOT NULL,
  `medicamento` varchar(15) NOT NULL,
  `dosis` varchar(15) NOT NULL,
  `periodo_carencia` varchar(15) NOT NULL,
  `observacion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_sanitario_lote`
--

CREATE TABLE `control_sanitario_lote` (
  `id_control` int(11) NOT NULL,
  `id_animal` varchar(15) NOT NULL,
  `fecha` date NOT NULL,
  `medicamento` varchar(15) NOT NULL,
  `dosis` varchar(15) NOT NULL,
  `periodo_carencia` varchar(15) NOT NULL,
  `observacion` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destete`
--

CREATE TABLE `destete` (
  `id_destete` int(11) NOT NULL,
  `id_madre` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `n_cerdos` int(11) NOT NULL,
  `peso_promedio` float NOT NULL,
  `dias_al_destete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equinos`
--

CREATE TABLE `equinos` (
  `id_equino` int(11) NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `fecha` date NOT NULL,
  `especie` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha_clinica`
--

CREATE TABLE `ficha_clinica` (
  `id_ficha` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `diagnostico` varchar(300) NOT NULL,
  `tratamiento` varchar(300) NOT NULL,
  `resultado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


--
-- Estructura de tabla para la tabla `ficha_clinica_animal_trabajo`
--

CREATE TABLE `ficha_clinica_animal_trabajo` (
  `id_ficha` int(11) NOT NULL,
  `id_animal` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `diagnostico` varchar(300) NOT NULL,
  `tratamiento` varchar(300) NOT NULL,
  `resultado` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Estructura de tabla para la tabla `ficha_clinica_lotes`
--

CREATE TABLE `ficha_clinica_lotes` (
  `id_ficha` int(11) NOT NULL,
  `id_lote` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `diagnostico` varchar(200) NOT NULL,
  `tratamiento` varchar(200) NOT NULL,
  `resultado` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ganado`
--

CREATE TABLE `ganado` (
  `ID_animal` int(11) NOT NULL,
  `numero_crotal` varchar(15) DEFAULT NULL,
  `diio` int(20) DEFAULT NULL,
  `foto` longblob NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `peso` int(11) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `tipo_animal` varchar(30) NOT NULL,
  `categoria` varchar(40) NOT NULL,
  `ID_madre` varchar(15) DEFAULT NULL,
  `ID_padre` varchar(15) DEFAULT NULL,
  `tipo_foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


--
-- Estructura de tabla para la tabla `inseminacion_bovina`
--

CREATE TABLE `inseminacion_bovina` (
  `id_inseminacion` int(11) NOT NULL,
  `id_animal` varchar(15) NOT NULL,
  `fecha` date NOT NULL,
  `padre` varchar(15) NOT NULL,
  `est_parto` date NOT NULL,
  `observaciones` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inseminacion_ovina`
--

CREATE TABLE `inseminacion_ovina` (
  `id_inseminacion` int(11) NOT NULL,
  `id_animal` varchar(15) NOT NULL,
  `fecha` date NOT NULL,
  `padre` varchar(15) NOT NULL,
  `est_parto` date NOT NULL,
  `observaciones` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `id_lote` int(11) NOT NULL,
  `numero_lote` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  `especie` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


--
-- Estructura de tabla para la tabla `monta_porcino`
--

CREATE TABLE `monta_porcino` (
  `id_monta` int(11) NOT NULL,
  `id_cerdo` varchar(15) NOT NULL,
  `fecha` date NOT NULL,
  `raza_verraco` varchar(30) NOT NULL,
  `est_parto` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `monta_porcino`
--

--
-- Estructura de tabla para la tabla `mortalidad_lote`
--

CREATE TABLE `mortalidad_lote` (
  `id_mortalidad` int(11) NOT NULL,
  `lote` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parto_bovino`
--

CREATE TABLE `parto_bovino` (
  `ID_parto` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `madre` varchar(15) DEFAULT NULL,
  `padre` varchar(15) NOT NULL,
  `sexo_cria` varchar(20) DEFAULT NULL,
  `observaciones` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parto_ovino`
--

CREATE TABLE `parto_ovino` (
  `id_parto` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `madre` varchar(15) NOT NULL,
  `padre` varchar(15) NOT NULL,
  `sexo_cria` varchar(15) NOT NULL,
  `observaciones` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parto_porcino`
--

CREATE TABLE `parto_porcino` (
  `id_parto` int(11) NOT NULL,
  `id_cerdo` varchar(15) NOT NULL,
  `fecha` date NOT NULL,
  `lechones_vivos` int(11) NOT NULL,
  `lechones_muertos` int(11) NOT NULL,
  `peso_promedio` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


--
-- Estructura de tabla para la tabla `registro_vacuna`
--

CREATE TABLE `registro_vacuna` (
  `id_vacuna` int(20) NOT NULL,
  `id_animal` varchar(15) NOT NULL,
  `fecha` date NOT NULL,
  `vacuna` varchar(40) NOT NULL,
  `proxima` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


--
-- Estructura de tabla para la tabla `registro_vacuna_animal_trabajo`
--

CREATE TABLE `registro_vacuna_animal_trabajo` (
  `id_vacuna` int(20) NOT NULL,
  `id_animal` varchar(15) NOT NULL,
  `fecha` date NOT NULL,
  `vacuna` varchar(40) NOT NULL,
  `proxima` date DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `registro_vacuna_animal_trabajo`
--


CREATE TABLE `usuario` (
  `ID_usuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `contrasenna` varchar(30) NOT NULL,
  `tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `animales_trabajo`
--
ALTER TABLE `animales_trabajo`
  ADD PRIMARY KEY (`id_animal`);

--
-- Indices de la tabla `control_sanitario`
--
ALTER TABLE `control_sanitario`
  ADD PRIMARY KEY (`id_control`);

--
-- Indices de la tabla `control_sanitario_lote`
--
ALTER TABLE `control_sanitario_lote`
  ADD PRIMARY KEY (`id_control`);

--
-- Indices de la tabla `destete`
--
ALTER TABLE `destete`
  ADD PRIMARY KEY (`id_destete`);

--
-- Indices de la tabla `equinos`
--
ALTER TABLE `equinos`
  ADD PRIMARY KEY (`id_equino`);

--
-- Indices de la tabla `ficha_clinica`
--
ALTER TABLE `ficha_clinica`
  ADD PRIMARY KEY (`id_ficha`);

--
-- Indices de la tabla `ficha_clinica_animal_trabajo`
--
ALTER TABLE `ficha_clinica_animal_trabajo`
  ADD PRIMARY KEY (`id_ficha`);

--
-- Indices de la tabla `ficha_clinica_lotes`
--
ALTER TABLE `ficha_clinica_lotes`
  ADD PRIMARY KEY (`id_ficha`);

--
-- Indices de la tabla `ganado`
--
ALTER TABLE `ganado`
  ADD PRIMARY KEY (`ID_animal`);

--
-- Indices de la tabla `inseminacion_bovina`
--
ALTER TABLE `inseminacion_bovina`
  ADD PRIMARY KEY (`id_inseminacion`);

--
-- Indices de la tabla `inseminacion_ovina`
--
ALTER TABLE `inseminacion_ovina`
  ADD PRIMARY KEY (`id_inseminacion`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id_lote`);

--
-- Indices de la tabla `monta_porcino`
--
ALTER TABLE `monta_porcino`
  ADD PRIMARY KEY (`id_monta`);

--
-- Indices de la tabla `mortalidad_lote`
--
ALTER TABLE `mortalidad_lote`
  ADD PRIMARY KEY (`id_mortalidad`);

--
-- Indices de la tabla `parto_bovino`
--
ALTER TABLE `parto_bovino`
  ADD PRIMARY KEY (`ID_parto`);

--
-- Indices de la tabla `parto_ovino`
--
ALTER TABLE `parto_ovino`
  ADD PRIMARY KEY (`id_parto`);

--
-- Indices de la tabla `parto_porcino`
--
ALTER TABLE `parto_porcino`
  ADD PRIMARY KEY (`id_parto`);

--
-- Indices de la tabla `registro_vacuna`
--
ALTER TABLE `registro_vacuna`
  ADD PRIMARY KEY (`id_vacuna`);

--
-- Indices de la tabla `registro_vacuna_animal_trabajo`
--
ALTER TABLE `registro_vacuna_animal_trabajo`
  ADD PRIMARY KEY (`id_vacuna`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`ID_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `animales_trabajo`
--
ALTER TABLE `animales_trabajo`
  MODIFY `id_animal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `control_sanitario`
--
ALTER TABLE `control_sanitario`
  MODIFY `id_control` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `control_sanitario_lote`
--
ALTER TABLE `control_sanitario_lote`
  MODIFY `id_control` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `destete`
--
ALTER TABLE `destete`
  MODIFY `id_destete` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `equinos`
--
ALTER TABLE `equinos`
  MODIFY `id_equino` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ficha_clinica`
--
ALTER TABLE `ficha_clinica`
  MODIFY `id_ficha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `ficha_clinica_animal_trabajo`
--
ALTER TABLE `ficha_clinica_animal_trabajo`
  MODIFY `id_ficha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ficha_clinica_lotes`
--
ALTER TABLE `ficha_clinica_lotes`
  MODIFY `id_ficha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ganado`
--
ALTER TABLE `ganado`
  MODIFY `ID_animal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `inseminacion_bovina`
--
ALTER TABLE `inseminacion_bovina`
  MODIFY `id_inseminacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `inseminacion_ovina`
--
ALTER TABLE `inseminacion_ovina`
  MODIFY `id_inseminacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `id_lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `monta_porcino`
--
ALTER TABLE `monta_porcino`
  MODIFY `id_monta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `mortalidad_lote`
--
ALTER TABLE `mortalidad_lote`
  MODIFY `id_mortalidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `parto_bovino`
--
ALTER TABLE `parto_bovino`
  MODIFY `ID_parto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `parto_ovino`
--
ALTER TABLE `parto_ovino`
  MODIFY `id_parto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `parto_porcino`
--
ALTER TABLE `parto_porcino`
  MODIFY `id_parto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `registro_vacuna`
--
ALTER TABLE `registro_vacuna`
  MODIFY `id_vacuna` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `registro_vacuna_animal_trabajo`
--
ALTER TABLE `registro_vacuna_animal_trabajo`
  MODIFY `id_vacuna` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `ID_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
