-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-12-2025 a las 05:50:42
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_cafeteria`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_login_usuario` (IN `p_usuario` VARCHAR(50))   BEGIN
    SELECT 
        id_usuario,
        usuario,
        password,
        rol,
        idioma
    FROM usuarios
    WHERE usuario = p_usuario;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `es_nombre` varchar(150) NOT NULL,
  `en_nombre` varchar(150) NOT NULL,
  `es_descripcion` text NOT NULL,
  `en_descripcion` text NOT NULL,
  `es_caracteristicas_tecnicas` text DEFAULT NULL,
  `en_caracteristicas_tecnicas` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `categoria` enum('destacado','regular','promocion') DEFAULT 'regular',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `es_nombre`, `en_nombre`, `es_descripcion`, `en_descripcion`, `es_caracteristicas_tecnicas`, `en_caracteristicas_tecnicas`, `precio`, `imagen`, `categoria`, `fecha_creacion`) VALUES
(1, 'Cápsulas de Café Descafeinado – Intenso', 'Decaffeinated Coffee Capsules – Intense', 'Café descafeinado de carácter intenso, elaborado mediante un tueste oscuro que realza un cuerpo robusto y un perfil sensorial profundo. Ofrece un final suave y persistente, libre de amargor, manteniendo la intensidad del espresso sin contenido de cafeína. Compatible con la mayoría de las máquinas de cápsulas del mercado.', 'Intense decaffeinated coffee produced with a dark roast that enhances a bold body and deep sensory profile. Delivers a smooth and persistent finish without bitterness, preserving espresso intensity with no caffeine content. Compatible with most capsule coffee machines on the market.', 'Tipo: Café descafeinado en cápsulas. Perfil de tueste: Oscuro. Intensidad: Alta. Cuerpo: Robusto. Acidez: Baja. Amargor: Controlado. Uso recomendado: Espresso. Compatibilidad: Máquinas de cápsulas estándar. Contenido de cafeína: ≤0.1%.', 'Type: Decaffeinated coffee capsules. Roast profile: Dark. Intensity: High. Body: Bold. Acidity: Low. Bitterness: Controlled. Recommended use: Espresso. Compatibility: Standard capsule machines. Caffeine content: ≤0.1%.', 6.50, 'descafeinando_intenso.jpeg', 'regular', '2025-12-17 00:53:36'),
(2, 'Cápsulas de Café Descafeinado - Lungo Suave', 'Decaffeinated Coffee Capsules - Smooth Lungo', 'Cápsulas descafeinadas diseñadas para café largo, con un tueste medio que preserva los matices aromáticos del grano. Ofrece una taza suave, equilibrada y prolongada, ideal para momentos de relajación sin cafeína. Compatibles con máquinas Nespresso originales.', 'Decaffeinated capsules designed for long coffee, featuring a medium roast that preserves aromatic nuances. Delivers a smooth, balanced and extended cup, ideal for relaxation without caffeine. Compatible with Nespresso Original machines.', 'Tipo: Cápsulas de café descafeinado. Tueste: Medio. Perfil: Suave y equilibrado. Preparación: Lungo. Compatibilidad: Nespresso Original Line. Contenido de cafeína: ≤0.1%.', 'Type: Decaffeinated coffee capsules. Roast: Medium. Profile: Smooth and balanced. Preparation: Lungo. Compatibility: Nespresso Original Line. Caffeine content: ≤0.1%.', 6.25, 'Lungo_Suave.jpeg', 'regular', '2025-12-17 01:18:44'),
(5, 'Café Molido Descafeinado Natural - Tueste Medio', 'Naturally Decaffeinated Ground Coffee - Medium Roast', 'Café molido descafeinado mediante procesos naturales que conservan el sabor original. Presenta un tueste medio que equilibra cuerpo, acidez baja y notas aromáticas a nuez y chocolate suave.', 'Naturally decaffeinated ground coffee preserving original flavor. Medium roast offering balanced body, low acidity and aromatic notes of nuts and mild chocolate.', 'Tipo: Café molido descafeinado. Proceso: Natural. Tueste: Medio. Acidez: Baja. Uso: Cafetera doméstica. Presentación: Molido.', 'Type: Decaffeinated ground coffee. Process: Natural. Roast: Medium. Acidity: Low. Use: Home coffee makers. Presentation: Ground.', 5.95, 'Tueste_Medio.jpeg', 'regular', '2025-12-17 01:38:30'),
(6, 'Cápsulas de Café Descafeinado - Ligero Intenso', 'Decaffeinated Coffee Capsules - Light Body Intense', 'Cápsulas descafeinadas de carácter intenso, con tueste profundo que desarrolla un cuerpo audaz y un final suave, sin amargor. Diseñadas para espresso contundente sin cafeína.', 'Intense decaffeinated capsules with deep roast, delivering a bold body and smooth finish without bitterness. Designed for strong espresso without caffeine.', 'Tipo: Cápsulas descafeinadas. Tueste: Oscuro. Intensidad: Alta. Uso: Espresso. Compatibilidad: Nespresso Original Line.', 'Type: Decaffeinated capsules. Roast: Dark. Intensity: High. Use: Espresso. Compatibility: Nespresso Original Line.', 6.50, 'descafeinando_ligero.jpeg', 'regular', '2025-12-17 01:38:30'),
(9, 'Té Verde con Flores de Jazmín', 'Green Tea with Jasmine Flowers', 'Infusión de té verde aromatizada naturalmente con flores de jazmín, ofreciendo una bebida fresca, floral y ligeramente dulce, con final limpio y refrescante.', 'Green tea infusion naturally scented with jasmine flowers, delivering a fresh, floral and lightly sweet beverage with a clean finish.', 'Tipo: Té verde aromatizado. Aroma: Floral intenso. Sabor: Fresco y delicado. Cafeína: Moderada. Formatos: 50g, 100g.', 'Type: Aromatized green tea. Aroma: Intense floral. Flavor: Fresh and delicate. Caffeine: Moderate. Formats: 50g, 100g.', 4.50, 'te_verde_jazmin.jpeg', 'regular', '2025-12-17 01:39:22'),
(10, 'Café en Grano - Blend Intenso (Tueste Oscuro)', 'Whole Bean Coffee - Intense Blend (Dark Roast)', 'Blend de granos seleccionados sometidos a tueste oscuro, desarrollando cuerpo achocolatado, notas a caramelo tostado y perfil intenso persistente.', 'Selected bean blend dark roasted to develop chocolate body, toasted caramel notes and long-lasting intensity.', 'Tipo: Café en grano. Blend: Especialidad. Tueste: Oscuro. Uso: Espresso y filtro. Presentación: 250g / 500g.', 'Type: Whole bean coffee. Blend: Specialty. Roast: Dark. Use: Espresso and filter. Packaging: 250g / 500g.', 7.90, 'cafe_en_granos_selecanados.jpeg', 'regular', '2025-12-17 01:39:22'),
(11, 'Cápsulas de Café - Espresso Intenso', 'Coffee Capsules - Intense Espresso', 'Cápsulas diseñadas para espresso robusto, con crema espesa y sabor profundamente tostado, inspiradas en la tradición italiana.', 'Capsules designed for robust espresso with thick crema and deeply roasted flavor, inspired by Italian tradition.', 'Intensidad: Alta (9/10). Notas: Cacao oscuro y especias tostadas. Compatibilidad: Nespresso Original Line. Formato: 10 cápsulas.', 'Intensity: High (9/10). Notes: Dark cocoa and toasted spices. Compatibility: Nespresso Original Line. Format: 10 capsules.', 6.75, 'espresso_intenso.jpeg', 'regular', '2025-12-17 01:39:22'),
(12, 'Café Latte Instantáneo - Cremoso y Espumoso', 'Instant Latte Coffee - Creamy & Foamy', 'Mezcla instantánea de café, leche y azúcar que produce un latte cremoso y equilibrado en segundos, sin necesidad de máquina.', 'Instant blend of coffee, milk and sugar producing a creamy, balanced latte in seconds without a machine.', 'Tipo: Bebida instantánea. Preparación: Agua caliente. Perfil: Cremoso y dulce. Uso: Oficina y hogar.', 'Type: Instant beverage. Preparation: Hot water. Profile: Creamy and sweet. Use: Office and home.', 3.95, 'cafe_latte.jpeg', 'regular', '2025-12-17 01:39:22'),
(13, 'Cappuccino Instantáneo - Con Cacao', 'Instant Cappuccino - With Cocoa', 'Preparación instantánea que combina café aromático, espuma cremosa y cacao, lista en segundos.', 'Instant preparation combining aromatic coffee, creamy foam and cocoa, ready in seconds.', 'Tipo: Cappuccino instantáneo. Perfil: Cremoso y dulce. Preparación: Agua caliente.', 'Type: Instant cappuccino. Profile: Creamy and sweet. Preparation: Hot water.', 4.10, 'cappuccino.jpeg', 'destacado', '2025-12-17 01:39:22'),
(14, 'Mocaccino Instantáneo - Café y Chocolate', 'Instant Mocaccino - Coffee & Chocolate', 'Bebida instantánea que fusiona café intenso con chocolate cremoso, ofreciendo una experiencia indulgente.', 'Instant beverage combining intense coffee with creamy chocolate for an indulgent experience.', 'Tipo: Bebida instantánea. Perfil: Dulce y energético. Preparación: Agua caliente.', 'Type: Instant beverage. Profile: Sweet and energizing. Preparation: Hot water.', 4.20, 'mokaccino.jpeg', 'destacado', '2025-12-17 01:39:22'),
(15, 'Infusión Herbal Relajante - Mezcla de Flores y Hierbas', 'Relaxing Herbal Infusion - Flower & Herb Blend', 'Infusión herbal sin cafeína elaborada con flores y hierbas de propiedades relajantes, ideal para el descanso.', 'Caffeine-free herbal infusion made from relaxing flowers and herbs, ideal for rest and relaxation.', 'Tipo: Infusión herbal. Cafeína: 0%. Aroma: Floral. Uso: Nocturno.', 'Type: Herbal infusion. Caffeine: 0%. Aroma: Floral. Use: Nighttime.', 4.00, 'infusion_herbal_relaxante.jpeg', 'regular', '2025-12-17 01:39:22'),
(16, 'Café en Granos - Tueste Oscuro e Intenso', 'Whole Bean Coffee - Dark & Intense Roast', 'Granos de café cuidadosamente seleccionados y sometidos a un tueste oscuro que potencia su carácter y profundidad. Produce una taza de cuerpo completo, con notas persistentes y un final audaz, ideal para quienes buscan una experiencia cafetera intensa desde el grano.', 'Carefully selected coffee beans roasted dark to enhance character and depth. Produces a full-bodied cup with persistent notes and a bold finish, ideal for those seeking an intense coffee experience from bean to cup.', 'Tipo: Café en grano. Tueste: Oscuro. Intensidad: Alta. Perfil: Robusto y persistente. Uso recomendado: Espresso y métodos de filtrado. Preparación: Moler antes de usar.', 'Type: Whole bean coffee. Roast: Dark. Intensity: High. Profile: Bold and persistent. Recommended use: Espresso and filter methods. Preparation: Grind before use.', 7.50, 'cafe_en_granos_selecanados.jpeg', 'regular', '2025-12-17 01:39:22'),
(17, 'Café Molido Artesanal - Tueste Abierto (Estilo Francés)', 'Artisan Ground Coffee - Light Roast (French Press Style)', 'Café molido artesanalmente con un tueste más abierto y claro, diseñado especialmente para prensa francesa. Permite que las notas aromáticas y frutales se desarrollen lentamente, ofreciendo una taza suave, redonda y equilibrada.', 'Artisanally ground coffee with a lighter, open roast designed specifically for French press brewing. Allows aromatic and fruity notes to develop slowly, delivering a smooth, rounded and balanced cup.', 'Tipo: Café molido artesanal. Tueste: Abierto / Claro. Molienda: Gruesa. Método recomendado: Prensa francesa. Perfil: Aromático y suave.', 'Type: Artisan ground coffee. Roast: Light / Open. Grind size: Coarse. Recommended method: French press. Profile: Aromatic and smooth.', 6.80, 'cafe_molido_artesanal.jpeg', 'destacado', '2025-12-17 01:39:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resenas`
--

CREATE TABLE `resenas` (
  `id_resena` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `contenido` text NOT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `estado` enum('activo','oculto') DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resenas`
--

INSERT INTO `resenas` (`id_resena`, `id_usuario`, `titulo`, `contenido`, `fecha_creacion`, `estado`) VALUES
(1, 8, 'hola', 'jjajaja', '2025-12-16 23:09:51', 'activo'),
(2, 1, 'me gusto', 'me gusto mucho la cafetería le pongo un 10/10', '2025-12-16 23:29:06', 'activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `pais` varchar(50) DEFAULT NULL,
  `idioma` varchar(5) DEFAULT 'es',
  `rol` enum('admin','user') DEFAULT 'user',
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `direccion` varchar(150) DEFAULT NULL,
  `telefono` varchar(30) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` enum('Masculino','Femenino','Otro') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `nombre`, `correo`, `password`, `pais`, `idioma`, `rol`, `fecha_registro`, `direccion`, `telefono`, `fecha_nacimiento`, `genero`) VALUES
(1, 'admin', 'Administrador', 'admin@cafeteria.com', 'a503470e1b04929e91edf953a9e28715eec41a0a07b160d37a1b9415caeb5e29', NULL, 'es', 'admin', '2025-12-14 01:33:44', NULL, NULL, NULL, NULL),
(6, 'saory', 'saory', 'sao@gmail.com', 'f1fa960f932b7f92838c17a11634a230fd41e808af5d66bf57902e62c6427432', 'panama', 'es', 'user', '2025-12-14 06:21:46', NULL, NULL, NULL, NULL),
(8, 'angel', 'angel', 'angel@gmail.com', '9dab69e04e2163623608b5d9f1fa72226a9385a4c6f76f8c53cd1906877de61e', 'panama', 'es', 'user', '2025-12-17 02:20:54', 'pedregal', '63845355', '2025-12-05', 'Femenino');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `resenas`
--
ALTER TABLE `resenas`
  ADD PRIMARY KEY (`id_resena`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `resenas`
--
ALTER TABLE `resenas`
  MODIFY `id_resena` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `resenas`
--
ALTER TABLE `resenas`
  ADD CONSTRAINT `resenas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
