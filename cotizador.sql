-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-10-2018 a las 22:04:04
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cotizador`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ayb`
--

CREATE TABLE `ayb` (
  `id` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `lugar` varchar(150) NOT NULL,
  `hora` time NOT NULL,
  `menu` longtext NOT NULL,
  `notas` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ayb`
--

INSERT INTO `ayb` (`id`, `id_departamento`, `id_servicio`, `lugar`, `hora`, `menu`, `notas`) VALUES
(1, 2, 1399, 'Restaurant Calandria', '13:00:00', 'menu comida ', '{\"notas\":[{\"nota\":\"nota ayb comida 1\"},{\"nota\":\"nota ayb comida 2\"}]}'),
(2, 2, 1400, 'Restaurant Morillos', '20:35:00', 'menu cena', '{\"notas\":[{\"nota\":\"nota ayb cena 1\"},{\"nota\":\"nota ayb cena 2\"}]}'),
(3, 2, 1401, 'Salon Sauces', '09:00:00', 'menu coffe', '{\"notas\":[{\"nota\":\"nota ayb coffe 1\"},{\"nota\":\"nota ayb coffe 2\"}]}'),
(4, 2, 1402, 'Salon Pinos', '09:30:00', 'renta de salon sin coffe', '{\"notas\":[{\"nota\":\"nota ayb renta de salon 1\"},{\"nota\":\"nota ayb renta de salon 2\"}]}'),
(5, 2, 1403, 'Bar Gato Montes', '09:40:00', 'menu desayuno', '{\"notas\":[{\"nota\":\"nota ayb desayuno 1\"},{\"nota\":\"nota ayb desayuno 2\"}]}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizaciones`
--

CREATE TABLE `cotizaciones` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `empresa` varchar(150) NOT NULL,
  `estado` varchar(150) NOT NULL,
  `municipio` varchar(150) NOT NULL,
  `correo` varchar(75) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `coordinador` varchar(150) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `hospedaje` longtext,
  `noches` int(11) DEFAULT NULL,
  `dias` int(11) NOT NULL,
  `total_rooms` int(11) DEFAULT NULL,
  `huespedes` int(11) DEFAULT NULL,
  `monto` decimal(11,2) NOT NULL,
  `token` longtext NOT NULL,
  `orden` varchar(250) DEFAULT NULL,
  `file` varchar(150) DEFAULT NULL,
  `clave` varchar(150) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `vencimiento` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `state` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cotizaciones`
--

INSERT INTO `cotizaciones` (`id`, `id_usuario`, `empresa`, `estado`, `municipio`, `correo`, `telefono`, `coordinador`, `fecha_entrada`, `fecha_salida`, `hospedaje`, `noches`, `dias`, `total_rooms`, `huespedes`, `monto`, `token`, `orden`, `file`, `clave`, `tipo`, `vencimiento`, `created_at`, `updated_at`, `state`) VALUES
(1, 2, 'Deltronix', 'Coahuila', 'Saltillo', 'facturcion@deltronix.com.mx', '8444881030', 'Mara Monsivais', '2018-07-05', '2018-07-06', '{\"habitacion sencilla\":{\"cantidad\":\"1\",\"tarifa\":\"1092.00\"},\"habitacion cuadruple\":{\"cantidad\":\"6\",\"tarifa\":\"1681.00\"}}', 1, 2, 7, 25, '35087.00', '667b6e2b9cb382f0ce6ccaee81b66c3157ceb12ae46161abd7070194cf91df9ba5399e5409ef1b140b45d26d851d92dce68bea4cb88b41de6d118b23df46f49e71d7a408cf6e8bf46533c834e38c81a69e9487490b7ff4dc63881d8f347cbd34db2778f45e31aa08ccff2a22f3f1b1fa0197f23fa930722198120c18411a56e6', NULL, NULL, 'CG_5b718ed833079', 'Complete', '2018-09-12 08:59:52', '2018-08-13 08:59:52', '2018-08-13 08:59:52', 3),
(2, 2, 'John Deere', 'Coahuila', 'Ramos Arizpe', 'guillencarolinaelizabeth@johndeere.com', '8441069727', 'Carolina Guillen', '2018-08-20', '2018-08-22', '{\"habitacion sencilla\":{\"cantidad\":\"22\",\"tarifa\":\"1092.00\"}}', 2, 3, 22, 22, '100981.00', '68eefb5d8a54cb913e512fd6f6f28fae5c31179a0f4de01bb0b202276bb0bfc21d53b4aacd8896745111a2fc589286ffe5aa9e6824a5ce6cb34a6fb6c005c01e859fb927211d61585e3b381856f6a43ef763fb569791812c3fddf7a6f294e95b8f6799df6406fe39c8acb133d187ee72d6cb497381057719c6713c07ebc08319', NULL, NULL, 'CG_5b719f3381178', 'Complete', '2018-09-12 10:09:39', '2018-08-13 10:09:39', '2018-08-13 10:09:39', 3),
(3, 2, 'Reunion De Matrimonios', 'Nuevo León', 'Monterrey', 'rafael@amistaddemonterrey.com', '8184705716', 'Rafael Guerra', '2018-11-09', '2018-11-11', '{\"habitacion doble\":{\"cantidad\":\"35\",\"tarifa\":\"1471.00\"}}', 2, 3, 35, 70, '262950.00', 'f21f3c6e6679091d2c8d4e77d789f222fa839bf8684a941c249748e01d23eac65445046b6f889599586aab162d4646aa7e790ccf4cd72f0f7990d3ec96d684ddb47ee25e225de7cd3ba3888f85d4bb8ce37ea687f6ea75779fc4724a3c0e1a432ad791098dd0e6e9cb20457a5e92b7f66da7e46c5cfcd77f1e23722193f04c3f', NULL, NULL, 'CG_5b719fc940fe4', 'Complete', '2018-09-12 10:12:09', '2018-08-13 10:12:09', '2018-08-13 10:12:09', 3),
(4, 2, 'Grupo Destinos', 'Distrito Federal', 'Benito Juárez', 'ccalalpa@grupodestinos.com.mx', '5553403700', 'Carlos Calalpa', '2018-08-31', '2018-09-01', '{\"habitacion sencilla\":{\"cantidad\":\"15\",\"tarifa\":\"1471.00\"},\"habitacion doble\":{\"cantidad\":\"6\",\"tarifa\":\"1471.00\"}}', 1, 2, 21, 27, '50625.00', 'a639770b6c3abb96dc276d08de235f91c56ebbec56401074d32aafb69bc4196c1e2cc4daf33bef4c99b079dd5ebbb07e0158a4eaa058609ddf7056c27d7c850f292f8d5e9146b8a0c793acffff2d19cbc4ea04fc17e38a4035bcd978de942326ce3a194053abea64a27c84193c0fdd1e0b55e3862e98b7a95a33b1d337164db8', 'orden_c-rm-4_05-09-2018.pdf', NULL, 'CG_5b71a031f12b2', 'Complete', '2018-09-12 10:13:53', '2018-08-13 10:13:53', '2018-09-05 10:26:33', 1),
(5, 2, 'Universidad Autonoma De Saltillo', 'Coahuila', 'Saltillo', 'secretaria.particular@academiaidh.org.mx', '8441037949', 'Andrea Gutierrez', '2018-10-06', '2018-10-06', NULL, NULL, 1, NULL, 250, '98512.00', 'bc1a98cec7dc9313a99323f184f74a80260eed33cb8f7b76480519d87adf73f770d2889e1416d52c5bfb2b4a66c83812e519ea2cc7d7b2cb483ce6b9014053ccb583fd95d27c0cdb1b600299f0ea01de593780deb22d0dae3df26ae2a0c6e1f7d5aa5a6946eaef7c460ce08fd41a8a14485faaca095b4793dfd583cc0ae82981', NULL, NULL, 'CG_5b71a0f32a496', 'Service', '2018-09-14 10:17:07', '2018-08-13 10:17:07', '2018-08-13 10:17:07', 3),
(6, 2, 'Credi-plata', 'Coahuila', 'Monclova', 'etalamantes@crediplata.com', '8666322657', 'Evelyne Talamantes', '2018-09-14', '2018-09-16', '{\"habitacion cuadruple\":{\"cantidad\":\"50\",\"tarifa\":\"2059.00\"}}', 2, 3, 50, 200, '490563.00', 'a308cd2d6379b583a28a34d51d526689342ba272c48c2b8a81621bc4dfc07c9b7c1a84b15822a87ba54799dc8edd83607665bb0b610a212e2b3ae50928126e4e89d50e9c71f7bed49acc46146c08278cc55a412f9dcfb5ee52c3e3e9ba7729bf6881b90aad571d42ad9dad6a30873a22241f45545ae7cf7ec65707aad18649ad', NULL, NULL, 'CG_5b71a1886259c', 'Complete', '2018-09-12 10:19:36', '2018-08-13 10:19:36', '2018-08-13 10:19:36', 3),
(7, 2, 'Oxxo S.a. De C.v.', 'Nuevo León', 'Monterrey', 'andrea.manzo@oxxo.com', '8183892285', 'Andrea Manzo', '2018-09-26', '2018-09-27', '{\"habitacion sencilla\":{\"cantidad\":\"9\",\"tarifa\":\"1092.00\"}}', 1, 2, 9, 9, '24336.00', 'aa11204e9278f41e35de68a8280c362a74e0e6811345f06d118df57cfbcff6d16ad0b68c79659f6d027fad3d7e48659b468c81231a44f3d86e6e39df8109da31bddf27bff3026eb3c01c3e7a0337847a79f89133680f99cfccf1f822e9857fb7c5f2ab8eb52e524dac423f9afd43c04107b7d565cf63c74115005d16500b1d1d', NULL, NULL, 'CG_5b71a2028bb3a', 'Complete', '2018-09-12 10:21:38', '2018-08-13 10:21:38', '2018-08-13 10:21:38', 3),
(8, 2, 'Whirpool', 'Coahuila', 'Saltillo', 'andrea_davila@whirpool.com', '8444270762', 'Andrea Davila', '2018-08-31', '2018-09-02', '{\"habitacion sencilla\":{\"cantidad\":\"12\",\"tarifa\":\"1471.00\"}}', 2, 3, 12, 12, '56403.00', '8dc76f1461fadbcc0994e9680be84f914f47b9226cff3af70fb5136902b5fd7828754786899dcbf492878c91014d6e2e932ef62b8ab51f88d08087558a26f2dcda69ffaf44f97851765dd9379b1c6089b3819f16050f98dac0fa0e651b14ea723a32aafb03f87e196531595174bc6a9123032f6a6055a55f669a1bf8092706e3', NULL, NULL, 'CG_5b71a2d8a54c3', 'Complete', '2018-09-12 10:25:12', '2018-08-13 10:25:12', '2018-08-13 10:25:12', 3),
(9, 2, 'Coppel', 'Distrito Federal', 'Venustiano Carranza', 'evelyn.castillo@coppel.com', '5558041060', 'Evelyn Castillo', '2018-08-21', '2018-08-23', '{\"habitacion sencilla\":{\"cantidad\":\"10\",\"tarifa\":\"1092.00\"}}', 2, 3, 10, 10, '42197.00', '3cbfcf793bd3d14201ef63a6def1a8f597c3a9f5229f3a76b4ca4a4e4d7b207035a87e29a1c428057e88f54ff04192dbc0269f0a0b6c52f5ec93eca557cbb5f7d136a6fe714f6e1daa228fbcba563ded9f7b19b7db9c9bc08845234e20bd0e905de4562d65588334f2a8a7768221c1b19321fac2a17e6ba8984993ae081854bf', NULL, NULL, 'CG_5b71a352c0ef8', 'Complete', '2018-09-12 10:27:14', '2018-08-13 10:27:14', '2018-08-13 10:27:14', 3),
(10, 2, 'Maria Eugenia Manautou', 'Tamaulipas', 'Victoria', 'manautou56@hotmail.com', '8341399456', 'Maria Eugenia Manautou', '2018-11-30', '2018-12-02', '{\"habitacion doble\":{\"cantidad\":\"13\",\"tarifa\":\"1471.00\"},\"habitacion triple\":{\"cantidad\":\"1\",\"tarifa\":\"1765.00\"}}', 2, 3, 14, 29, '69855.00', '063c0b684dc4f90626eab15a534b9192dd3f600703368e2546044304a91ffc7a5bd5f68a934698e18970cd63e95a50330bdc182cdfc0208086e6ba809bf72e133df048bffa76ecc9cb4c0814b1d9f017e844eb5cbf88104dd85dacfae2e0d755dbac514b2eab76699510c27d87279d141b480fd2c2fa9e63b4e5588ab25eb820', NULL, 'Nayeli_C-RM-10.pdf', 'CG_5b71a3e14a794', 'Complete', '2018-09-12 10:29:37', '2018-08-13 10:29:37', '2018-08-14 09:20:39', 3),
(11, 2, 'Calorex', 'Coahuila', 'Saltillo', 'moramireza@hotmail.com', '8444385699', 'Olivia Ramirez', '2018-08-15', '2018-08-16', '{\"habitacion sencilla\":{\"cantidad\":\"9\",\"tarifa\":\"1092.00\"}}', 1, 2, 9, 9, '24907.00', '3c7d3a988c3dd6f70e568aac1cb270c4266173fa84261aa816de5eac90354f259033a1b3c28c316a9952617ab5847a8ad900f7a0cbd02469564b960732aedbb2ea7b3ba9f8ba2c49c11ceee95dae395be51fefc572d6dd6c5c1db9a6be666d58bc5c2d7dd34a02e613e9632745cb825b3d725769de56ef225a75c3fb99c99bb0', NULL, NULL, 'CG_5b71a443ef7cf', 'Complete', '2018-09-12 10:31:15', '2018-08-13 10:31:15', '2018-08-13 10:31:15', 3),
(12, 2, 'Calorex', 'Coahuila', 'Saltillo', 'moramireza@hotmail.com', '8444385699', 'Olivia Ramirez', '2018-08-15', '2018-08-16', '{\"habitacion sencilla\":{\"cantidad\":\"1\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"4\",\"tarifa\":\"1092.00\"}}', 1, 2, 5, 9, '20539.00', '6bab3b7c4e895b7767296fd27b64de0bee334fcc187db1d05aa24276f7e188312ad1b7513af0bcffe2185f5880d782f23e72496a9040efb679052a006fe5f5f0eb0b46b709d99bc9c331121326bfda1421fd2a6c1a0546426871e0a9fdf2ce2e38db5a20ef22386ff0b872605aca93141949b1738631465c4f344bf0cacb2b68', NULL, NULL, 'CG_5b71a443ef7cf', 'Complete', '2018-09-12 10:32:35', '2018-08-13 10:32:35', '2018-08-13 10:32:35', 3),
(13, 1, 'Logrand', 'Nuevo León', 'Monterrey', 'roberto.ontiveros@logrand.com', '8182590276', 'Roberto Ontiveros', '2018-08-16', '2018-08-18', '{\"habitacion sencilla\":{\"cantidad\":\"20\",\"tarifa\":\"1281.50\"},\"habitacion doble\":{\"cantidad\":\"20\",\"tarifa\":\"1281.50\"}}', 2, 3, 40, 60, '214147.00', '0e2e9526900d49d7e6db97618eb28994fe37716db10c3e4c2493aab62d695d58cc434244a2aec299777d0bdf05d2c4a8b68102ddf0869572e464a9a7e75cdc1f296ee51a2e9a038b439f45c0c4cfadd23f3a38370f18e973b9f0303b77c1bab5a7304478265f2dcc2bb2a1a7612fe04c3a75a3d5ca227da539eecb62e7a0a9f8', NULL, NULL, 'CG_5b71e36fb3e7a', 'Complete', '2018-09-12 15:00:47', '2018-08-13 15:00:47', '2018-08-13 15:00:47', 3),
(14, 1, 'Overbooking Mexico', 'Nuevo León', 'Monterrey', 'veronica.rodriguez@obmtravel.com', '8121336300', 'Lic. Veronica Rodriguez', '2018-11-05', '2018-11-07', '{\"habitacion sencilla\":{\"cantidad\":\"16\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"44\",\"tarifa\":\"1092.00\"}}', 2, 3, 60, 104, '323001.00', '58d6d08b22622e27733e120d85e74f93c4db84d0cac142eb17c3203d055f244fc5da12266f9bae8c330c8fb397bf5e87b88b36ea2366f86e7a1b5dde84869fe629ca064bfe55596d2bf284f0edf319cd7be27e207a8db30493b5abee6b058b9a7b1e823068675cf058fa3e8016f879632d813f0c0243a49b011fdc471eb786ea', NULL, NULL, 'CG_5b71e471d3338', 'Complete', '2018-09-12 15:05:05', '2018-08-13 15:05:05', '2018-08-13 15:05:05', 3),
(15, 1, 'Diloe - Qualitas', 'Distrito Federal', 'Benito Juárez', 'vandriano@diloe.com', '5555169856', 'Veronica Andriano', '2018-09-12', '2018-09-15', '{\"habitacion doble\":{\"cantidad\":\"15\",\"tarifa\":\"1218.33\"}}', 3, 4, 15, 30, '117305.00', '163d06af3b3b57b4b150e129f7aec2718c72022829d1ee4d8593262b88c458dea739c4ecbce600e9ae1f46a1dc8ca655e2b4002c54e37bd10539103ddd9b068987d44a034bc74aa5d7c88dea24549787f0b017b5e50de66f093b84f9c4c55b37e714ce7da0d0bbdf13105ee10c4fa073bb632fe0ae5414ab0415d746e652a849', NULL, NULL, 'CG_5b71e53aae17e', 'Complete', '2018-09-12 15:08:26', '2018-08-13 15:08:26', '2018-08-13 15:08:26', 3),
(16, 1, 'Btc - Americanas', 'Distrito Federal', 'Gustavo A. Madero', 'msotelo@btcamericanas.com', '5552005100', 'Miguel Sotel', '2018-09-05', '2018-09-06', '{\"habitacion sencilla\":{\"cantidad\":\"35\",\"tarifa\":\"1092.00\"}}', 1, 2, 35, 35, '84550.00', '28b8446b84331cb34b2d81f34fe236572ca7fdb106937d1b51ccb73305e489f860f483fc195d71f1a0f33f4370fe7abc8e6dd32a2751671ac8a4efc48f06f4074027aa134267e7e3e228db2d2b48d36663c9ada36b003205529cd832f417f39584d31527f380e9440be75a79e59cb01982440f53fb9a0a9d815b0e60a1cdffe5', NULL, NULL, 'CG_5b71e5b38b035', 'Complete', '2018-09-12 15:10:27', '2018-08-13 15:10:27', '2018-08-13 15:10:27', 3),
(17, 1, 'Banorte', 'Nuevo León', 'Monterrey', 'maria.campos.hernandez@banorte.com', '8181739000', 'Maria Del Camen Campos', '2018-08-31', '2018-09-01', '{\"habitacion doble\":{\"cantidad\":\"19\",\"tarifa\":\"1471.00\"}}', 1, 2, 19, 38, '74778.00', '183973e6514b321642df1eacc3fcb3d194780f68410df071f36e0b2bd42eed4b9f36e73a8d6e2c6a7f5c1550223bec374d471572cb4d5529513e3ab0d1caccde0a1a1ac5b60c3fa3f133643c36472782706267d41b622f26447ce7817b8a4b2fc99c0f51f5b61a4d6082c1def119d173553c69c95ca07f95a5c89738afde3ee5', NULL, NULL, 'CG_5b71e6104fdb9', 'Complete', '2018-09-12 15:12:00', '2018-08-13 15:12:00', '2018-08-13 15:12:00', 3),
(18, 1, 'Bexel', 'Nuevo León', 'Monterrey', 'daniela.ramos@bexel.com.mx', '8181300200', 'Daniela Ramos', '2018-08-21', '2018-08-24', '{\"habitacion sencilla\":{\"cantidad\":\"9\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"23\",\"tarifa\":\"1092.00\"}}', 3, 4, 32, 55, '250448.00', '2b2d3a44329903f7b32f8965b2d99ea10bbe9b2a46709ff9b87dfa9a9970dea56fd5acdb92cb4577c71737d8d7f17ee007f7a119f015111d82321cc1f5031f5ccaf79184b42770638eecb5c6f7ee18c201cb438e4ba15dced1c4b094df2c39d066c9713b63d4b9d8a4053a46b95ed9d87e8e7afe0495b6d47ad9b8824aa73be7', NULL, NULL, 'CG_5b71e6ddc45f7', 'Complete', '2018-09-12 15:15:25', '2018-08-13 15:15:25', '2018-08-13 15:15:25', 3),
(19, 1, 'Grupo Financiero Banorte', 'Nuevo León', 'Monterrey', 'rosa.torres@banorte.com', '8181569700', 'Rosa Torres', '2018-11-07', '2018-11-09', '{\"habitacion sencilla\":{\"cantidad\":\"1\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"30\",\"tarifa\":\"1092.00\"}}', 2, 3, 31, 61, '173645.04', '1cb4dadba1be3dc90c83998d5d085103a2eb20842d3467b7a9c0ac7628fa0a1294af0d582e7ed316f7521ebc5ef9175d5f13372d9e4e72ebd68c079e7b17d4cf9cc961a028483b1490d5966d8380618c45c6d47edd4eafac0cd35e059b57ad45888fef39325dc4e8e3bc70bab025ec70f907e860a0729dc5b079478037501343', NULL, NULL, 'CG_5b71e76c806ca', 'Complete', '2018-09-12 15:17:48', '2018-08-13 15:17:48', '2018-08-14 14:04:48', 3),
(20, 1, 'General Motors', 'Coahuila', 'Saltillo', 'rodrigo.aviles@gm.com', '8443501808', 'Rodrigo Aviles', '2018-10-10', '2018-10-11', '{\"habitacion doble\":{\"cantidad\":\"40\",\"tarifa\":\"1092.00\"}}', 1, 2, 40, 80, '165704.00', 'e0cb4ec410fb4cf92afd5b05df1b5b4130c665e96a77e8077ec7f43154cde9e8e4a06b886a494b7c9ef810cffc862c45e83e1545b305f78cbe007963e5412868c0c43872ec89d419efb94d797ab7680a0a1e71d4a65065dd3b12c00ff08c96b04288af087d8d2a6c425081ddbc4e61a15175f70bc1110011df44c8d65a7a3118', NULL, NULL, 'CG_5b71e7f22e204', 'Complete', '2018-09-12 15:20:02', '2018-08-13 15:20:02', '2018-08-13 15:20:02', 3),
(21, 3, 'Prolamsa', 'Nuevo León', 'Monterrey', 'cynthia.medina@prolamsa.com', '8181540200', 'Cynthia Medina', '2018-07-23', '2018-07-25', '{\"habitacion doble\":{\"cantidad\":\"30\",\"tarifa\":\"1092.00\"}}', 2, 3, 30, 60, '197008.00', '4c2dc3314d70b4523f1ec55c61ce918d96fd3d50563af927398b682ac3b566ac758333f1b6ab1e754cbf693a3cc551ca64699cde02e97da6fa4740c088e0b67a7791b54e0a8f1310fd53b9b9fe70e37f16d3c32af20e677a879526d1860756f849f2c0810841eb3a499dd7d18cc0eaa50a9141f95fc1884b684c3c9513d1a8e7', NULL, NULL, 'CG_5b71e955856c0', 'Complete', '2018-09-12 15:25:57', '2018-08-13 15:25:57', '2018-08-13 15:25:57', 3),
(22, 3, 'Coppel', 'Distrito Federal', 'Venustiano Carranza', 'evelyn.castillo@coppel.com', '5558041060', 'Evelyn Castillo', '2019-01-18', '2019-01-21', '{\"habitacion doble\":{\"cantidad\":\"100\",\"tarifa\":\"1344.67\"}}', 3, 4, 100, 200, '897249.00', 'c831a30a29fe6d81e28ab20f20146c8b80286d53f82b17063d70e9bbf092049e940f406fb2da75b23bcead5ec4d05e4a963521877fe9f892eb98b25c825febb104bc5da0a24930dd35c0894fae025788c7960ecf71261a8a38a7427b46fad5f6bc338a56d9d704774bb96ac3791ca4988a8d12248af27ab6867364ecc7f0bb80', NULL, NULL, 'CG_5b71a352c0ef8', 'Complete', '2018-09-12 15:29:13', '2018-08-13 15:29:13', '2018-08-13 15:29:13', 3),
(23, 3, 'Mary Kay', 'Coahuila', 'Saltillo', 'mayramarykay@yahoo.com.mx', '8441009974', 'Lic. Mary Kay', '2018-09-14', '2018-09-15', '{\"habitacion cuadruple\":{\"cantidad\":\"25\",\"tarifa\":\"2059.00\"}}', 1, 2, 25, 100, '146912.00', 'b77c7fdbe7ad8c2ad4ff4209395397a965147fc81a4d159e9bed3a3cb822002b327e656bd25c218aa4597ba4bdee2fd6c966003cf794ea1b12fb3b8e2dd1ab91cb2af03383fe188bd81029f9a6d4c419e06795961263814f0ffaf4a6dc1f769805c84798a4af62af1b7b80a77078d21d451ea457df098368e24eacd6d4cf725f', NULL, NULL, 'CG_5b71ead40e195', 'Complete', '2018-09-12 15:32:20', '2018-08-13 15:32:20', '2018-08-13 15:32:20', 3),
(24, 3, 'John Deere', 'Nuevo León', 'Monterrey', 'moralespaula@johndeere.com', '8188888483', 'Paula Morales', '2018-07-18', '2018-07-19', '{\"habitacion sencilla\":{\"cantidad\":\"8\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"8\",\"tarifa\":\"1092.00\"}}', 1, 2, 16, 24, '21282.00', '26166ad5cd54eb533e6baf6710f6e573f3b4ec4b71529796f27691bf72fad94713e21d56ae79671043a5937c51057bd881545f91c340e2ebbe0353c92d343b45747bf1eb9bdd06b54d06a1f7bd3ddf987613a34211f3b66dd3513b0c145a6271224cb77922654fcfc098fe11dbd586a7f21371674879198e2d3ff9cc3b0082af', 'orden_c-rm-24_13-08-2018.pdf', NULL, 'CG_5b71eb49213d4', 'Complete', '2018-09-12 15:34:17', '2018-08-13 15:34:17', '2018-08-13 15:34:17', 1),
(25, 4, 'Experteams', 'Coahuila', 'Saltillo', 'yohana@experteams.com', '8117186840', 'Yohana Reyes', '2018-06-29', '2018-06-30', '{\"habitacion doble\":{\"cantidad\":\"9\",\"tarifa\":\"1471.00\"}}', 1, 2, 9, 18, '31239.00', 'fe0a5c59f2beaed0ec7d870fca2cafdf40324c594b9f8d96ffd6c40bd8a192d298a23a285e41be771e9afc817df9909fbda2c5845fdf6bb62a809f2d5ce4432ce15113024489d33cbba5f33892b4264aaec5e9d25a78aab39d44b5b98c8f524d569ad4c529d00a54fde50755d1960ea8c65ba7845756e90ff782fc0e27d70fff', NULL, NULL, 'CG_5b71eb8e72ed6', 'Complete', '2018-09-12 15:35:26', '2018-08-13 15:35:26', '2018-08-13 15:35:26', 3),
(26, 3, 'Magna Formex', 'Coahuila', 'Saltillo', 'suria.herrera@magna.com', '8443625553', 'Lic. Suria Herrera', '2018-10-09', '2018-10-11', '{\"habitacion doble\":{\"cantidad\":\"25\",\"tarifa\":\"1092.00\"}}', 2, 3, 25, 50, '108370.00', '18c81119c920c4c6d625e63ee624da36e09c417c4114679775c7e7dc29118aeef75f9a3608b619ec9fa9ee8177b136e1c9417c7438884971f26160e879d28b046c3d0759db707dde6d2c9228cdf46b2349ad08cafe52c00ee4e05b9da52b0a3d9747a004394c3082a2bfc5186df8f8b12d81f24cc917e5d42b623462e1662faa', NULL, NULL, 'CG_5b71ebb02de6f', 'Complete', '2018-09-12 15:36:00', '2018-08-13 15:36:00', '2018-08-13 15:36:00', 3),
(27, 4, 'Festo', 'Nuevo León', 'Monterrey', 'luis.a.ballesteros@festo.com', '8117784743', 'Luis Alberto Ballesteros', '2018-07-11', '2018-07-12', '{\"habitacion sencilla\":{\"cantidad\":\"14\",\"tarifa\":\"1092.00\"}}', 1, 2, 14, 14, '36022.00', 'e12fdab2e81560cd168a82b16a5da644282f3801d3ccb3563a257a9759236f044c224399839b8ab1dcfe42b3756904da2ffafa99f35eca6dbd38e5a6dfec1620eb3f3c663d862392d4517e31f9086b7ee19ca0efe440f3c3573fee26576fdc13264ab4fcd7f7fbb7ec694066fa5a80cbdc7646b5a119b4b04a197b699df875a8', NULL, NULL, 'CG_5b71ebfa47ad5', 'Complete', '2018-09-12 15:37:14', '2018-08-13 15:37:14', '2018-08-13 15:37:14', 3),
(28, 3, 'Prospera', 'Coahuila', 'Torreón', 'victor1986morales@hotmail.com', '8712451637', 'Ing. Victor Manuel De La Fuente', '2018-07-05', '2018-07-06', '{\"habitacion cuadruple\":{\"cantidad\":\"13\",\"tarifa\":\"1681.00\"}}', 1, 2, 13, 52, '57965.00', '3defd8417b3aef850162e0519bae9920cebe0755e1d61c3153aaa646ece037997f99885935269dd81a5016d9c0128f8ade35c60b24f2d71ee79920948730bae96aec35a31d8175ffd99812f42b8b74d582671ead4e283a7e9d2902c5a581e273616b8814072483952fccd3d917713c7154fb62a00eff7f735f2d8df6a0424d99', 'orden_c-rm-28_13-08-2018.pdf', NULL, 'CG_5b71ec4755006', 'Complete', '2018-09-12 15:38:31', '2018-08-13 15:38:31', '2018-08-13 15:38:31', 1),
(29, 4, 'Heb', 'Nuevo León', 'Monterrey', 'ivramirez@hebmex.com', '8181531100', 'Ivonne Ramirez', '2018-07-20', '2018-07-21', '{\"habitacion sencilla\":{\"cantidad\":\"1\",\"tarifa\":\"1471.00\"},\"habitacion doble\":{\"cantidad\":\"17\",\"tarifa\":\"1471.00\"}}', 1, 2, 18, 35, '77669.00', 'e70fcfe2033d5174f1dd72a103a39274efc575606b6999d8e578dfbd0277e4eb9b5c0e2a500d87862e3bee2dc276767cb307e3741ce3086776e9dc0857e02e1cfd22248518f0380575948bfa56d824b6dd8bbc5b8ca155010295cf3a12c5dbc95eda9e034c46e977f691df86bd7bd87299f09c68043eab3cf77ef73b0465de10', NULL, NULL, 'CG_5b71ec7068768', 'Complete', '2018-09-12 15:39:12', '2018-08-13 15:39:12', '2018-08-13 15:39:12', 3),
(30, 3, 'Bcd Travel', 'Nuevo León', 'Monterrey', 'dolores.sustaita@bcdtravel.com.mx', '8181338923', 'Dolores Sustaita', '2018-09-27', '2018-09-29', '{\"habitacion sencilla\":{\"cantidad\":\"30\",\"tarifa\":\"1281.50\"},\"habitacion doble\":{\"cantidad\":\"15\",\"tarifa\":\"1281.50\"}}', 2, 3, 45, 60, '211249.00', 'fe1d4f4b44c638cc4062cf5ea36d4969aad74e0a53a926b0f12bee1609aae98d60482d5cf857ddb6ae6417481f1fc4f6ad29494d1f2c1c756cc71568d3fb50a9153b84819725b1e3eb15653346d9b94d342aa4b22484d19988a6b0f8a53c6d5e70105fc7cf92698a63540f66869690a7fa82319a6ca1fc2539228f66516534ed', NULL, NULL, 'CG_5b71ecbd0ca89', 'Complete', '2018-09-12 15:40:29', '2018-08-13 15:40:29', '2018-08-17 08:56:57', 3),
(31, 4, 'Holding Gains', 'Nuevo León', 'Monterrey', 'sac@holdingains.com', '8122706990', 'Karla Peña', '2018-07-12', '2018-07-13', '{\"habitacion sencilla\":{\"cantidad\":\"2\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"5\",\"tarifa\":\"1092.00\"}}', 1, 2, 7, 12, '20172.00', 'e0c2d920106a4f9edd5a2e09525dbd054b7191f2dc916997b2fed329bee708dd16baa16f850b4c43ab35e970c90d38fb6491538fd04cd47d479ab527cd6718f5089a5fae5402385833837ba37ad0e588def88313c4cfc4f4cdd7c76a2880b106d0c749b5810ebb28f7a87e5f047b8c817919a32052bcc18ebbf41bf468847367', 'orden_c-rm-31_13-08-2018.pdf', NULL, 'CG_5b71ed07d6a0a', 'Complete', '2018-09-12 15:41:43', '2018-08-13 15:41:43', '2018-08-13 15:41:43', 1),
(32, 3, 'Interticket', 'Nuevo León', 'Monterrey', 'bcamacho@grupointerticket.com', '8110335128', 'Beatriz Camacho', '2018-08-14', '2018-08-16', '{\"habitacion sencilla\":{\"cantidad\":\"1\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"12\",\"tarifa\":\"1092.00\"}}', 2, 3, 13, 25, '89106.00', '5ba741b3ef07be8ce5ebb8dce9b1dfc1a69bf7f64899aeed2065079540dfaf69b3c533a1173e06607d1f165a4254267894990c10ca3a4aea53e94d13a5eb5af4ce9043b0829bf172055e0fde49818aa578aa6535a2f1a44a7d1be85c7bea01037e9041522b5bdc60ae35a54987985e7644123c9bc6a9829368a9de198bb69cb9', NULL, NULL, 'CG_5b71ed3ac5adb', 'Complete', '2018-09-12 15:42:34', '2018-08-13 15:42:34', '2018-08-13 15:42:34', 3),
(33, 3, 'Fira', 'Coahuila', 'Saltillo', 'ssanchez@fira.gob.mx', '8444155226', 'Silvia Sanchez Ramos', '2018-07-30', '2018-07-31', '{\"habitacion sencilla\":{\"cantidad\":\"12\",\"tarifa\":\"1092.00\"}}', 1, 2, 12, 12, '29441.00', 'cc0bc71730c2ddf83bd04ee7820a07ae7253e8a50b542f2719f6c20bbd98b458776d63d746d7b463b28b26cc02294071f3348d65410894ced5bd7d01922464def3d6c7cce428e75255a919dad6e0a54bf013842b3591fc556cb8ec69354eae203f0f8257a32d62eac52d3f34dfc9acba14ebb02ba6568e951e5707fd7e5b88b3', NULL, NULL, 'CG_5b71eda33ba23', 'Complete', '2018-09-12 15:44:19', '2018-08-13 15:44:19', '2018-08-13 15:44:19', 3),
(35, 4, 'Dif Cohuila', 'Coahuila', 'Saltillo', 'kattyeg64@hotmail.com', '8444192035', 'Katty', '2018-07-30', '2018-07-31', NULL, NULL, 2, NULL, 40, '11746.00', '811679314a5e32263c36db7c704a6a31ce8a63f7a9fbd35b035094e93fec3273f668fec03f67ab3fa27976204b97dfb86cca6a06fda82dfe34490a179b1fba6287bb0b776ffcd6422a9d2095d89317635649606c26e070b1441c459b10a72a8137b4dc889307253f748d82519586450e14111299c0cd0103ddaa297513a8558a', NULL, NULL, 'CG_5b71ee4070e29', 'Service', '2018-09-14 15:46:56', '2018-08-13 15:46:56', '2018-08-13 15:46:56', 3),
(36, 3, 'Avon', 'México', 'Toluca', 'abigail.lopez@avon.com', '5585250627', 'Abigail Lopez', '2019-03-08', '2019-03-10', '{\"habitacion doble\":{\"cantidad\":\"25\",\"tarifa\":\"1471.00\"}}', 2, 3, 25, 50, '166010.00', 'a1d425f9fc3a53e355cc36c5318178ab1bf1e11bd87694fec3f95a7af69e121d83d3fff64423d863859812880f4668a072241ce37028759ddcbf8a432f02c5938547dbcfe046cace08c1370bcf4da59d3b441e5d1c4e00137ac686ad15529f49dd4ff53a3f6f5163d96366b8091e1f8d66c1a92f5df0c305b4804d9c1fa3c357', NULL, NULL, 'CG_5b71ee7956cda', 'Complete', '2018-09-12 15:47:53', '2018-08-13 15:47:53', '2018-08-13 15:47:53', 3),
(37, 4, 'Asesoria Profesional En Eyc S.a. De C.v.', 'México', 'Valle De Bravo', 'compras@eventosyconvenciones.com.mx', '5523192894', 'Francisco B. Avila Pavon', '2018-09-04', '2018-09-05', '{\"habitacion sencilla\":{\"cantidad\":\"5\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"5\",\"tarifa\":\"1092.00\"}}', 1, 2, 10, 15, '33182.00', '714be3e75ae6f71c354142e3518b3dcbbbe0850fab7bcbf30bf73c9296447e940baa110299ea39714c4524ff35f4b7e1d2cdf114a236010e88f00d6adfe511994c59d990bd8dc798bfe285ce7b3e4dab7f2501333de5223cd53592888009e11b881bac02225e20e22ed669fe9142e7e72a298e4a8e9d5c5ca197449dcc66791c', 'orden_c-rm-37_17-09-2018.pdf', 'Evelyn_C-RM-37.pdf', 'CG_5b71eee0f131d', 'Complete', '2018-09-12 15:49:36', '2018-08-13 15:49:36', '2018-09-10 13:54:56', 1),
(38, 3, 'Pepsico', 'Coahuila', 'Saltillo', 'daniel.muniz@pepsico.com', '8448934880', 'Ing. Daniel Muñiz', '2018-09-03', '2018-09-05', '{\"habitacion doble\":{\"cantidad\":\"32\",\"tarifa\":\"1092.00\"}}', 2, 3, 32, 64, '198026.28', 'fcaca9642aebc0b9c3392bc9f69d66fe825fa88af35ee8bd468556f6d1b7d7c5c7d5430457c73d1830fd05dffe8d0005bcaaf24f0f2d6ce2ba2ac3ce42a5a0717619efa94779c90246d5a9ed0539458502a7f39f6e05e869d2619b471fec77307be22e0fcefb9af929eb1f7e5ef11331626b3b6c4e5aace044e35026363f3883', NULL, 'Silvia_C-RM-38.pdf', 'CG_5b71ef335ef4c', 'Complete', '2018-09-12 15:50:59', '2018-08-13 15:50:59', '2018-08-23 13:55:43', 3),
(39, 4, 'Ana Isabel Garza', 'Coahuila', 'Torreón', 'anagarza1983@gmail.com', '8712118214', 'Ana Isabel Garza', '2018-11-30', '2018-12-02', '{\"habitacion doble\":{\"cantidad\":\"20\",\"tarifa\":\"1471.00\"}}', 2, 3, 20, 40, '126142.00', '4475218331fccdcd6c8f288a97a8da84a9bb80a3ac0ff2edd228ccb4ab2aa9d427370916a5fb07caf281edf0db4b5deff00001475e8d8deeea4e60a1ba44cfd4b6165801d1c4978df56dbd65c7a37406851cf25386a23a73101471937b1c7d3455472830c72a9f432b1c40eb7a4939ebc2221fd744e3715ceb17a0b61f74c16d', NULL, NULL, 'CG_5b71ef6059c2e', 'Complete', '2018-09-12 15:51:44', '2018-08-13 15:51:44', '2018-08-13 15:51:44', 3),
(40, 3, 'Mendez Consultores', 'Coahuila', 'Torreón', 'gammpsy@gmail.com', '8712181988', 'Gerardo Mendez Morales', '2018-10-13', '2018-10-14', '{\"habitacion doble\":{\"cantidad\":\"15\",\"tarifa\":\"1471.00\"}}', 1, 2, 15, 30, '64406.00', '088fb7277f36fc3061c7b23c20a4208a087783049c685b0fe83960cd9592d1db20ed7b099132b7a2352e4a3ff872327c7dbdc0b5e2015ae7e6d9142fc7eca1de48f4aa06dc5f233fd020d8b202f2e7eaac449af67abf7d611a57270359f8c46e622aa2c41527e1837c83edeb59fcdf26f44b2184724156c2fe8cb36a16ce0da6', NULL, NULL, 'CG_5b71efb8def80', 'Complete', '2018-09-12 15:53:12', '2018-08-13 15:53:12', '2018-08-13 15:53:12', 3),
(41, 4, 'Café Marino', 'Coahuila', 'Torreón', 'vero@cafemarino.com.mx', '8717270934', 'Veronica Senceño', '2018-09-05', '2018-09-07', '{\"habitacion sencilla\":{\"cantidad\":\"2\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"4\",\"tarifa\":\"1092.00\"}}', 2, 3, 6, 10, '17588.00', '057e7a0e9f66fd9be7f74a9eae887f80660473a8fb7e1ad289465878090ed3b282acefad85c8e9b0162be0ee9eeca1d4d205fd3f77fade6a42de59d00b8ea02a2e5cfa641cb16cc8c4551e69ad7d0f42f8588b3422715fbe9360b68b55c25cc7f2c2bfb7a8395c0acf47b4bfb17bb1ea942bc928b955f0d4b89ced7acfb01ba9', 'orden_c-rm-41_25-08-2018.pdf', NULL, 'CG_5b71efd87651b', 'Complete', '2018-09-12 15:53:44', '2018-08-13 15:53:44', '2018-08-13 15:53:44', 1),
(42, 3, 'Destinos', 'México', 'Toluca', 'jaznar@grupodestinos.com.mx', '5553403700', 'Jorge Aznar Alcala', '2018-08-28', '2018-08-30', '{\"habitacion sencilla\":{\"cantidad\":\"3\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"4\",\"tarifa\":\"1092.00\"}}', 2, 3, 7, 11, '38232.00', '8e7d03d4d5ec08c1c474dd8d26c91cd9523e521e2a7ddbdf6caad573ba3c8e349c523ba897ae55a3d5f14a73dbf22ba2bb996d15746e069b7e5ae6e6927d4d208674702b25cea0d62ca4b3b7b4e681270b0259c20de2179bff25a8b1ee858a23043addd52609fb2c512accd26bcd9b6117206dee1701f8868c125921af623509', 'orden_c-rm-42_20-08-2018.pdf', NULL, 'CG_5b71f03be3cda', 'Complete', '2018-09-12 15:55:23', '2018-08-13 15:55:23', '2018-08-13 15:55:23', 1),
(43, 4, 'John Deere', 'Nuevo León', 'San Pedro Garza García', 'barriosvicente@johndeere.com', '8182881212', 'Vicente Alejandro Barrios Garcia', '2018-08-29', '2018-08-30', '{\"habitacion doble\":{\"cantidad\":\"10\",\"tarifa\":\"1092.00\"}}', 1, 2, 10, 20, '30940.00', 'e89bf9522cbf0b5ca5853c3a877ba9fd0acf545614a68916bb0e57a7e6008f13d87d5580f09c30adecf142c71d7995696c89ece409a1239221ec2382a7271961eb6519969fc161ef9ab083ff591a7200896da5649b20fe59b7a64682fb8b826a9119637cce1a3bed76c0059419be418dd49e24ae9f8a53c1c5a7c62593e9f8b4', NULL, NULL, 'CG_5b71f08b05d6a', 'Complete', '2018-09-12 15:56:43', '2018-08-13 15:56:43', '2018-08-13 15:56:43', 3),
(44, 3, 'Multiceras', 'Nuevo León', 'Monterrey', 'recepcion@multiceras.com', '8181210100', 'Mayra Holguin', '2018-11-15', '2018-11-16', '{\"habitacion sencilla\":{\"cantidad\":\"14\",\"tarifa\":\"1092.00\"}}', 1, 2, 14, 14, '36264.00', '95adc8295805e6f0865ad9f8d7fa47c02c0709f04b4745fff4af2d0d59b9ae70fa1388c4e14499cf1ffba06e86af3ebd499a4e2c8c74437e6d5cc49d04dcfa5d7db8582096d93f76eb2810f84e49becf8fbc7d60a00b77dea59564dc3744c9778d5dbb8b2493ecd0a189b68a452a56994ac7e28754f167af6e983b387cae8d17', NULL, NULL, 'CG_5b71f09a025d1', 'Complete', '2018-09-12 15:56:58', '2018-08-13 15:56:58', '2018-08-13 15:56:58', 3),
(45, 4, 'Peñoles', 'Coahuila', 'Torreón', 'jorgerarl@hotmail.com', '8717540859', 'Jorge Rendon', '2018-10-01', '2018-10-05', '{\"habitacion sencilla\":{\"cantidad\":\"10\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"30\",\"tarifa\":\"1092.00\"}}', 4, 5, 40, 70, '413986.00', '78fb8e3a89018f06b996915b5b101c8cdb5d2248d926cd673975e191cf1963f00273f4a191f9d51f47ccdb0a86b7b451e580ede58d5f472f3770f3629bf94cefc875b12df77275c9a146f1a6d26f9b32444130badea07f9a58e1e19e83b9bb5ae2a5939cfabeeca405d0f1be43151aadce7d389ce2ef2aea3da6fb5d0b18b82c', NULL, NULL, 'CG_5b71f144985cd', 'Complete', '2018-09-12 15:59:48', '2018-08-13 15:59:48', '2018-08-13 15:59:48', 3),
(49, 4, 'Semillas Escalera', 'Coahuila', 'Torreón', 'elizabeth.semillasescalera@outlook.com', '8717190803', 'Elizabeth Quiñones', '2018-10-26', '2018-10-28', '{\"habitacion doble\":{\"cantidad\":\"15\",\"tarifa\":\"1471.00\"}}', 2, 3, 15, 30, '95558.00', '8ed81ba37751916d9fe824f5befc725f1fdbd555e9d57b97f19740b6f147dc668697fa033d8a790df990b814c9613fd6351884d0d91e7ecd4ff8416ae43a4a688ef11a09f71d339e4bf7b5c3be5114d7b7fa659c8febe7827021d94a2941898b7cc2dbc747da5ac96f89bc81d8ae5c3241b84a19d9bb9ee3409c8533b0aa0d5a', NULL, NULL, 'CG_5b71f31a65713', 'Complete', '2018-09-12 16:07:38', '2018-08-13 16:07:38', '2018-08-13 16:07:38', 3),
(51, 3, 'Unidos Somos Iguales', 'Nuevo León', 'Monterrey', 'liliana_981@hotmail.com', '8180489800', 'Liliana Reyes', '2018-09-21', '2018-09-23', '{\"habitacion sencilla\":{\"cantidad\":\"1\",\"tarifa\":\"1471.00\"},\"habitacion cuadruple\":{\"cantidad\":\"10\",\"tarifa\":\"2059.00\"}}', 2, 3, 11, 41, '96837.00', '78c29ff2d4dab26f9e296adc0bcee5cc01d6fb545b27dc712ee1b672d8ba299e49159629dccf2004d3fb3184da72badce317990196c1d75d85e31b35fecb6432dcfcbdba47907feeaa703fc84684881e5c823dfe3d05d0ae992318ba03e857b1af6a80954bbd01a4100a28a88744c14f6dad599d6bde7e46da4a0d5d59b70ab8', NULL, 'Silvia_C-RM-51.pdf', 'CG_5b733dc71dc1d', 'Complete', '2018-09-13 15:38:31', '2018-08-14 15:38:31', '2018-08-16 09:55:52', 3),
(53, 3, 'Mary Kay', 'Coahuila', 'Saltillo', 'mayramarykay@yahoo.com.mx', '8441009974', 'Lic. Mayra Cardona', '2018-11-09', '2018-11-10', '{\"habitacion cuadruple\":{\"cantidad\":\"50\",\"tarifa\":\"2059.00\"}}', 1, 2, 50, 200, '269618.00', '0a30d76b6561b8126122ea13df0e116c4754b1f72e41b49de7588ff324ba4dbfdaccdcace68781b9cee9b5a7abd6c941d87dc65e5754715ff053ebbc8280a2b2702ecf1164ffce4b334afcec4ea8d629e754fa253ace48c49cd7a4aad942f90ca2ce0bf14dffb93a144b409c417d252163fc6303753e1f6d87029f53300c2a7e', NULL, NULL, 'CG_5b71ead40e195', 'Complete', '2018-09-14 08:22:19', '2018-08-15 08:22:19', '2018-08-15 08:22:19', 3),
(54, 2, 'Va Vending', 'Coahuila', 'Saltillo', 'candy.valdes@vavending.com', '8443508973', 'Candy Valdez', '2018-09-08', '2018-09-08', NULL, NULL, 1, NULL, 25, '13393.00', '0a2f3c8e234b74b0e22d07df9a8478d8a1a6cf5a20841043b60c358db781d80a22fc2e524a0218a4b15da9e7204fd31064df287b602e75e578b08265f6cd6b62710809420dda2c2907a2f9b70a10ac9fe75a95dc532a3a6a1408a17f0f6b7b5decef6bd69ca60c5ec9c065e90ddd88f56792c525ccc0ee143fb66e1fc526549d', NULL, 'Nayeli_C-RM-54.pdf', 'CG_5b744bb6a9161', 'Service', '2018-09-16 10:50:14', '2018-08-15 10:50:14', '2018-08-15 10:50:14', 3),
(55, 3, 'Mabe', 'Coahuila', 'Saltillo', 'jeanymoreno@hotmail.com', '8442952166', 'Janeth Moreno', '2018-12-06', '2018-12-07', '{\"habitacion sencilla\":{\"cantidad\":\"18\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"11\",\"tarifa\":\"1092.00\"}}', 1, 2, 29, 40, '93613.00', '439b00246562a0deea60430eeddae04213adb4ca82969a1d53e70997b2368d59ab4107618d91cec1a30d7134db389d81b38a7b5777cd49928b91faf568a955a2045fc30e7e56404661e3ce22f761aef0a9acd7fd1e567da2566a438f88a786f3c9bee0b1eba855342ffbfa25b5ee9f851e2cd02c8df89db8ce3ef72d0167f021', NULL, 'Silvia_C-RM-55.pdf', 'CG_5b7484f42d584', 'Complete', '2018-09-14 14:54:28', '2018-08-15 14:54:28', '2018-08-20 10:29:31', 3),
(56, 1, 'Surtidor Eléctrico', 'Nuevo León', 'Monterrey', 'asistentedireccion@surtidorelectrico.com', '8113760137', 'Daniela Cortes', '2018-12-08', '2018-12-09', '{\"habitacion sencilla\":{\"cantidad\":\"3\",\"tarifa\":\"1471.00\"},\"habitacion doble\":{\"cantidad\":\"6\",\"tarifa\":\"1471.00\"}}', 1, 2, 9, 15, '34628.00', '2fa816158df389646a8f239c5f4998a5c3e242cdae0d8905fa7352c097fd445b75602e14fd0f9868cb123b04d31ff2fc4179f5855c98b35021772e27efcddc3a9af33c6f7697d398b60a63340775d624fa8f389a08fbc0fa6992feb89ef637a63b44e0d5fd6fbe4f3b6e1f72bc15459449ec9b3369338aa2edb5c1173589ec5e', NULL, 'Ing. Ignacio_C-RM-56.pdf', 'CG_5b74a09ec4b90', 'Complete', '2018-09-14 16:52:30', '2018-08-15 16:52:30', '2018-08-15 16:52:30', 3),
(57, 1, 'Viajes El Corte Ingles', 'Distrito Federal', 'Benito Juárez', 'e.herrera@viajeseci.com.mx', '5541475732', 'Esther Herrera', '2018-08-21', '2018-08-22', '{\"habitacion sencilla\":{\"cantidad\":\"25\",\"tarifa\":\"1092.00\"}}', 1, 2, 25, 25, '60514.00', 'd106307e5a638a0843fa285d7051295c48db19f872b0a26e40ac51d5581ff9e03678e4c7d413264b1e2ad9a099b4a7c2907d64d2af84a19fd7144c2305fe26138784327ffa22081ecb6a7406dc13c83edc78a6b2cebdb62eb07325a7b6661d39460dbb3a22ecb4ee846dc2c25bb8971a6bd1e8dd8ec4cc0abed783be85574578', NULL, 'Ing. Ignacio_C-RM-57.pdf', 'CG_5b75b2c202572', 'Complete', '2018-09-15 12:22:10', '2018-08-16 12:22:10', '2018-08-16 12:22:10', 3),
(58, 3, 'Grainger', 'Nuevo León', 'Monterrey', 'montes_sl@hotmail.com', '8183666767', 'Ing. Cesar Leza', '2018-08-21', '2018-08-23', '[{\"Martes 21 de Agosto\":{\"habitacion sencilla\":{\"cantidad\":\"1\",\"tarifa\":\"1092.00\"}}},{\"Miercoles 22 de Agosto\":{\"habitacion sencilla\":{\"cantidad\":\"13\",\"tarifa\":\"1092.00\"}}}]', 2, 3, NULL, NULL, '35272.00', 'fc0daa470339aea3e703ce22c9f4eb5e451b218669db7165d9424a1289676b65d38de719f29a581b0e3a913e7c88e850118fd48f0828486c3e34e1e3040049ef479319a7cf2b8b8c8d1c9ed63d24fa25fd90f89d677aac2fc30354e2dd504981289072225f0cc3cd2baf1375ee37ee2d87f35f3c0237581a9a4695b98e9fcf67', 'orden_c-rm-58_20-08-2018.pdf', NULL, 'CG_5b75e29d23e85', 'Special', '2018-09-15 15:46:21', '2018-08-16 15:46:21', '2018-08-16 15:46:21', 1),
(59, 2, 'Bcd Travel', 'Nuevo León', 'Monterrey', 'dolores.sustaita@bcdtravel.com.mx', '8181338923', 'Dolores Sustaita', '2018-08-24', '2018-08-26', '{\"habitacion sencilla\":{\"cantidad\":\"1\",\"tarifa\":\"1471.00\"},\"habitacion doble\":{\"cantidad\":\"16\",\"tarifa\":\"1471.00\"}}', 2, 3, 17, 33, '108923.00', 'da9d4ec35950362c8c11291773193b1c2dd8df3ce7a70a9227d3937215d960f3ec656c95e1dc6c69576e6e730c14a7e79d93097c13167697fad791a92dd446a5fd839b71fb65364c16484c379895fd499afe21a9ec6c437f91059397693926caa5bdeb975b41a445ebea1022c71d08b95caf7a2e6e6b4c085a48f32764e91d74', NULL, 'Nayeli_C-RM-59.pdf', 'CG_5b76d14b88187', 'Complete', '2018-09-16 08:44:43', '2018-08-17 08:44:43', '2018-08-17 08:44:43', 3),
(60, 1, 'John Deere', 'Coahuila', 'Torreón', 'santibanezgabriela@johndeere.com', '8711499947', 'Gabriela Santibañez', '2018-09-06', '2018-09-06', NULL, NULL, 1, NULL, 90, '56528.00', '92c3e802add863fbaf7decf49b14a7eddfec752c342c4d578d393cdf80d70599328b51bcfd95e6d327c1c5cd0f3d7ee526fa604bf1fcb90e08387d115b7a0009f88c9a48c7b996d75a6ec63c91400909527ffed2ebe33fe10c72fb26512e870fa79c3f2d426b675d6795730da78fcdecc93563e986364874a87aecf9d16f2412', NULL, 'Ing. Ignacio_C-RM-60.pdf', 'CG_5b76ea3f51cff', 'Service', '2018-09-16 10:31:11', '2018-08-17 10:31:11', '2018-08-17 10:31:11', 3),
(61, 2, 'Grupo Versa', 'Coahuila', 'Torreón', 'guisne@hotmail.com', '8717054025', 'Carmen Cedillo Gomez', '2018-10-03', '2018-10-05', '{\"habitacion sencilla\":{\"cantidad\":\"9\",\"tarifa\":\"1092.00\"}}', 2, 3, 9, 9, '40521.00', '1a32c8c9e2bd2cad61b75f7484af3d6cc0621edbc21e2ffe12dcf509198c347956a06c9d7dcd280e353210db19c91717b133c1403a93bd07839917e4089487597640d5fb0e295cf05fd208423036cf1b9c232935377b4c1bb1e65486903ac8def6a38a92277ebabfd6c2eb8148088964136c2977b700e8a5097b96f73f9acf7b', NULL, 'Nayeli_C-RM-61.pdf', 'CG_5b7ac1457fa74', 'Complete', '2018-09-19 08:25:25', '2018-08-20 08:25:25', '2018-08-20 10:57:56', 3),
(62, 1, 'Global Noia', 'Coahuila', 'Saltillo', 'gerardo.castillo.rdz@gmail.com', '8444271856', 'Gerardo Castillo R.', '2018-09-10', '2018-09-12', '{\"habitacion doble\":{\"cantidad\":\"11\",\"tarifa\":\"1092.00\"}}', 2, 3, 11, 22, '67810.00', '0ac66bd984759fa2adf01179d084ff1856d8ca178a5c20fdb4bf03937907f4cc1f92456cd1e8fdb68615f319802b65246df57915847605f76da85c0b24e1321a102792bc86cfd35cf859a00fcc3bf3f67971b0299ef24518484aec3d7fdad8923d76c48e8c63db9ba8023f6c28161bea258f3249ed13246523d6e656afd6aa11', NULL, 'Ing. Ignacio_C-RM-62.pdf', 'CG_5b7d8353b7211', 'Complete', '2018-09-21 10:37:55', '2018-08-22 10:37:55', '2018-08-22 12:50:13', 3),
(64, 1, 'Itesm', 'Nuevo León', 'Monterrey', 'erika.r.rodriguez@itesm.mx', '8110449375', 'Erika Rangel', '2018-09-12', '2018-09-14', '{\"habitacion sencilla\":{\"cantidad\":\"20\",\"tarifa\":\"1092.00\"}}', 2, 3, 20, 20, '86914.00', '4cd27270eb1b8280f80bcfc2b56a05d7da4ecdc716f2f59deadf404265029fe54fd8430278fa0de89e55a20b7380aaf317dd9b40403417f1a87d819b95158eb925c83d26b884f18013339ebaa8a7e2fe375a41f9935bbe2970df9535ffd1fa86ae5774e47d5e07b4811da6c078d824a397c1122434d31ab4dfd7d008e1704818', NULL, 'Ing. Ignacio_C-RM-64.pdf', 'CG_5b7da72da6288', 'Complete', '2018-09-21 13:10:53', '2018-08-22 13:10:53', '2018-08-22 13:10:53', 3),
(65, 3, 'Unidos Somos Iguales', 'Nuevo León', 'Monterrey', 'liliana_981@hotmail.com', '8180489800', 'Liliana Reyes', '2018-09-22', '2018-09-23', '{\"habitacion sencilla\":{\"cantidad\":\"1\",\"tarifa\":\"1471.00\"},\"habitacion cuadruple\":{\"cantidad\":\"10\",\"tarifa\":\"2059.00\"}}', 1, 2, 11, 41, '29220.00', 'cb14a0f365f3beb22ab10196797e88242347d0274ff9ba500646f316375fd2cd9efe4254be340298f22e163783c43d162ee6943f64dcd78c8818e83a37c2c6cc88a490fe04222765e28bfe87400e74f517f5c909088b3fb50cd45fb5e0d1d034b389a17a3a6bf102a17327be011e59123a53c0afb8810b3ce1d99a6720c5ba89', 'orden_c-rm-65_19-09-2018.pdf', 'Silvia_C-RM-65.pdf', 'CG_5b733dc71dc1d', 'Complete', '2018-09-22 12:35:34', '2018-08-23 12:35:34', '2018-08-23 12:35:34', 1),
(68, 4, 'Infinity Travels', 'Nuevo León', 'Monterrey', 'info@infinitytravels.com.mx', '8129331864', 'Joel Villareal', '2018-10-27', '2018-10-28', '{\"habitacion cuadruple\":{\"cantidad\":\"13\",\"tarifa\":\"2059.00\"}}', 1, 2, 13, 52, '63291.00', 'dfec71f3295eedc8b320fd6bda6942af31c2d66235537b79cf55de8777977c9c2fbe753f264d43b729d5144529b2ff532c5986d09be32df90214099d35ae2087ea2b3c9012b0bd15235b9dc667076f20478a4b590de8af79f51e121f69365a7b26d96291369c177ee2ee1d4b6afa1168d9e2a6459384ac32d1cc832dffe9a9ee', NULL, 'Evelyn_C-RM-68.pdf', 'CG_5b819eab87545', 'Complete', '2018-09-24 13:23:39', '2018-08-25 13:23:39', '2018-08-25 13:25:16', 3),
(69, 1, 'Travel Managment Company', 'Nuevo León', 'Monterrey', 'marina.herbert@obmtravel.com', '8120640787', 'Marina Herbert', '2018-08-29', '2018-08-31', '{\"habitacion sencilla\":{\"cantidad\":\"10\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"20\",\"tarifa\":\"1092.00\"}}', 2, 3, 30, 50, '179271.00', 'f56655bff1a8921cce464ce5c7e0f3995035f5c94cc948546f37d3c5c32563aac984249dd3fe8b4e84581fecc97d2c6aee234370b3e98bd5a8fec800ef2c7d3a2b88bb9081b76a3dd392f60e8ffd8e28a29a36ec0c65d20ad723b817b8432f9a47023f05501245a105544f77148aff43ecf6e493445faa91c98949bbd012e9b2', NULL, 'Ing. Ignacio_C-RM-69.pdf', 'CG_5b81b18eb4fe6', 'Complete', '2018-09-24 14:44:14', '2018-08-25 14:44:14', '2018-08-25 14:50:56', 3),
(70, 4, 'Scotiabank', 'Nuevo León', 'Monterrey', 'csgarza@scotiabank.com.mx', '8183198801', 'Sarahi De La Garza', '2018-10-22', '2018-10-24', '{\"habitacion doble\":{\"cantidad\":\"100\",\"tarifa\":\"1092.00\"}}', 2, 3, 100, 200, '640624.00', 'dfa1cdbdacff06563de9e2d514e739169940931336a8be141c7755efae50ca0af4a47afa38ef3cfb1723a37929b70426e8266c8a9a65dad1480d3d83b428140dd21eb4305d32fd0b13c4df241d72d5d9f7b469f9daf013a5da72c68fe812607bc5cb23960df2ba47fc58b44374757cde60581f8751924e3de93b9e79aaa8154c', NULL, NULL, 'CG_5b8d8ed893b91', 'Complete', '2018-10-03 14:43:20', '2018-09-03 14:43:20', '2018-09-13 18:10:01', 3),
(71, 3, 'Pepsico', 'Coahuila', 'Saltillo', 'smontes@rincondelmontero.com', '8448934880', 'Daniel Muñiz', '2018-09-03', '2018-09-05', '{\"habitacion doble\":{\"cantidad\":\"30\",\"tarifa\":\"1092.00\"}}', 2, 3, 30, 60, '186520.00', '3c1db4566b30f68b13fef12b1632300dc8838279e6c5f9f7d4bea5f5ab0858e4699fd36378156dafb1f90c6e9578291b1b2184edb212c983e4e09eb4786329b9a81e495e7fce9e088d955fe77ceffbf21d34e2310fab261d8fecb9e56031c7ef3dfa20d4d658c2ccf8f29f86a9d85d29ae9dab9b3b267e798870524ecd2b53c6', 'orden_c-rm-71_05-09-2018.pdf', NULL, 'CG_5b71ef335ef4c', 'Complete', '2018-10-03 15:16:16', '2018-09-03 15:16:16', '2018-09-11 08:41:27', 1),
(72, 3, 'Ieea', 'Coahuila', 'Saltillo', 'zfuentes@inea.gob.mx', '8444386900', 'Lic. Sandra Fuentes', '2018-10-18', '2018-10-19', '{\"habitacion sencilla\":{\"cantidad\":\"40\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"10\",\"tarifa\":\"1092.00\"}}', 1, 2, 50, 60, '123767.00', '8f1466eede205ba0ec01c04194d33ef89f8654392750c743800803a2951c47826455998279d0576d2ee6aef0b4d030a239c985594ce81d26a930a48a12c2ea45f2d6d6046964f988e8976b9acaed3850a1de4f7e24f70be71defbf0457601203fb53e879f5c94031f87f790aa4f5e1e0de057cb4468d76050ebc1d11843bf3ac', NULL, 'Silvia_C-RM-72.pdf', 'CG_5b8e8dd1c06d7', 'Complete', '2018-10-04 08:51:13', '2018-09-04 08:51:13', '2018-09-04 11:26:54', 3),
(73, 2, 'Delphi', 'Coahuila', 'Torreón', 'krystal.ortega.saucedo@delphi.com', '8712066919', 'Krystal Ortega', '2018-09-07', '2018-09-08', '{\"habitacion sencilla\":{\"cantidad\":\"26\",\"tarifa\":\"1471.00\"}}', 1, 2, 26, 26, '66611.00', '01e921fbfb1ac9251892fa85aae8b8eda51d32fdfb45b6989a57b0ecee46810b58ad6d5c9a05ffe2ce5038e2781430e7e8189624cc783b59df05ea1dd7188ac4aabe509fc1835dd126409f2da904f337d8242398fd54c5de79f8c402f47f0ac928af17cbb05062028be4ab216e9f891cb4bf15048fb2a038efaa2e07d93ee0c8', 'orden_c-rm-73_06-09-2018.pdf', NULL, 'CG_5b8ffbee07cfc', 'Complete', '2018-10-05 10:53:18', '2018-09-05 10:53:18', '2018-09-06 09:59:10', 1),
(74, 2, 'Sergio Torres', 'Nuevo León', 'Monterrey', 'sergioarmando.torresmartinez@bayer.com', '8120395228', 'Sergio Torres', '2018-09-01', '2018-09-02', '{\"habitacion doble\":{\"cantidad\":\"10\",\"tarifa\":\"1471.00\"}}', 1, 2, 10, 20, '21258.00', 'f41d228b4284df39e6da3c645777337a3f4ff22a40c3a6451657c1e3ba956bb30aa80cfb61715f8a3b668b0fc380faa980ef3c08033a97b26fbcc46f2de1c23c67e83513cf4b089c49c94ce9c5eb6435ecd9f143f78e1ec1d7ec8794d98997d56fc6641d59cec95326e590d27bd6c8ca445dcb4f2ec1b49ba13d525a2f1f0159', 'orden_c-rm-74_05-09-2018.pdf', NULL, 'CG_5b8ffd5ea5b5e', 'Complete', '2018-10-05 10:59:26', '2018-09-05 10:59:26', '2018-09-05 10:59:26', 1),
(75, 4, 'Pepsico', 'Nuevo León', 'Monterrey', 'evaalejandra.calderongarcia@pepsico.com', '8112556328', 'Eva Calderon', '2018-09-20', '2018-09-22', '[{\"Jueves 20 de Septiembre\":{\"habitacion sencilla\":{\"cantidad\":\"3\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"13\",\"tarifa\":\"1092.00\"}}},{\"Viernes 21 de Septiembre\":{\"habitacion sencilla\":{\"cantidad\":\"1\",\"tarifa\":\"1471.00\"},\"habitacion doble\":{\"cantidad\":\"13\",\"tarifa\":\"1471.00\"}}}]', 2, 3, NULL, NULL, '96403.00', 'ab6ceaedd3e080fe91d6a0455a4ca6485d3150d184c64f9a319197a75cc3cf51048bb8d53774ac6205b1271959efa89cfb95756c7792dfa8300419f603b67e348b0af6720a5563d7c6c30a42b3f27edd423f483211e659636a668fd96e2696e5244e5bf978a83e78827388b501bd6c1a0cf78bde0f86239be2c853dd567f3425', 'orden_c-rm-75_17-09-2018.pdf', 'Evelyn_C-RM-75.pdf', 'CG_5b904dbe39486', 'Special', '2018-10-05 16:42:22', '2018-09-05 16:42:22', '2018-09-18 16:52:38', 1),
(76, 1, 'Grupro Calidra', 'Coahuila', 'Torreón', 'sdelacruz@calidra.com.mx', '8717221322', 'Sara De La Cruz', '2018-10-15', '2018-10-17', '{\"habitacion sencilla\":{\"cantidad\":\"11\",\"tarifa\":\"1092.00\"}}', 2, 3, 11, 11, '44278.00', '696117bddaa25479458d72c3e2c37e0f99a3cfd5ac8e1a37bb393386b3be8f61d0971a019e3a6fac4789f9c0cb1d84c55c02086f69fd2f44903ee841ff4b406cb6f9f7ebbc51e6a2e6340a95e465bf44507afbbb36cb4c6095de4cc235267daa08cbe1cc227b64316422e7ba407782cafb5570ba2028024291021ed265748f83', NULL, 'Ing. Ignacio_C-RM-76.pdf', 'CG_5b91ac352da89', 'Complete', '2018-10-06 17:37:41', '2018-09-06 17:37:41', '2018-09-24 13:59:42', 3),
(77, 1, 'Effem', 'Nuevo León', 'Monterrey', 'maria.onofre@effem.com', '8181243400', 'Maria Guadalupe Onofre R.', '2018-10-11', '2018-10-12', '{\"habitacion doble\":{\"cantidad\":\"20\",\"tarifa\":\"1092.00\"}}', 1, 2, 20, 40, '63129.72', 'a528a6fe7ffadd7cf662dc79caa0e06043778f42f32cda6d4a0b5cc5e14f9b5dc226b2833d071ef43a17e49695b6d1fbae0a4824a703c783eac53041544d7c944a5d96493a47300663fbe41d3a2348922f4daedf684a8cfbe61996b56913922e030b84cade9d3d76f0b495a0313104f98fb7b7f6fdd7205185d722f68e518bcf', NULL, 'Ing. Ignacio_C-RM-77.pdf', 'CG_5b940bd92d511', 'Complete', '2018-10-08 12:50:17', '2018-09-08 12:50:17', '2018-09-14 10:02:13', 3),
(78, 3, 'Infinity Travels', 'Nuevo León', 'Monterrey', 'info@infinitytravels.com.mx', '8129331864', 'Joel Villarreal', '2018-10-27', '2018-10-28', '{\"habitacion doble\":{\"cantidad\":\"23\",\"tarifa\":\"1471.00\"}}', 1, 2, 23, 46, '52635.00', '45829808deb69b74ecc9f5e2c24ea531f1cf0f238d30736fd64de404629adafc2d01b1a82f1f3eafe3a2c58b04f4699fb82f6b1bbdd15308feaf7b77f74c0468317dd49a8821e8440bc32b5e43da0fccd8ae10edce335383e64882b7db3ec13ce77732ece2043b97b8a2e9d15ccc99f6f79480b4c64c39aebf14246e28317af3', NULL, NULL, 'CG_5b819eab87545', 'Complete', '2018-10-10 16:20:00', '2018-09-10 16:20:00', '2018-09-10 16:20:00', 3),
(79, 1, 'Adient', 'Coahuila', 'Saltillo', 'juana.ines.garcia.prado@adient.com', '8449863028', 'Juana I. García Prado', '2018-10-19', '2018-10-20', '{\"habitacion sencilla\":{\"cantidad\":\"1\",\"tarifa\":\"1471.00\"},\"habitacion doble\":{\"cantidad\":\"32\",\"tarifa\":\"1471.00\"}}', 1, 2, 33, 65, '126459.00', '6f8f5550790b8b82d4109a5428fd5b91e009f2845407011665d96d6c7e466d71e81b7ae826b8c7a982f8497c580460ee183801495df50077130066c25cadebd1fd057208573abe486775deb62cd8defe4185b5ccd8ab0d760a9426a12792264c4cbd42eed62844ef0b8c8b7f0484764d87dc11de8a19d361f59dbcb5b17e3bff', NULL, 'Ing. Ignacio_C-RM-79.pdf', 'CG_5b97026e0594b', 'Complete', '2018-10-10 18:46:54', '2018-09-10 18:46:54', '2018-09-10 18:52:39', 3),
(80, 4, 'Or Clinica', 'Nuevo León', 'Montemorelos', 'info@orclinica.com', '8712951853', 'Monserrat Marquez', '2018-11-07', '2018-11-08', '{\"habitacion doble\":{\"cantidad\":\"35\",\"tarifa\":\"1092.00\"}}', 1, 2, 35, 70, '114887.00', '715dd516e2fec4d2c37c2d09bd59d630adfd158804ec2248258d4611fe08f7ab8135c486362e1104c8c254d69105a9d63091bc48bd7eae4e6027e411cdb86ba03867410d95b7b74b7fd0f56b301cb88e2eddd3edab0cd803f3ff844971bc8161e883ac6a636f87efa55b44526d550511f202a972bcacbf32b74e7224d1f261e3', NULL, NULL, 'CG_5b9835a92992f', 'Complete', '2018-10-11 16:37:45', '2018-09-11 16:37:45', '2018-09-11 16:37:45', 3),
(81, 4, 'Pro Futuro', 'Coahuila', 'Torreón', 'alejandromexico50@me.com', '6561731215', 'Alejandro Rodriguez', '2018-11-26', '2018-11-27', '{\"habitacion doble\":{\"cantidad\":\"7\",\"tarifa\":\"1092.00\"}}', 1, 2, 7, 14, '14866.00', '9924353fb3e2dfe963f5f5d1c7f1b8a29fe69f06867a8d533912ccb0e988515d04a7f4fec56280ec4ba17b08f7c6009e780209015efb5e30ac30e5866c36fa544531416085fdcfbd1502702cbd975768ea37083b1cb2f2b24aadcbf88ee2cb217c1f35379d22f70c38ffb5a34fb8da0fa5725fee1c787ab54afbc883971cc51e', NULL, NULL, 'CG_5b98377342959', 'Complete', '2018-10-11 16:45:23', '2018-09-11 16:45:23', '2018-09-11 16:45:23', 3),
(82, 1, 'Prof. En Convenciones - Mead Johnson', 'Distrito Federal', 'Gustavo A. Madero', 'gustavomiranda@proconvenciones.com', '5590003400', 'Gustavo Miranda', '2018-11-30', '2018-12-02', '{\"habitacion sencilla\":{\"cantidad\":\"80\",\"tarifa\":\"1471.00\"},\"habitacion doble\":{\"cantidad\":\"5\",\"tarifa\":\"1471.00\"}}', 2, 3, 85, 90, '420188.00', '64db9c52b2941d74211ed78e6d7ed1bc432bcbc67a0770de3eb09df2b4e3f34ce66a3efdf31994664d45aa3681f8bf04708db9f92d153fdf99213ce47375d1c1656e3e83516bfbb20a07a62842cc5fff5c6b9afafbfc7a5f03ac98aa23595ba85d384d02dd373ff6351be1eeefdd3c5956657c388614641f02467e75483df243', NULL, 'Ing. Ignacio_C-RM-82.pdf', 'CG_5b9851071a835', 'Complete', '2018-10-11 18:34:31', '2018-09-11 18:34:31', '2018-09-14 10:51:45', 3),
(83, 1, 'Radiocare', 'Nuevo León', 'Monterrey', 'administracion@c-corp.mx', '8183638400', 'Rosa Ma. Hernández B.', '2018-11-13', '2018-11-16', '{\"habitacion sencilla\":{\"cantidad\":\"24\",\"tarifa\":\"1092.00\"}}', 3, 4, 24, 24, '141291.00', 'cf47eac10f911e769ec28fda8a8ec61988a1166154d2fcfcfadc958e62a94bef36f2b4f19cd21d1314702bb51df66f05237b94cee9238e1aab6f8f236bb65877ad128a6c95d3614217102dc0ad3551a999bad7910150a48a00b392020240157a10b8a2cd135c69aef1d1fbe717e211d82d0d540ec64a3a1eddf89b0b66bdde26', NULL, 'Ing. Ignacio_C-RM-83.pdf', 'CG_5b99a9f597854', 'Complete', '2018-10-12 19:06:13', '2018-09-12 19:06:13', '2018-09-12 19:08:16', 0),
(84, 1, 'Daimler', 'Coahuila', 'Saltillo', 'brenda.morales@daimler.com', '8449860501', 'Brenda Morales', '2018-11-01', '2018-11-02', '{\"habitacion doble\":{\"cantidad\":\"27\",\"tarifa\":\"1092.00\"}}', 1, 2, 27, 54, '120778.00', '15ecd3b75e55795b3df5fc59704ebf41fab66a1e44a4db2bcbc2a8d6731994cc761e2c7f7052572600f8e6dacefd3b37e06665cc4fc3bf23852bae33af43e9694c29e06928e5320bc5467f7d29c12d19bc58d22a06d70a5655313d0514d02e9ac7af8b9ded7a80f9b63a857acc298c7a18a00728e0df3ca2b36de53c1f21fd22', NULL, 'Ing. Ignacio_C-RM-84.pdf', 'CG_5ba13dd28ffe2', 'Complete', '2018-10-18 13:02:58', '2018-09-18 13:02:58', '2018-09-19 17:35:47', 0),
(85, 2, 'Peñoles', 'Coahuila', 'Torreón', 'wendy_rocha@penoles.com.mx', '8717293421', 'Wendy Rocha', '2018-11-20', '2018-11-23', '{\"habitacion sencilla\":{\"cantidad\":\"70\",\"tarifa\":\"1092.00\"}}', 3, 4, 70, 70, '365232.50', '895c7ce01d5cf7a1688d7e9519fc20b39dec825f363f0fee7392a607f6156708b7e5b454b836f9aa0c0e9faefc00f6b3737110a580cbbf7c6f9ed07aa64a37e43fe6997b9ce28398e01d20c0dd955e8c7b8639ba603a303863612528232c451858fa33c4ec15bd012b98bf1efc995933c319e8948e25bd2ace6f10cd389eab84', NULL, 'Nayeli_C-RM-85.pdf', 'CG_5b71f144985cd', 'Complete', '2018-10-18 13:46:19', '2018-09-18 13:46:19', '2018-09-18 13:46:19', 0);
INSERT INTO `cotizaciones` (`id`, `id_usuario`, `empresa`, `estado`, `municipio`, `correo`, `telefono`, `coordinador`, `fecha_entrada`, `fecha_salida`, `hospedaje`, `noches`, `dias`, `total_rooms`, `huespedes`, `monto`, `token`, `orden`, `file`, `clave`, `tipo`, `vencimiento`, `created_at`, `updated_at`, `state`) VALUES
(86, 2, 'Peñoles', 'Coahuila', 'Torreón', 'wendy_rocha@penoles.com.mx', '8717293421', 'Wendy Rocha', '2018-11-20', '2018-11-23', '{\"habitacion doble\":{\"cantidad\":\"35\",\"tarifa\":\"1092.00\"}}', 3, 4, 35, 70, '266525.00', '0ddbb93607ff083cd7663c8df84b2f3898c0e7e1904835283f9aff775806817796e7ffcbc5591599546835434cc15fc0e4065abe1f5cbf246fde3c879ee67dfc30993c8f7cf9e1213fac9566f2caccdbe369121013d4edbb85628b3a8931714b1e1b1a9961128d544130fe4b6ffc7bedb8e998026d7cf03185f9e13fd3e2ad67', NULL, 'Nayeli_C-RM-86.pdf', 'CG_5b71f144985cd', 'Complete', '2018-10-18 13:48:44', '2018-09-18 13:48:44', '2018-09-30 08:39:50', 0),
(87, 3, 'Colegio Americano', 'Coahuila', 'Torreón', 'montes_sl@hotmail.com', '8712392184', 'Cynthia Sanchez', '2018-09-28', '2018-09-30', '{\"habitacion sencilla\":{\"cantidad\":\"12\",\"tarifa\":\"1471.00\"}}', 2, 3, 12, 12, '52732.12', '88841ae4df8e018dd7aa5984bc38c9f209e1c91e69d0ae3f8f12b995499a729b1e2e2fb89a4cba075c9ea2a835c86a415106dcc895afd5810ab93d4444115492841d1191d15a00c20a4799fe650808ec2b8cae16effb9b51943a70da2809e7bee885a9d12031672b97ed019378862e17a35667972d33c299eedddfb34f9f957a', 'orden_c-rm-87_24-09-2018.pdf', NULL, 'CG_5ba15a0d6b375', 'Complete', '2018-10-18 15:03:25', '2018-09-18 15:03:25', '2018-09-18 15:04:41', 1),
(88, 1, 'Brio Lat', 'Nuevo León', 'Monterrey', 'ari.sanchez@brio.lat', '8121534089', 'Ari De La Paz', '2018-10-08', '2018-10-10', '{\"habitacion sencilla\":{\"cantidad\":\"1\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"27\",\"tarifa\":\"1092.00\"}}', 2, 3, 28, 55, '189426.00', '72c2043989aaa6de70c7e245463ab080284e6c7c08d9eca528f1e90bf156f44336e6599e2b3b097416d398fb50bbdf83e6d9c92c0843a9fd57b66bb0c34fa371023ff6f7e9b616c25a6c0890c156bd4d8c208fb9dc57ad0f304c6b134ab306e7f1961c53a6f894ed1d5df0c21dc4d8945545a85160d0eb6f6f3ddc29a27081b8', NULL, 'Ing. Ignacio_C-RM-88.pdf', 'CG_5ba1875f28956', 'Complete', '2018-10-18 18:16:47', '2018-09-18 18:16:47', '2018-09-18 18:16:47', 0),
(91, 4, 'Daimler', 'Nuevo León', 'Monterrey', 'paloma.garcia@daimler.com', '8183199377', 'Paloma Garcia', '2018-11-22', '2018-11-23', '{\"habitacion doble\":{\"cantidad\":\"3\",\"tarifa\":\"1092.00\"},\"habitacion cuadruple\":{\"cantidad\":\"2\",\"tarifa\":\"1681.00\"}}', 1, 2, 5, 14, '27416.00', '6b19bc477d2a854c9a4a6fc1a4eeb02a12ea6cb64c8fd2952fae0982b032bf7081c6bad2d2cd6530dde8c4c548ee6899d2822f1acdb3f02cb5c4cb7b1f77092f907414ec3f7d064ed6a9bc4adddd65f4a94359a42ce9d450e87712cfc5cbae056a89911e5562bc40be73e8cd597668314b04800613efef2aa335275fd2f5e186', NULL, NULL, 'CG_5ba96114051ce', 'Complete', '2018-10-24 17:11:32', '2018-09-24 17:11:32', '2018-10-04 15:38:03', 0),
(92, 3, 'Tecnologico De San Pedro', 'Coahuila', 'Torreón', 'nayath.pl@gmail.com', '8712360760', 'Lic. Nayath Perez Luna', '2018-10-18', '2018-10-19', '{\"habitacion doble\":{\"cantidad\":\"1\",\"tarifa\":\"1092.00\"},\"habitacion cuadruple\":{\"cantidad\":\"12\",\"tarifa\":\"1681.00\"}}', 1, 2, 13, 50, '38724.00', 'bf673479d5cb4310ad3070e0477a043939cf049217faf9d83727f365f5652c561a533a345406eaef1a709b531362126bc5d72f6a1b8af3c044f6319940b4878a4379a7b4553ee7dd06a6eed89422faa690803b46ed771802af054dab15ef6f440e6a14b379d4334811d36cd287b0200c09cd6bcb25e0220496b38d9574c92fcd', NULL, 'Silvia_C-RM-92.pdf', 'CG_5baa69a8acd4b', 'Complete', '2018-10-25 12:00:24', '2018-09-25 12:00:24', '2018-09-25 12:00:24', 0),
(93, 3, 'Moto Travel', 'Nuevo León', 'Monterrey', 'ventasmototravel@hotmail.com', '8112093166', 'Carlos Espinoza', '2018-11-08', '2018-11-09', '{\"habitacion sencilla\":{\"cantidad\":\"2\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"12\",\"tarifa\":\"1092.00\"}}', 1, 2, 14, 26, '27050.00', '83cd5598113c7a4d5c678e9698da4fffd087f4c3dffeab1b09a5ad7d3ece1394b4ecbff9ebe21b1cf1d644d36a15f92c4517df00239903604469410f9b753489a74e3be544b850df88a77596d444c13b109b774a317eb5fb1b076ba7468fd383c5f3403c56d2494ba1ac9df9480695b2b85eff9a16276f228069194cb4130842', NULL, 'Silvia_C-RM-93.pdf', 'CG_5baaa23b6ef4d', 'Complete', '2018-10-25 16:01:47', '2018-09-25 16:01:47', '2018-09-25 16:01:47', 0),
(94, 3, 'Afirme -fortis', 'Nuevo León', 'Monterrey', 'agomez@phyxius.com.mx', '81831447', 'Adriana Gomez', '2018-10-15', '2018-10-17', '{\"habitacion sencilla\":{\"cantidad\":\"4\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"25\",\"tarifa\":\"1092.00\"},\"habitacion triple\":{\"cantidad\":\"1\",\"tarifa\":\"1387.00\"}}', 2, 3, 30, 57, '164208.00', 'd45d6d7bc4a51973a6a38189b96b13a96b787b0650a5ee223aefd9e9aa2091cc82d76ed7f669cc0cb67294417157b7e3a66884dcc60c5d1dc2b1938cc37e5f6519e8399edcdf1a9b6773220b2990f269068a0c760552caa0815ec79f5ca74afc1498c9ca0fd07602532638fe44b0b41d635d24e7b185a0cde529517b945b1fc1', NULL, 'Silvia_C-RM-94.pdf', 'CG_5b71e6104fdb9', 'Complete', '2018-10-25 16:21:29', '2018-09-25 16:21:29', '2018-09-28 13:00:10', 0),
(95, 3, 'Banorte', 'Nuevo León', 'Monterrey', 'oscar.salinas.quintanilla@banorte.com', '8117646258', 'Oscar Salinas', '2018-12-03', '2018-12-04', '{\"habitacion doble\":{\"cantidad\":\"13\",\"tarifa\":\"1092.00\"}}', 1, 2, 13, 26, '44787.00', 'f11e4d9e5739056fe97f67dc41129b153f2337d0fb3b71ea39849464a735353e25f0cb16a44df3354334cfd92bcc89475042cb49ddab8a17cd77001b085e748df270449ba589d29e8301cd6b5fff34b84db1b43bec3a662851b374362a5f41f635aa4b82e2f58352ee392fa75c95e600f91689b7522d607e4e376395f94da798', NULL, 'Silvia_C-RM-95.pdf', 'CG_5b71e6104fdb9', 'Complete', '2018-10-26 11:45:39', '2018-09-26 11:45:39', '2018-09-26 11:45:39', 0),
(96, 2, 'Ke Elektronik', 'Nuevo León', 'Guadalupe', 'Lorena.Montiel@ke-elektronik.de', '8186025912', 'Lorena Montiel', '2018-10-11', '2018-10-13', '{\"habitacion sencilla\":{\"cantidad\":\"10\",\"tarifa\":\"1281.50\"}}', 2, 3, 10, 10, '43428.00', '07dfd049a8e5e9720916c15892755e53432b5a69dcaff621aa825794663ccf1487e692c04d999f9cda733e9f3428afc167bc1d737110367504284712d8a18a8984674448b5ddcf45c4203928b10ad3ff257d0fcb9dcc8c60b3fe780090fcf62b39d6a94abf83734a41e6e16c3bb8c496e243ca443ef0131c9811fb8522ddc552', NULL, 'Nayeli_C-RM-96.pdf', 'CG_5babdd6b7625c', 'Complete', '2018-10-26 14:26:35', '2018-09-26 14:26:35', '2018-09-26 14:26:35', 0),
(97, 1, 'Hdi  Seguros', 'Nuevo León', 'Monterrey', 'neyra.polo@hdi.com.mx', '8117861919', 'Neyra Polo', '2018-10-18', '2018-10-19', '{\"habitacion sencilla\":{\"cantidad\":\"3\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"6\",\"tarifa\":\"1092.00\"}}', 1, 2, 9, 15, '33241.00', '56753f80f27f6ab984e425c87346c45086e19a0506fa15067e9144f20e4b7142daeb390ec39953fb15134cfd0d69fe2cd6d8e30a39dc34ab1d26efa0b22bcccb330fa77d5eef9ba8026e2d498154c34bcde1b453221cec74891483fd05547d5db9eed94c76fcaa347cf32a6d7deea43b7ccb649744ecd8b1ca1a4f6c8d0dae08', NULL, NULL, 'CG_5bac03333309d', 'Complete', '2018-10-26 17:07:47', '2018-09-26 17:07:47', '2018-09-26 17:22:57', 0),
(98, 1, 'Rotary Int. Youth', 'Coahuila', 'Piedras Negras', 'ricardo_garciarios@hotmail.com', '8787709682', 'Ricardo García Ríos', '2018-09-27', '2018-09-30', '{\"habitacion doble\":{\"cantidad\":\"12\",\"tarifa\":\"1344.67\"},\"habitacion triple\":{\"cantidad\":\"24\",\"tarifa\":\"1639.00\"}}', 3, 4, 36, 96, '301655.00', 'baf85366959ce1f7f221416690b7a61fd7095beb3117d32da6f33b67d575b69bc2b9917748a6cd0b295371aa0816be7f27a786bde0ed1ce8327f763e45e048560e29e9413ef7dece4d1c27e2e2b993abb36568d1fd79abde80588d36726ee1fb4b52a68ae00b3053a5573746da3a1b93b6bcc364e674e961f5a95e17d10a74c9', 'orden_c-rm-98_26-09-2018.pdf', NULL, 'CG_5bac169f0a9b0', 'Complete', '2018-10-26 18:30:39', '2018-09-26 18:30:39', '2018-09-26 18:52:29', 1),
(99, 4, 'Alphabet De Saltillo Sa De Cv', 'Coahuila', 'Saltillo', 'fabiola.hurtado@mssl.motherson.com', '*', 'Fabiola Hurtado', '2018-10-30', '2018-11-02', '{\"habitacion sencilla\":{\"cantidad\":\"12\",\"tarifa\":\"1092.00\"}}', 3, 4, 12, 12, '81709.00', 'c86b63531565b5cac1b140c201b27859a5c9417561fa9359a11ca2abc5b9ccbf01589849d76bfaf9180e01aa355417a27221ae40886ca0d1ba5a1ebf4c9c3fbe93409678bf0bfc6d0c9029c0ea94dc63898ccd2cc80f6adc75bf11771256bdb6d266b7922737c9439528a237776f6df38415a7f3a7099b50c924f0b7cfe04dc6', NULL, NULL, 'CG_5bad1beb42074', 'Complete', '2018-10-27 13:05:31', '2018-09-27 13:05:31', '2018-09-28 12:45:28', 0),
(101, 4, 'Incubadora De Lideres A C', 'Nuevo León', 'Monterrey', 'royalmarmol@yahoo.com.mx', '8182871525', 'Lupita Chapa', '2018-10-06', '2018-10-06', NULL, NULL, 1, NULL, 20, '7143.00', '1d12207ac3f384d36068c1f2dffb45d7992ea0f4293edb4ae41d61110173018a03e5cdfc833310f464832ac1b378baf3f4f17b474a593f0d98b7b6674dfb6220ec26c5b2a7f32d0bc5f0a82cfa02a3861faa1c5501abffd7b81b41d8013273a657bc8150b9ac91767d28dd5cc5458bc93f43fe569650e716399d259f13b587f5', NULL, NULL, 'CG_5bad474d63d1f', 'Service', '2018-10-27 16:10:37', '2018-09-27 16:10:37', '2018-09-27 16:10:37', 0),
(102, 3, 'Alfabet Saltillo', 'Coahuila', 'Saltillo', 'fabbymendoza24@gmail.com', '8441860201', 'Fabiola Hurtado', '2018-10-30', '2018-11-02', '{\"habitacion sencilla\":{\"cantidad\":\"12\",\"tarifa\":\"1092.00\"}}', 3, 4, 12, 12, '79562.00', '68270b1db02c65da57ce70a3e30126a9b9ad3305e05c70886e42622bd0b0c5d3558c46d602f0138d055be0227d9f0f03cf964456a456aae62a55a2fc3bc0fdce37fbb58c191832c9d0a45c59bbe743ac8345d0cca33819cf4e7374faae8284d45aa1735678a2710a92f70e6fc2112fc48ea1fb2579f13cdd653558103ef6146a', NULL, NULL, 'CG_5bad49e6af90c', 'Complete', '2018-10-27 16:21:42', '2018-09-27 16:21:42', '2018-09-27 16:21:42', 0),
(103, 4, 'Avon', 'México', 'Valle De Bravo', 'gabriela.robles@avon.com', '5591384100', 'Gabriela Robles Castañeda', '2019-03-08', '2019-03-10', '{\"habitacion doble\":{\"cantidad\":\"14\",\"tarifa\":\"1471.00\"}}', 2, 3, 14, 28, '70966.00', '1e169a2877512ae87fe125dafdbe733e335e623d525337041d86aa9b54a211860003f18c38f2e2c0831d62a24b72a75f68bc692dee32cc7288884f6d1d4b150a90f418f43f88f7cb41a82aad0ee399fbb32f8a59458d24c2e409c8601562443fc1057500f0af3d71d0aa3ce318a32de8ad02c48bc5587918628d7902074608a0', NULL, NULL, 'CG_5bae999b0c7c2', 'Complete', '2018-10-28 16:14:03', '2018-09-28 16:14:03', '2018-09-28 16:14:03', 0),
(104, 1, 'Corning Optical Communications', 'Tamaulipas', 'Reynosa', 'saldanae@corning.com', '8991604129', 'Erika Saldaña', '2018-10-23', '2018-10-27', '{\"habitacion sencilla\":{\"cantidad\":\"11\",\"tarifa\":\"1186.75\"}}', 4, 5, 11, 11, '89435.00', 'a356c0bf65df3a908fe507054ce2d0deb681b21baf700210bf2963b0f42ae1cab2356d146678cf55c85e3e1b696925502aebac7fcdc5602601b6488357985a5861d163c28dcbaea4457a46a67a3d0d12c589ab767243fb24f5d8cf6673a9023d692fe6735a111047569f5447a4491662eea76fcaf236ab026efd13e6a1e5ef2d', NULL, NULL, 'CG_5baebfd1c1095', 'Complete', '2018-10-28 18:57:05', '2018-09-28 18:57:05', '2018-10-05 13:03:26', 0),
(105, 2, 'Grupo Experto Logisitico Enma', 'Nuevo León', 'Monterrey', 'mnavarro@enma.com.mx', '8122352328', 'Mariana Navarro', '2018-11-30', '2018-12-01', '{\"habitacion sencilla\":{\"cantidad\":\"1\",\"tarifa\":\"1471.00\"},\"habitacion doble\":{\"cantidad\":\"10\",\"tarifa\":\"1471.00\"}}', 1, 2, 11, 21, '39165.00', '367d43c73a193896005ee7b387764138d2675d7786f53dffac58b400600c36916dc2ae60580872d798c932645ca62308929b084fcf01c80f360d19b24143434e6f785a2cea88bd37f87907970d65cfa12a2cc2f5829cdccc6186c47d71a6b3e80b52e2b804f242540a9181f0e4af417dbb39f0720d6c99a3cc9f1bb1d110e276', NULL, 'Nayeli_C-RM-105.pdf', 'CG_5bb27ea51773e', 'Complete', '2018-10-31 15:08:05', '2018-10-01 15:08:05', '2018-10-01 15:08:05', 0),
(106, 2, 'Grupo Experto Logisitico Enma', 'Nuevo León', 'Monterrey', 'mnavarro@enma.com.mx', '8122352328', 'Mariana Navarro', '2018-11-30', '2018-12-01', NULL, NULL, 2, NULL, 21, '22984.00', '89073e85ff4be572c9d5c5abfe257f93b74f3c19f2e7bcb334d69d2b90bc1be464dedb12527b83460c715fc8d98767537ab8d72a1be4a34f1991cd10e3cd591738f2585080e7436c8b82cb6a776e486860c480f8512023cfb97e0dad166e3a809b9b138eb8475d9f058ca46e938ab149ef3d9d8e81113a2fe7d2b9d1de54ccf0', NULL, 'Nayeli_C-RM-106.pdf', 'CG_5bb27ea51773e', 'Service', '2018-10-31 15:10:42', '2018-10-01 15:10:42', '2018-10-01 15:10:42', 0),
(107, 3, 'Hdi Seguros', 'Nuevo León', 'Monterrey', 'ney.polo@hotmail.com', '8117861919', 'Neyra Polo', '2018-10-18', '2018-10-19', '{\"habitacion sencilla\":{\"cantidad\":\"3\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"5\",\"tarifa\":\"1092.00\"}}', 1, 2, 8, 13, '17919.00', 'ce8b74fdfdf9170cd709229efc4fdef65368b74cb68bca0016caefc42f7fb7b5333aacd73c8214d74143eb43708846d5a5f41752e9a1d96c07e3f7708ab982458c82068c31e7d2f487a8a935b3b626328a83c4d4c6a6fe307b45ac1bffc9ad509cad625ffed4f5e78a02a8c4f307bf5a9088168018cc961c10e99bed6fe83169', NULL, 'Silvia_C-RM-107.pdf', 'CG_5bb295dc40c38', 'Complete', '2018-10-31 16:47:08', '2018-10-01 16:47:08', '2018-10-03 16:49:32', 0),
(108, 4, 'Cutting Fluids', 'Chihuahua', 'Chihuahua', 'rh@grupotanner.com', '6144274223', 'Nancy Nañez', '2018-12-05', '2018-12-08', '[{\"Miercoles 5 de Diciembre\":{\"habitacion sencilla\":{\"cantidad\":\"4\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"6\",\"tarifa\":\"1092.00\"}}},{\"Jueves 6 de Diciembre\":{\"habitacion sencilla\":{\"cantidad\":\"13\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"13\",\"tarifa\":\"1092.00\"}}},{\"Viernes 7 de Diciembre\":{\"habitacion sencilla\":{\"cantidad\":\"13\",\"tarifa\":\"1471.00\"},\"habitacion doble\":{\"cantidad\":\"13\",\"tarifa\":\"1471.00\"}}},{\"Sabado 8 de Diciembre\":{\"habitacion sencilla\":{\"cantidad\":\"13\",\"tarifa\":\"1471.00\"},\"habitacion doble\":{\"cantidad\":\"13\",\"tarifa\":\"1471.00\"}}}]', 3, 4, NULL, NULL, '187431.00', '149313d8ab1c3f220a4080a5228a185b1f7ad5afd997739710d4ff5468696b30ce4a72ff441d2fcea948acbb0f0813b0d9c00498be8d0eac93f71ba2454e51c2f56d09371a6b4f58051cde31399751aba44e5dd91c3bcb2c714c22fbccd150fdafe1f83f173e65a8d7a313bff290c1e1bd8ac4321dc4d754def70ef1d9af9d0c', NULL, NULL, 'CG_5bb3b0201ffaf', 'Special', '2018-11-01 12:51:28', '2018-10-02 12:51:28', '2018-10-02 12:51:28', 0),
(109, 2, 'Fiscalia Anticorrupcion', 'Coahuila', 'Saltillo', 'karynafigueroa@hotmail.com', '8444278704', 'Karyna Figueroa', '2018-10-17', '2018-10-19', '[{\"Miercoles 17 de Octubre\":{\"habitacion sencilla\":{\"cantidad\":\"2\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"4\",\"tarifa\":\"1092.00\"}}},{\"Jueves 18 de Octubre\":{\"habitacion sencilla\":{\"cantidad\":\"2\",\"tarifa\":\"1092.00\"},\"habitacion doble\":{\"cantidad\":\"9\",\"tarifa\":\"1092.00\"}}}]', 2, 3, NULL, NULL, '47889.00', '7ef0f4c5b8f0eabcb2d49e2facb5bcd5ca20a67991b4404871bd77011bb2dbae0db316f995f2bf51a7668f1fafc4e5d64f633d208f062b23f32ea1ec372914367a1e7c5f5405366d8aeacf91f96119a301b27c05fbea7eae66c2eaf9f56f24058fce7020dc77c534618f9ae9adf864395662f63ac4ee0737fa7e03bc1286ac37', NULL, 'Nayeli_C-RM-109.pdf', 'CG_5bb3daa59f8e0', 'Special', '2018-11-01 15:52:53', '2018-10-02 15:52:53', '2018-10-02 15:52:53', 0),
(111, 1, 'Motores John Deere', 'Coahuila', 'Torreón', 'mezarodrigodaniel@johndeere.com', '8717055179', 'Rodrigo Meza', '2018-10-23', '2018-10-24', '{\"habitacion sencilla\":{\"cantidad\":\"9\",\"tarifa\":\"1092.00\"}}', 1, 2, 9, 9, '22265.00', '898d81137173868dba2909721ee1dbbf82db29e427da4dff73400b9e637155501aaec8d5a3a96252b11871ce41b226f0452392bb39b3a15fccb6dd301b1a1c4e33045bcc1bc778f22188144a5494566b9d93516208920504284e3d39d119e5a170cef14ee0c3fcf30c95d561c5cd886fa053c9aa42e66b0705b121ac3fad728b', NULL, NULL, 'CG_5bb3f78c3aad6', 'Complete', '2018-11-01 17:56:12', '2018-10-02 17:56:12', '2018-10-02 17:56:12', 0),
(112, 1, 'Ikusi', 'Nuevo León', 'Monterrey', 'leslie@soslogistik.mx', '8110126617', 'Leslie Cobos', '2018-10-25', '2018-10-26', '{\"habitacion doble\":{\"cantidad\":\"8\",\"tarifa\":\"1092.00\"}}', 1, 2, 8, 16, '24502.00', '4bce63fd218e15f66ef73a926a25fb72072d5f49ec85a91dec4db9bb3e2afa3bcf6668e7ccf01a9f29e4613a9c9c6a2741d01377fc1731a184eaf4c6eab7227cf354774f569a7f987258bcb0c6f7ffb2aa6233487933552bc9df0f7e4d46456eeb126cce79df3aa549d464b0bbc195b2f1b141d926fba42b17aa13b8e5eaf81c', NULL, NULL, 'CG_5bb5583a0efbf', 'Complete', '2018-11-02 19:00:58', '2018-10-03 19:00:58', '2018-10-03 19:00:58', 0),
(114, 4, 'Galt Energy Sapi De Cv', 'Nuevo León', 'Monterrey', 'jdiaz@galt.mx', '8116544436', 'Juan Manuel Díaz', '2018-11-28', '2018-11-30', '{\"habitacion doble\":{\"cantidad\":\"29\",\"tarifa\":\"1092.00\"}}', 2, 3, 29, 58, '186888.00', '1670d04e2da5c38455e9a230705d6a3e213ab361413b07c83fec4f578fdb6a0bc073204579db658ccb1830d7e877817df0d46e1004d61f67f2b1c0e46670dd44b27df675aab0907f6d147241bed78bc69d2639dd92913bfddfb1513b14c73375e254368d35e4b2ccaf4dc0b5dd03db590cad658569562cfbf9c968b07638a2db', NULL, NULL, 'CG_5bb7b74838067', 'Complete', '2018-11-04 14:11:04', '2018-10-05 14:11:04', '2018-10-05 14:11:04', 0);

--
-- Disparadores `cotizaciones`
--
DELIMITER $$
CREATE TRIGGER `delete_services_extras` AFTER DELETE ON `cotizaciones` FOR EACH ROW BEGIN
DELETE FROM cotizacion_dia WHERE id_empresa = OLD.id;
DELETE FROM extras WHERE id_empresa = OLD.id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_groups_after` AFTER INSERT ON `cotizaciones` FOR EACH ROW BEGIN
UPDATE grupos as g SET `num_cotizaciones`=(SELECT COUNT(*) FROM `cotizaciones` as c WHERE c.clave = g.clave ),               		`ingresos`=(SELECT SUM(monto) FROM `cotizaciones` as c WHERE c.clave = g.clave)  WHERE g.clave = NEW.clave;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_groups_after_update` AFTER UPDATE ON `cotizaciones` FOR EACH ROW BEGIN
UPDATE grupos as g SET `num_cotizaciones`=(SELECT COUNT(*) FROM `cotizaciones` as c WHERE c.clave = g.clave ),               		`ingresos`=(SELECT SUM(monto) FROM `cotizaciones` as c WHERE c.clave = g.clave)  WHERE g.clave = NEW.clave;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cotizacion_dia`
--

CREATE TABLE `cotizacion_dia` (
  `id` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `dia` varchar(100) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `servicio` varchar(100) DEFAULT NULL,
  `precio` decimal(11,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `state` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cotizacion_dia`
--

INSERT INTO `cotizacion_dia` (`id`, `id_empresa`, `dia`, `id_servicio`, `servicio`, `precio`, `cantidad`, `state`) VALUES
(1, 1, 'Jueves 5 de Julio', 5, 'Comida 3 Tiempos', '293.65', 25, 1),
(2, 1, 'Jueves 5 de Julio', 14, 'Cena Parrillada', '357.14', 25, 1),
(3, 1, 'Jueves 5 de Julio', 19, 'Medio Dia Coffe Break', '95.24', 25, 1),
(4, 1, 'Jueves 5 de Julio', 24, 'Infocus', '1289.68', 1, 1),
(5, 1, 'Viernes 6 de Julio', 1, 'Desayuno', '158.73', 25, 1),
(6, 2, 'Lunes 20 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 22, 1),
(7, 2, 'Lunes 20 de Agosto', 13, 'Cena 3 Tiempos', '293.65', 22, 1),
(8, 2, 'Lunes 20 de Agosto', 19, 'Medio Dia Coffe Break', '95.24', 22, 1),
(9, 2, 'Lunes 20 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(10, 2, 'Martes 21 de Agosto', 1, 'Desayuno', '158.73', 22, 1),
(11, 2, 'Martes 21 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 22, 1),
(12, 2, 'Martes 21 de Agosto', 14, 'Cena Parrillada', '357.14', 22, 1),
(13, 2, 'Martes 21 de Agosto', 20, 'Dia Completo Coffe Break', '190.48', 22, 1),
(14, 2, 'Martes 21 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(15, 2, 'Miercoles 22 de Agosto', 1, 'Desayuno', '158.73', 22, 1),
(16, 2, 'Miercoles 22 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 22, 1),
(17, 2, 'Miercoles 22 de Agosto', 19, 'Medio Dia Coffe Break', '95.24', 22, 1),
(18, 2, 'Miercoles 22 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(19, 3, 'Viernes 9 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 70, 1),
(20, 3, 'Viernes 9 de Noviembre', 13, 'Cena 3 Tiempos', '293.65', 70, 1),
(21, 3, 'Viernes 9 de Noviembre', 19, 'Medio Dia Coffe Break', '95.24', 70, 1),
(22, 3, 'Viernes 9 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(23, 3, 'Sabado 10 de Noviembre', 1, 'Desayuno', '158.73', 70, 1),
(24, 3, 'Sabado 10 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 70, 1),
(25, 3, 'Sabado 10 de Noviembre', 14, 'Cena Parrillada', '357.14', 70, 1),
(26, 3, 'Sabado 10 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 70, 1),
(27, 3, 'Sabado 10 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(28, 3, 'Domingo 11 de Noviembre', 1, 'Desayuno', '158.73', 70, 1),
(29, 3, 'Domingo 11 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 70, 1),
(30, 3, 'Domingo 11 de Noviembre', 19, 'Medio Dia Coffe Break', '95.24', 70, 1),
(31, 3, 'Domingo 11 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(36, 5, 'Sabado 6 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 250, 1),
(37, 5, 'Sabado 6 de Octubre', 19, 'Medio Dia Coffe Break', '95.24', 250, 1),
(38, 5, 'Sabado 6 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(39, 6, 'Viernes 14 de Septiembre', 13, 'Cena 3 Tiempos', '293.65', 200, 1),
(40, 6, 'Sabado 15 de Septiembre', 2, 'Desayuno Buffet', '174.60', 200, 1),
(41, 6, 'Sabado 15 de Septiembre', 7, 'Comida Buffet', '234.13', 200, 1),
(42, 6, 'Sabado 15 de Septiembre', 14, 'Cena Parrillada', '357.14', 200, 1),
(43, 6, 'Sabado 15 de Septiembre', 20, 'Dia Completo Coffe Break', '190.48', 200, 1),
(44, 6, 'Sabado 15 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(45, 6, 'Sabado 15 de Septiembre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(46, 6, 'Sabado 15 de Septiembre', 26, 'Microfono Adicional', '317.46', 1, 1),
(47, 6, 'Domingo 16 de Septiembre', 1, 'Desayuno', '158.73', 200, 1),
(48, 7, 'Miercoles 26 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 9, 1),
(49, 7, 'Miercoles 26 de Septiembre', 13, 'Cena 3 Tiempos', '293.65', 9, 1),
(50, 7, 'Miercoles 26 de Septiembre', 19, 'Medio Dia Coffe Break', '95.24', 9, 1),
(51, 7, 'Miercoles 26 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(52, 7, 'Jueves 27 de Septiembre', 1, 'Desayuno', '158.73', 9, 1),
(53, 7, 'Jueves 27 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 9, 1),
(54, 7, 'Jueves 27 de Septiembre', 20, 'Dia Completo Coffe Break', '190.48', 9, 1),
(55, 7, 'Jueves 27 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(56, 8, 'Viernes 31 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 12, 1),
(57, 8, 'Viernes 31 de Agosto', 13, 'Cena 3 Tiempos', '293.65', 12, 1),
(58, 8, 'Viernes 31 de Agosto', 19, 'Medio Dia Coffe Break', '95.24', 12, 1),
(59, 8, 'Viernes 31 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(60, 8, 'Sabado 1 de Septiembre', 1, 'Desayuno', '158.73', 12, 1),
(61, 8, 'Sabado 1 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 12, 1),
(62, 8, 'Sabado 1 de Septiembre', 14, 'Cena Parrillada', '357.14', 12, 1),
(63, 8, 'Domingo 2 de Septiembre', 1, 'Desayuno', '158.73', 12, 1),
(64, 9, 'Martes 21 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 10, 1),
(65, 9, 'Martes 21 de Agosto', 13, 'Cena 3 Tiempos', '293.65', 10, 1),
(66, 9, 'Miercoles 22 de Agosto', 1, 'Desayuno', '158.73', 10, 1),
(67, 9, 'Miercoles 22 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 10, 1),
(68, 9, 'Miercoles 22 de Agosto', 13, 'Cena 3 Tiempos', '293.65', 10, 1),
(69, 9, 'Miercoles 22 de Agosto', 20, 'Dia Completo Coffe Break', '190.48', 10, 1),
(70, 9, 'Miercoles 22 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(71, 9, 'Jueves 23 de Agosto', 1, 'Desayuno', '158.73', 10, 1),
(72, 9, 'Jueves 23 de Agosto', 19, 'Medio Dia Coffe Break', '95.24', 10, 1),
(73, 9, 'Jueves 23 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(79, 11, 'Miercoles 15 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 9, 1),
(80, 11, 'Miercoles 15 de Agosto', 14, 'Cena Parrillada', '357.14', 9, 1),
(81, 11, 'Miercoles 15 de Agosto', 19, 'Medio Dia Coffe Break', '95.24', 9, 1),
(82, 11, 'Miercoles 15 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(83, 11, 'Jueves 16 de Agosto', 1, 'Desayuno', '158.73', 9, 1),
(84, 11, 'Jueves 16 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 9, 1),
(85, 11, 'Jueves 16 de Agosto', 20, 'Dia Completo Coffe Break', '190.48', 9, 1),
(86, 11, 'Jueves 16 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(87, 12, 'Miercoles 15 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 9, 1),
(88, 12, 'Miercoles 15 de Agosto', 14, 'Cena Parrillada', '357.14', 9, 1),
(89, 12, 'Miercoles 15 de Agosto', 19, 'Medio Dia Coffe Break', '95.24', 9, 1),
(90, 12, 'Miercoles 15 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(91, 12, 'Jueves 16 de Agosto', 1, 'Desayuno', '158.73', 9, 1),
(92, 12, 'Jueves 16 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 9, 1),
(93, 12, 'Jueves 16 de Agosto', 20, 'Dia Completo Coffe Break', '190.48', 9, 1),
(94, 12, 'Jueves 16 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(95, 13, 'Jueves 16 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 30, 1),
(96, 13, 'Jueves 16 de Agosto', 13, 'Cena 3 Tiempos', '293.65', 60, 1),
(97, 13, 'Viernes 17 de Agosto', 1, 'Desayuno', '158.73', 60, 1),
(98, 13, 'Viernes 17 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 60, 1),
(99, 13, 'Viernes 17 de Agosto', 14, 'Cena Parrillada', '357.14', 60, 1),
(100, 13, 'Viernes 17 de Agosto', 20, 'Dia Completo Coffe Break', '190.48', 60, 1),
(101, 13, 'Viernes 17 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(102, 13, 'Sabado 18 de Agosto', 1, 'Desayuno', '158.73', 60, 1),
(103, 13, 'Sabado 18 de Agosto', 19, 'Medio Dia Coffe Break', '95.24', 60, 1),
(104, 13, 'Sabado 18 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(105, 13, 'Sabado 18 de Agosto', 22, 'Box Lunch Op. 1', '123.02', 60, 1),
(106, 14, 'Lunes 5 de Noviembre', 1, 'Desayuno', '158.73', 4, 1),
(107, 14, 'Lunes 5 de Noviembre', 7, 'Comida Buffet', '234.13', 104, 1),
(108, 14, 'Lunes 5 de Noviembre', 15, 'Cena Buffet', '234.13', 104, 1),
(109, 14, 'Lunes 5 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 104, 1),
(110, 14, 'Lunes 5 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(111, 14, 'Lunes 5 de Noviembre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(112, 14, 'Martes 6 de Noviembre', 2, 'Desayuno Buffet', '174.60', 104, 1),
(113, 14, 'Martes 6 de Noviembre', 7, 'Comida Buffet', '234.13', 104, 1),
(114, 14, 'Martes 6 de Noviembre', 14, 'Cena Parrillada', '357.14', 104, 1),
(115, 14, 'Martes 6 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 104, 1),
(116, 14, 'Martes 6 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(117, 14, 'Martes 6 de Noviembre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(118, 14, 'Miercoles 7 de Noviembre', 2, 'Desayuno Buffet', '174.60', 104, 1),
(119, 15, 'Miercoles 12 de Septiembre', 13, 'Cena 3 Tiempos', '293.65', 30, 1),
(120, 15, 'Jueves 13 de Septiembre', 1, 'Desayuno', '158.73', 30, 1),
(121, 15, 'Jueves 13 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 30, 1),
(122, 15, 'Jueves 13 de Septiembre', 13, 'Cena 3 Tiempos', '293.65', 30, 1),
(123, 15, 'Jueves 13 de Septiembre', 19, 'Medio Dia Coffe Break', '95.24', 30, 1),
(124, 15, 'Jueves 13 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(125, 15, 'Viernes 14 de Septiembre', 1, 'Desayuno', '158.73', 30, 1),
(126, 15, 'Viernes 14 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 30, 1),
(127, 15, 'Viernes 14 de Septiembre', 13, 'Cena 3 Tiempos', '293.65', 30, 1),
(128, 15, 'Sabado 15 de Septiembre', 1, 'Desayuno', '158.73', 30, 1),
(129, 16, 'Miercoles 5 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 35, 1),
(130, 16, 'Miercoles 5 de Septiembre', 13, 'Cena 3 Tiempos', '293.65', 35, 1),
(131, 16, 'Miercoles 5 de Septiembre', 20, 'Dia Completo Coffe Break', '190.48', 35, 1),
(132, 16, 'Miercoles 5 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(133, 16, 'Jueves 6 de Septiembre', 1, 'Desayuno', '158.73', 35, 1),
(134, 16, 'Jueves 6 de Septiembre', 20, 'Dia Completo Coffe Break', '190.48', 35, 1),
(135, 16, 'Jueves 6 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(136, 16, 'Jueves 6 de Septiembre', 22, 'Box Lunch Op. 1', '123.02', 35, 1),
(137, 17, 'Viernes 31 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 38, 1),
(138, 17, 'Viernes 31 de Agosto', 14, 'Cena Parrillada', '357.14', 38, 1),
(139, 17, 'Sabado 1 de Septiembre', 1, 'Desayuno', '158.73', 38, 1),
(140, 17, 'Sabado 1 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 38, 1),
(141, 17, 'Sabado 1 de Septiembre', 19, 'Medio Dia Coffe Break', '95.24', 38, 1),
(142, 17, 'Sabado 1 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(143, 18, 'Martes 21 de Agosto', 7, 'Comida Buffet', '234.13', 55, 1),
(144, 18, 'Martes 21 de Agosto', 15, 'Cena Buffet', '234.13', 55, 1),
(145, 18, 'Martes 21 de Agosto', 19, 'Medio Dia Coffe Break', '95.24', 55, 1),
(146, 18, 'Martes 21 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(147, 18, 'Martes 21 de Agosto', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(148, 18, 'Martes 21 de Agosto', 26, 'Microfono Adicional', '317.46', 1, 1),
(149, 18, 'Miercoles 22 de Agosto', 1, 'Desayuno', '158.73', 55, 1),
(150, 18, 'Miercoles 22 de Agosto', 7, 'Comida Buffet', '234.13', 55, 1),
(151, 18, 'Miercoles 22 de Agosto', 15, 'Cena Buffet', '234.13', 55, 1),
(152, 18, 'Miercoles 22 de Agosto', 20, 'Dia Completo Coffe Break', '190.48', 55, 1),
(153, 18, 'Miercoles 22 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(154, 18, 'Miercoles 22 de Agosto', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(155, 18, 'Miercoles 22 de Agosto', 26, 'Microfono Adicional', '317.46', 1, 1),
(156, 18, 'Jueves 23 de Agosto', 2, 'Desayuno Buffet', '174.60', 55, 1),
(157, 18, 'Jueves 23 de Agosto', 7, 'Comida Buffet', '234.13', 55, 1),
(158, 18, 'Jueves 23 de Agosto', 14, 'Cena Parrillada', '357.14', 55, 1),
(159, 18, 'Jueves 23 de Agosto', 20, 'Dia Completo Coffe Break', '190.48', 55, 1),
(160, 18, 'Jueves 23 de Agosto', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(161, 18, 'Jueves 23 de Agosto', 26, 'Microfono Adicional', '317.46', 1, 1),
(162, 18, 'Viernes 24 de Agosto', 2, 'Desayuno Buffet', '174.60', 55, 1),
(177, 20, 'Miercoles 10 de Octubre', 2, 'Desayuno Buffet', '174.60', 80, 1),
(178, 20, 'Miercoles 10 de Octubre', 7, 'Comida Buffet', '234.13', 80, 1),
(179, 20, 'Miercoles 10 de Octubre', 14, 'Cena Parrillada', '357.14', 80, 1),
(180, 20, 'Miercoles 10 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 80, 1),
(181, 20, 'Miercoles 10 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(182, 20, 'Miercoles 10 de Octubre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(183, 20, 'Jueves 11 de Octubre', 2, 'Desayuno Buffet', '174.60', 80, 1),
(184, 20, 'Jueves 11 de Octubre', 7, 'Comida Buffet', '234.13', 80, 1),
(185, 20, 'Jueves 11 de Octubre', 19, 'Medio Dia Coffe Break', '95.24', 80, 1),
(186, 20, 'Jueves 11 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(187, 20, 'Jueves 11 de Octubre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(188, 21, 'Lunes 23 de Julio', 5, 'Comida 3 Tiempos', '293.65', 60, 1),
(189, 21, 'Lunes 23 de Julio', 13, 'Cena 3 Tiempos', '293.65', 60, 1),
(190, 21, 'Lunes 23 de Julio', 20, 'Dia Completo Coffe Break', '190.48', 60, 1),
(191, 21, 'Lunes 23 de Julio', 24, 'Infocus', '1289.68', 1, 1),
(192, 21, 'Martes 24 de Julio', 1, 'Desayuno', '158.73', 60, 1),
(193, 21, 'Martes 24 de Julio', 5, 'Comida 3 Tiempos', '293.65', 60, 1),
(194, 21, 'Martes 24 de Julio', 14, 'Cena Parrillada', '357.14', 60, 1),
(195, 21, 'Martes 24 de Julio', 20, 'Dia Completo Coffe Break', '190.48', 60, 1),
(196, 21, 'Martes 24 de Julio', 24, 'Infocus', '1289.68', 1, 1),
(197, 21, 'Miercoles 25 de Julio', 1, 'Desayuno', '158.73', 60, 1),
(198, 21, 'Miercoles 25 de Julio', 20, 'Dia Completo Coffe Break', '190.48', 60, 1),
(199, 21, 'Miercoles 25 de Julio', 24, 'Infocus', '1289.68', 1, 1),
(200, 22, 'Viernes 18 de Enero', 17, 'Cena Buffet Mexicano O Taquiza', '309.52', 200, 1),
(201, 22, 'Sabado 19 de Enero', 2, 'Desayuno Buffet', '174.60', 200, 1),
(202, 22, 'Sabado 19 de Enero', 7, 'Comida Buffet', '234.13', 200, 1),
(203, 22, 'Sabado 19 de Enero', 16, 'Cena Buffet Norteño', '416.67', 200, 1),
(204, 22, 'Sabado 19 de Enero', 20, 'Dia Completo Coffe Break', '190.48', 200, 1),
(205, 22, 'Sabado 19 de Enero', 24, 'Infocus', '1289.68', 1, 1),
(206, 22, 'Domingo 20 de Enero', 2, 'Desayuno Buffet', '174.60', 200, 1),
(207, 22, 'Domingo 20 de Enero', 7, 'Comida Buffet', '234.13', 200, 1),
(208, 22, 'Domingo 20 de Enero', 14, 'Cena Parrillada', '357.14', 200, 1),
(209, 22, 'Domingo 20 de Enero', 20, 'Dia Completo Coffe Break', '190.48', 200, 1),
(210, 22, 'Domingo 20 de Enero', 24, 'Infocus', '1289.68', 1, 1),
(211, 22, 'Lunes 21 de Enero', 2, 'Desayuno Buffet', '174.60', 200, 1),
(212, 23, 'Viernes 14 de Septiembre', 15, 'Cena Buffet', '234.13', 100, 1),
(213, 23, 'Viernes 14 de Septiembre', 19, 'Medio Dia Coffe Break', '95.24', 100, 1),
(214, 23, 'Viernes 14 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(215, 23, 'Sabado 15 de Septiembre', 2, 'Desayuno Buffet', '174.60', 100, 1),
(216, 23, 'Sabado 15 de Septiembre', 7, 'Comida Buffet', '234.13', 100, 1),
(217, 23, 'Sabado 15 de Septiembre', 20, 'Dia Completo Coffe Break', '190.48', 100, 1),
(218, 23, 'Sabado 15 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(219, 24, 'Miercoles 18 de Julio', 1, 'Desayuno', '158.73', 24, 1),
(220, 25, 'Viernes 29 de Junio', 5, 'Comida 3 Tiempos', '293.65', 18, 1),
(221, 25, 'Viernes 29 de Junio', 14, 'Cena Parrillada', '357.14', 18, 1),
(222, 25, 'Viernes 29 de Junio', 19, 'Medio Dia Coffe Break', '95.24', 18, 1),
(223, 25, 'Sabado 30 de Junio', 1, 'Desayuno', '158.73', 18, 1),
(224, 25, 'Sabado 30 de Junio', 19, 'Medio Dia Coffe Break', '95.24', 18, 1),
(225, 26, 'Martes 9 de Octubre', 16, 'Cena Buffet Norteño', '416.67', 50, 1),
(226, 26, 'Miercoles 10 de Octubre', 2, 'Desayuno Buffet', '174.60', 50, 1),
(227, 26, 'Miercoles 10 de Octubre', 9, 'Comida Buffet Mexicano O Taquiza', '309.52', 50, 1),
(228, 26, 'Jueves 11 de Octubre', 2, 'Desayuno Buffet', '174.60', 50, 1),
(229, 27, 'Miercoles 11 de Julio', 1, 'Desayuno', '158.73', 14, 1),
(230, 27, 'Miercoles 11 de Julio', 5, 'Comida 3 Tiempos', '293.65', 14, 1),
(231, 27, 'Miercoles 11 de Julio', 13, 'Cena 3 Tiempos', '293.65', 14, 1),
(232, 27, 'Miercoles 11 de Julio', 20, 'Dia Completo Coffe Break', '190.48', 14, 1),
(233, 27, 'Miercoles 11 de Julio', 24, 'Infocus', '1289.68', 1, 1),
(234, 27, 'Jueves 12 de Julio', 1, 'Desayuno', '158.73', 14, 1),
(235, 27, 'Jueves 12 de Julio', 5, 'Comida 3 Tiempos', '293.65', 14, 1),
(236, 28, 'Jueves 5 de Julio', 3, 'Comida Sencilla', '186.51', 50, 1),
(237, 28, 'Jueves 5 de Julio', 11, 'Cena Sencilla', '186.51', 50, 1),
(238, 28, 'Jueves 5 de Julio', 20, 'Dia Completo Coffe Break', '190.48', 50, 1),
(239, 28, 'Viernes 6 de Julio', 1, 'Desayuno', '158.73', 50, 1),
(240, 29, 'Viernes 20 de Julio', 5, 'Comida 3 Tiempos', '293.65', 35, 1),
(241, 29, 'Viernes 20 de Julio', 14, 'Cena Parrillada', '357.14', 35, 1),
(242, 29, 'Viernes 20 de Julio', 20, 'Dia Completo Coffe Break', '190.48', 35, 1),
(243, 29, 'Viernes 20 de Julio', 24, 'Infocus', '1289.68', 1, 1),
(244, 29, 'Sabado 21 de Julio', 1, 'Desayuno', '158.73', 35, 1),
(245, 29, 'Sabado 21 de Julio', 5, 'Comida 3 Tiempos', '293.65', 35, 1),
(246, 29, 'Sabado 21 de Julio', 19, 'Medio Dia Coffe Break', '95.24', 35, 1),
(247, 29, 'Sabado 21 de Julio', 24, 'Infocus', '1289.68', 1, 1),
(258, 31, 'Jueves 12 de Julio', 5, 'Comida 3 Tiempos', '293.65', 12, 1),
(259, 31, 'Jueves 12 de Julio', 13, 'Cena 3 Tiempos', '293.65', 12, 1),
(260, 31, 'Jueves 12 de Julio', 20, 'Dia Completo Coffe Break', '190.48', 12, 1),
(261, 31, 'Jueves 12 de Julio', 24, 'Infocus', '1289.68', 1, 1),
(262, 31, 'Viernes 13 de Julio', 1, 'Desayuno', '158.73', 12, 1),
(263, 32, 'Martes 14 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 25, 1),
(264, 32, 'Martes 14 de Agosto', 13, 'Cena 3 Tiempos', '293.65', 25, 1),
(265, 32, 'Martes 14 de Agosto', 20, 'Dia Completo Coffe Break', '190.48', 25, 1),
(266, 32, 'Martes 14 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(267, 32, 'Miercoles 15 de Agosto', 1, 'Desayuno', '158.73', 25, 1),
(268, 32, 'Miercoles 15 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 25, 1),
(269, 32, 'Miercoles 15 de Agosto', 14, 'Cena Parrillada', '357.14', 25, 1),
(270, 32, 'Miercoles 15 de Agosto', 20, 'Dia Completo Coffe Break', '190.48', 25, 1),
(271, 32, 'Miercoles 15 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(272, 32, 'Jueves 16 de Agosto', 1, 'Desayuno', '158.73', 25, 1),
(273, 32, 'Jueves 16 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 25, 1),
(274, 32, 'Jueves 16 de Agosto', 19, 'Medio Dia Coffe Break', '95.24', 25, 1),
(275, 33, 'Lunes 30 de Julio', 1, 'Desayuno', '158.73', 12, 1),
(276, 33, 'Lunes 30 de Julio', 5, 'Comida 3 Tiempos', '293.65', 12, 1),
(277, 33, 'Lunes 30 de Julio', 14, 'Cena Parrillada', '357.14', 12, 1),
(278, 33, 'Lunes 30 de Julio', 20, 'Dia Completo Coffe Break', '190.48', 12, 1),
(279, 33, 'Lunes 30 de Julio', 24, 'Infocus', '1289.68', 1, 1),
(280, 33, 'Martes 31 de Julio', 1, 'Desayuno', '158.73', 12, 1),
(281, 33, 'Martes 31 de Julio', 19, 'Medio Dia Coffe Break', '95.24', 12, 1),
(291, 35, 'Lunes 30 de Julio', 5, 'Comida 3 Tiempos', '293.65', 40, 1),
(292, 36, 'Viernes 8 de Marzo', 5, 'Comida 3 Tiempos', '293.65', 50, 1),
(293, 36, 'Viernes 8 de Marzo', 13, 'Cena 3 Tiempos', '293.65', 50, 1),
(294, 36, 'Sabado 9 de Marzo', 1, 'Desayuno', '158.73', 50, 1),
(295, 36, 'Sabado 9 de Marzo', 5, 'Comida 3 Tiempos', '293.65', 50, 1),
(296, 36, 'Sabado 9 de Marzo', 14, 'Cena Parrillada', '357.14', 50, 1),
(297, 36, 'Domingo 10 de Marzo', 1, 'Desayuno', '158.73', 50, 1),
(298, 36, 'Domingo 10 de Marzo', 5, 'Comida 3 Tiempos', '293.65', 50, 1),
(324, 39, 'Viernes 30 de Noviembre', 13, 'Cena 3 Tiempos', '293.65', 40, 1),
(325, 39, 'Sabado 1 de Diciembre', 1, 'Desayuno', '158.73', 40, 1),
(326, 39, 'Sabado 1 de Diciembre', 5, 'Comida 3 Tiempos', '293.65', 40, 1),
(327, 39, 'Sabado 1 de Diciembre', 13, 'Cena 3 Tiempos', '293.65', 40, 1),
(328, 39, 'Sabado 1 de Diciembre', 20, 'Dia Completo Coffe Break', '190.48', 40, 1),
(329, 39, 'Domingo 2 de Diciembre', 1, 'Desayuno', '158.73', 40, 1),
(330, 39, 'Domingo 2 de Diciembre', 5, 'Comida 3 Tiempos', '293.65', 40, 1),
(331, 40, 'Sabado 13 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 30, 1),
(332, 40, 'Sabado 13 de Octubre', 13, 'Cena 3 Tiempos', '293.65', 30, 1),
(333, 40, 'Sabado 13 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 30, 1),
(334, 40, 'Sabado 13 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(335, 40, 'Domingo 14 de Octubre', 1, 'Desayuno', '158.73', 30, 1),
(336, 40, 'Domingo 14 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 30, 1),
(337, 40, 'Domingo 14 de Octubre', 19, 'Medio Dia Coffe Break', '95.24', 30, 1),
(338, 40, 'Domingo 14 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(339, 41, 'Miercoles 5 de Septiembre', 19, 'Medio Dia Coffe Break', '95.24', 10, 1),
(340, 41, 'Miercoles 5 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(341, 41, 'Jueves 6 de Septiembre', 19, 'Medio Dia Coffe Break', '95.24', 10, 1),
(342, 41, 'Jueves 6 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(343, 42, 'Martes 28 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 11, 1),
(344, 42, 'Martes 28 de Agosto', 13, 'Cena 3 Tiempos', '293.65', 11, 1),
(345, 42, 'Martes 28 de Agosto', 19, 'Medio Dia Coffe Break', '95.24', 11, 1),
(346, 42, 'Martes 28 de Agosto', 21, 'Servicios Adicionales', '83.33', 11, 1),
(347, 42, 'Martes 28 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(348, 42, 'Miercoles 29 de Agosto', 1, 'Desayuno', '158.73', 11, 1),
(349, 42, 'Miercoles 29 de Agosto', 19, 'Medio Dia Coffe Break', '95.24', 11, 1),
(350, 42, 'Miercoles 29 de Agosto', 21, 'Servicios Adicionales', '83.33', 11, 1),
(351, 42, 'Miercoles 29 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(352, 42, 'Jueves 30 de Agosto', 1, 'Desayuno', '158.73', 11, 1),
(353, 42, 'Jueves 30 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 11, 1),
(354, 42, 'Jueves 30 de Agosto', 19, 'Medio Dia Coffe Break', '95.24', 11, 1),
(355, 42, 'Jueves 30 de Agosto', 21, 'Servicios Adicionales', '83.33', 11, 1),
(356, 42, 'Jueves 30 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(357, 43, 'Miercoles 29 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 20, 1),
(358, 43, 'Miercoles 29 de Agosto', 13, 'Cena 3 Tiempos', '293.65', 20, 1),
(359, 43, 'Miercoles 29 de Agosto', 20, 'Dia Completo Coffe Break', '190.48', 20, 1),
(360, 43, 'Miercoles 29 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(361, 43, 'Jueves 30 de Agosto', 1, 'Desayuno', '158.73', 20, 1),
(362, 44, 'Jueves 15 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 14, 1),
(363, 44, 'Jueves 15 de Noviembre', 13, 'Cena 3 Tiempos', '293.65', 14, 1),
(364, 44, 'Jueves 15 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 14, 1),
(365, 44, 'Jueves 15 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(366, 44, 'Jueves 15 de Noviembre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(367, 44, 'Viernes 16 de Noviembre', 1, 'Desayuno', '158.73', 14, 1),
(368, 44, 'Viernes 16 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 14, 1),
(369, 44, 'Viernes 16 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(370, 44, 'Viernes 16 de Noviembre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(371, 45, 'Lunes 1 de Octubre', 13, 'Cena 3 Tiempos', '293.65', 70, 1),
(372, 45, 'Martes 2 de Octubre', 1, 'Desayuno', '158.73', 70, 1),
(373, 45, 'Martes 2 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 70, 1),
(374, 45, 'Martes 2 de Octubre', 14, 'Cena Parrillada', '357.14', 70, 1),
(375, 45, 'Martes 2 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 70, 1),
(376, 45, 'Martes 2 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(377, 45, 'Martes 2 de Octubre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(378, 45, 'Miercoles 3 de Octubre', 1, 'Desayuno', '158.73', 70, 1),
(379, 45, 'Miercoles 3 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 70, 1),
(380, 45, 'Miercoles 3 de Octubre', 13, 'Cena 3 Tiempos', '293.65', 70, 1),
(381, 45, 'Miercoles 3 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 70, 1),
(382, 45, 'Miercoles 3 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(383, 45, 'Jueves 4 de Octubre', 1, 'Desayuno', '158.73', 70, 1),
(384, 45, 'Jueves 4 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 70, 1),
(385, 45, 'Jueves 4 de Octubre', 13, 'Cena 3 Tiempos', '293.65', 70, 1),
(386, 45, 'Jueves 4 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 70, 1),
(387, 45, 'Jueves 4 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(388, 45, 'Jueves 4 de Octubre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(389, 45, 'Viernes 5 de Octubre', 1, 'Desayuno', '158.73', 70, 1),
(418, 49, 'Viernes 26 de Octubre', 1, 'Desayuno', '158.73', 30, 1),
(419, 49, 'Viernes 26 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 30, 1),
(420, 49, 'Viernes 26 de Octubre', 13, 'Cena 3 Tiempos', '293.65', 30, 1),
(421, 49, 'Sabado 27 de Octubre', 1, 'Desayuno', '158.73', 30, 1),
(422, 49, 'Sabado 27 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 30, 1),
(423, 49, 'Sabado 27 de Octubre', 14, 'Cena Parrillada', '357.14', 30, 1),
(424, 49, 'Domingo 28 de Octubre', 1, 'Desayuno', '158.73', 30, 1),
(425, 10, 'Viernes 30 de Noviembre', 13, 'Cena 3 Tiempos', '293.65', 29, 1),
(426, 10, 'Sabado 1 de Diciembre', 1, 'Desayuno', '158.73', 29, 1),
(427, 10, 'Sabado 1 de Diciembre', 14, 'Cena Parrillada', '357.14', 29, 1),
(428, 10, 'Domingo 2 de Diciembre', 1, 'Desayuno', '158.73', 29, 1),
(429, 19, 'Miercoles 7 de Noviembre', 15, 'Cena Buffet', '234.13', 61, 1),
(430, 19, 'Jueves 8 de Noviembre', 2, 'Desayuno Buffet', '174.60', 61, 1),
(431, 19, 'Jueves 8 de Noviembre', 7, 'Comida Buffet', '234.13', 61, 1),
(432, 19, 'Jueves 8 de Noviembre', 14, 'Cena Parrillada', '357.14', 61, 1),
(433, 19, 'Jueves 8 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 61, 1),
(434, 19, 'Jueves 8 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(435, 19, 'Viernes 9 de Noviembre', 2, 'Desayuno Buffet', '174.60', 61, 1),
(436, 19, 'Viernes 9 de Noviembre', 7, 'Comida Buffet', '234.13', 61, 1),
(437, 19, 'Viernes 9 de Noviembre', 19, 'Medio Dia Coffe Break', '95.24', 61, 1),
(438, 19, 'Viernes 9 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(449, 53, 'Viernes 9 de Noviembre', 15, 'Cena Buffet', '234.13', 200, 1),
(450, 53, 'Sabado 10 de Noviembre', 2, 'Desayuno Buffet', '174.60', 200, 1),
(451, 53, 'Sabado 10 de Noviembre', 7, 'Comida Buffet', '234.13', 200, 1),
(452, 53, 'Sabado 10 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 200, 1),
(453, 54, 'Sabado 8 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(454, 54, 'Sabado 8 de Septiembre', 20, 'Dia Completo Coffe Break', '190.48', 25, 1),
(455, 54, 'Sabado 8 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 25, 1),
(470, 56, 'Sabado 8 de Diciembre', 1, 'Desayuno', '158.73', 15, 1),
(471, 56, 'Sabado 8 de Diciembre', 5, 'Comida 3 Tiempos', '293.65', 15, 1),
(472, 56, 'Sabado 8 de Diciembre', 14, 'Cena Parrillada', '357.14', 15, 1),
(473, 56, 'Sabado 8 de Diciembre', 20, 'Dia Completo Coffe Break', '190.48', 15, 1),
(474, 56, 'Sabado 8 de Diciembre', 24, 'Infocus', '1289.68', 1, 1),
(475, 56, 'Domingo 9 de Diciembre', 1, 'Desayuno', '158.73', 15, 1),
(476, 56, 'Domingo 9 de Diciembre', 19, 'Medio Dia Coffe Break', '95.24', 15, 1),
(477, 56, 'Domingo 9 de Diciembre', 24, 'Infocus', '1289.68', 1, 1),
(478, 51, 'Viernes 21 de Septiembre', 7, 'Comida Buffet', '234.13', 41, 1),
(479, 51, 'Viernes 21 de Septiembre', 15, 'Cena Buffet', '234.13', 41, 1),
(480, 51, 'Sabado 22 de Septiembre', 2, 'Desayuno Buffet', '174.60', 41, 1),
(481, 51, 'Sabado 22 de Septiembre', 7, 'Comida Buffet', '234.13', 41, 1),
(482, 51, 'Sabado 22 de Septiembre', 15, 'Cena Buffet', '234.13', 41, 1),
(483, 51, 'Domingo 23 de Septiembre', 2, 'Desayuno Buffet', '174.60', 41, 1),
(496, 57, 'Martes 21 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 25, 1),
(497, 57, 'Martes 21 de Agosto', 14, 'Cena Parrillada', '357.14', 25, 1),
(498, 57, 'Martes 21 de Agosto', 20, 'Dia Completo Coffe Break', '190.48', 25, 1),
(499, 57, 'Martes 21 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(500, 57, 'Martes 21 de Agosto', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(501, 57, 'Martes 21 de Agosto', 26, 'Microfono Adicional', '317.46', 1, 1),
(502, 57, 'Miercoles 22 de Agosto', 1, 'Desayuno', '158.73', 25, 1),
(503, 57, 'Miercoles 22 de Agosto', 19, 'Medio Dia Coffe Break', '95.24', 25, 1),
(504, 57, 'Miercoles 22 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(505, 57, 'Miercoles 22 de Agosto', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(506, 57, 'Miercoles 22 de Agosto', 26, 'Microfono Adicional', '317.46', 1, 1),
(540, 58, 'Miercoles 22 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 16, 1),
(541, 58, 'Miercoles 22 de Agosto', 6, 'Comida Parrillada', '357.14', 13, 1),
(542, 58, 'Miercoles 22 de Agosto', 20, 'Dia Completo Coffe Break', '190.48', 13, 1),
(543, 58, 'Jueves 23 de Agosto', 1, 'Desayuno', '158.73', 13, 1),
(544, 58, 'Jueves 23 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 13, 1),
(545, 58, 'Jueves 23 de Agosto', 20, 'Dia Completo Coffe Break', '190.48', 12, 1),
(546, 59, 'Viernes 24 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 33, 1),
(547, 59, 'Viernes 24 de Agosto', 13, 'Cena 3 Tiempos', '293.65', 33, 1),
(548, 59, 'Sabado 25 de Agosto', 1, 'Desayuno', '158.73', 33, 1),
(549, 59, 'Sabado 25 de Agosto', 5, 'Comida 3 Tiempos', '293.65', 33, 1),
(550, 59, 'Sabado 25 de Agosto', 14, 'Cena Parrillada', '357.14', 33, 1),
(551, 59, 'Sabado 25 de Agosto', 20, 'Dia Completo Coffe Break', '190.48', 33, 1),
(552, 59, 'Sabado 25 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(553, 59, 'Domingo 26 de Agosto', 1, 'Desayuno', '158.73', 33, 1),
(554, 30, 'Jueves 27 de Septiembre', 7, 'Comida Buffet', '234.13', 60, 1),
(555, 30, 'Jueves 27 de Septiembre', 15, 'Cena Buffet', '234.13', 60, 1),
(556, 30, 'Jueves 27 de Septiembre', 19, 'Medio Dia Coffe Break', '95.24', 60, 1),
(557, 30, 'Jueves 27 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(558, 30, 'Viernes 28 de Septiembre', 1, 'Desayuno', '158.73', 60, 1),
(559, 30, 'Viernes 28 de Septiembre', 7, 'Comida Buffet', '234.13', 60, 1),
(560, 30, 'Viernes 28 de Septiembre', 15, 'Cena Buffet', '234.13', 60, 1),
(561, 30, 'Viernes 28 de Septiembre', 20, 'Dia Completo Coffe Break', '190.48', 60, 1),
(562, 30, 'Viernes 28 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(563, 30, 'Sabado 29 de Septiembre', 2, 'Desayuno Buffet', '174.60', 60, 1),
(564, 60, 'Jueves 6 de Septiembre', 2, 'Desayuno Buffet', '174.60', 90, 1),
(565, 60, 'Jueves 6 de Septiembre', 7, 'Comida Buffet', '234.13', 90, 1),
(566, 60, 'Jueves 6 de Septiembre', 20, 'Dia Completo Coffe Break', '190.48', 90, 1),
(567, 60, 'Jueves 6 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(568, 60, 'Jueves 6 de Septiembre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(580, 55, 'Jueves 6 de Diciembre', 5, 'Comida 3 Tiempos', '293.65', 40, 1),
(581, 55, 'Jueves 6 de Diciembre', 6, 'Comida Parrillada', '357.14', 40, 1),
(582, 55, 'Jueves 6 de Diciembre', 20, 'Dia Completo Coffe Break', '190.48', 40, 1),
(583, 55, 'Jueves 6 de Diciembre', 24, 'Infocus', '1289.68', 1, 1),
(584, 55, 'Viernes 7 de Diciembre', 1, 'Desayuno', '158.73', 40, 1),
(585, 55, 'Viernes 7 de Diciembre', 5, 'Comida 3 Tiempos', '293.65', 40, 1),
(586, 55, 'Viernes 7 de Diciembre', 20, 'Dia Completo Coffe Break', '190.48', 40, 1),
(587, 55, 'Viernes 7 de Diciembre', 24, 'Infocus', '1289.68', 1, 1),
(610, 61, 'Miercoles 3 de Octubre', 1, 'Desayuno', '158.73', 9, 1),
(611, 61, 'Miercoles 3 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 9, 1),
(612, 61, 'Miercoles 3 de Octubre', 13, 'Cena 3 Tiempos', '293.65', 9, 1),
(613, 61, 'Miercoles 3 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 9, 1),
(614, 61, 'Miercoles 3 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(615, 61, 'Jueves 4 de Octubre', 1, 'Desayuno', '158.73', 9, 1),
(616, 61, 'Jueves 4 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 9, 1),
(617, 61, 'Jueves 4 de Octubre', 13, 'Cena 3 Tiempos', '293.65', 9, 1),
(618, 61, 'Jueves 4 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 9, 1),
(619, 61, 'Jueves 4 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(620, 61, 'Viernes 5 de Octubre', 1, 'Desayuno', '158.73', 9, 1),
(663, 62, 'Lunes 10 de Septiembre', 13, 'Cena 3 Tiempos', '293.65', 22, 1),
(664, 62, 'Martes 11 de Septiembre', 1, 'Desayuno', '158.73', 22, 1),
(665, 62, 'Martes 11 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 22, 1),
(666, 62, 'Martes 11 de Septiembre', 13, 'Cena 3 Tiempos', '293.65', 22, 1),
(667, 62, 'Martes 11 de Septiembre', 20, 'Dia Completo Coffe Break', '190.48', 22, 1),
(668, 62, 'Martes 11 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(669, 62, 'Miercoles 12 de Septiembre', 1, 'Desayuno', '158.73', 22, 1),
(670, 62, 'Miercoles 12 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 22, 1),
(671, 62, 'Miercoles 12 de Septiembre', 20, 'Dia Completo Coffe Break', '190.48', 22, 1),
(672, 62, 'Miercoles 12 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(674, 64, 'Miercoles 12 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 20, 1),
(675, 64, 'Miercoles 12 de Septiembre', 13, 'Cena 3 Tiempos', '293.65', 20, 1),
(676, 64, 'Miercoles 12 de Septiembre', 20, 'Dia Completo Coffe Break', '190.48', 20, 1),
(677, 64, 'Miercoles 12 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(678, 64, 'Jueves 13 de Septiembre', 1, 'Desayuno', '158.73', 20, 1),
(679, 64, 'Jueves 13 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 20, 1),
(680, 64, 'Jueves 13 de Septiembre', 20, 'Dia Completo Coffe Break', '190.48', 20, 1),
(681, 64, 'Jueves 13 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(682, 64, 'Viernes 14 de Septiembre', 1, 'Desayuno', '158.73', 20, 1),
(683, 64, 'Viernes 14 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 20, 1),
(684, 64, 'Viernes 14 de Septiembre', 19, 'Medio Dia Coffe Break', '95.24', 20, 1),
(685, 64, 'Viernes 14 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(688, 65, 'Domingo 23 de Septiembre', 2, 'Desayuno Buffet', '174.60', 41, 1),
(719, 38, 'Lunes 3 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 64, 1),
(720, 38, 'Lunes 3 de Septiembre', 13, 'Cena 3 Tiempos', '293.65', 64, 1),
(721, 38, 'Lunes 3 de Septiembre', 19, 'Medio Dia Coffe Break', '95.24', 64, 1),
(722, 38, 'Lunes 3 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(723, 38, 'Lunes 3 de Septiembre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(724, 38, 'Martes 4 de Septiembre', 1, 'Desayuno', '158.73', 64, 1),
(725, 38, 'Martes 4 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 64, 1),
(726, 38, 'Martes 4 de Septiembre', 14, 'Cena Parrillada', '357.14', 64, 1),
(727, 38, 'Martes 4 de Septiembre', 19, 'Medio Dia Coffe Break', '95.24', 64, 1),
(728, 38, 'Martes 4 de Septiembre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(729, 38, 'Miercoles 5 de Septiembre', 19, 'Medio Dia Coffe Break', '95.24', 64, 1),
(730, 38, 'Miercoles 5 de Septiembre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(731, 38, 'Miercoles 5 de Septiembre', 23, 'Box Lunch Op. 2', '154.76', 64, 1),
(732, 38, 'Miercoles 5 de Septiembre', 21, 'Servicios Adicionales', '83.33', 64, 1),
(742, 68, 'Sabado 27 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 52, 1),
(743, 68, 'Sabado 27 de Octubre', 15, 'Cena Buffet', '234.13', 52, 1),
(744, 68, 'Domingo 28 de Octubre', 2, 'Desayuno Buffet', '174.60', 52, 1),
(761, 69, 'Miercoles 29 de Agosto', 7, 'Comida Buffet', '234.13', 50, 1),
(762, 69, 'Miercoles 29 de Agosto', 15, 'Cena Buffet', '234.13', 50, 1),
(763, 69, 'Miercoles 29 de Agosto', 20, 'Dia Completo Coffe Break', '190.48', 50, 1),
(764, 69, 'Miercoles 29 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(765, 69, 'Miercoles 29 de Agosto', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(766, 69, 'Jueves 30 de Agosto', 2, 'Desayuno Buffet', '174.60', 50, 1),
(767, 69, 'Jueves 30 de Agosto', 7, 'Comida Buffet', '234.13', 50, 1),
(768, 69, 'Jueves 30 de Agosto', 14, 'Cena Parrillada', '357.14', 50, 1),
(769, 69, 'Jueves 30 de Agosto', 20, 'Dia Completo Coffe Break', '190.48', 50, 1),
(770, 69, 'Jueves 30 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(771, 69, 'Jueves 30 de Agosto', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(772, 69, 'Viernes 31 de Agosto', 2, 'Desayuno Buffet', '174.60', 50, 1),
(773, 69, 'Viernes 31 de Agosto', 7, 'Comida Buffet', '234.13', 50, 1),
(774, 69, 'Viernes 31 de Agosto', 19, 'Medio Dia Coffe Break', '95.24', 50, 1),
(775, 69, 'Viernes 31 de Agosto', 24, 'Infocus', '1289.68', 1, 1),
(776, 69, 'Viernes 31 de Agosto', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(801, 64, 'Jueves 11 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 40, 1),
(802, 64, 'Jueves 11 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 50, 1),
(803, 64, 'Jueves 11 de Octubre', 13, 'Cena 3 Tiempos', '293.65', 51, 1),
(804, 64, 'Jueves 11 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(805, 64, 'Viernes 12 de Octubre', 1, 'Desayuno', '158.73', 40, 1),
(806, 64, 'Viernes 12 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 50, 1),
(807, 64, 'Viernes 12 de Octubre', 19, 'Medio Dia Coffe Break', '95.24', 50, 1),
(808, 64, 'Viernes 12 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(817, 72, 'Jueves 18 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 50, 1),
(818, 72, 'Jueves 18 de Octubre', 14, 'Cena Parrillada', '357.14', 50, 1),
(819, 72, 'Jueves 18 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 40, 1),
(820, 72, 'Jueves 18 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(821, 72, 'Viernes 19 de Octubre', 1, 'Desayuno', '158.73', 50, 1),
(822, 72, 'Viernes 19 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 50, 1),
(823, 72, 'Viernes 19 de Octubre', 19, 'Medio Dia Coffe Break', '95.24', 40, 1),
(824, 72, 'Viernes 19 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(825, 4, 'Viernes 31 de Agosto', 14, 'Cena Parrillada', '357.14', 27, 1),
(826, 4, 'Sabado 1 de Septiembre', 1, 'Desayuno', '158.73', 27, 1),
(827, 4, 'Sabado 1 de Septiembre', 19, 'Medio Dia Coffe Break', '95.24', 27, 1),
(828, 4, 'Sabado 1 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(829, 4, 'Sabado 1 de Septiembre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(830, 4, 'Sabado 1 de Septiembre', 26, 'Microfono Adicional', '317.46', 2, 1),
(836, 74, 'Sabado 1 de Septiembre', 12, 'Cena 2 Tiempos', '261.90', 25, 1),
(857, 73, 'Viernes 7 de Septiembre', 20, 'Dia Completo Coffe Break', '190.48', 26, 1),
(858, 73, 'Viernes 7 de Septiembre', 12, 'Cena 2 Tiempos', '261.90', 26, 1),
(859, 73, 'Sabado 8 de Septiembre', 1, 'Desayuno', '158.73', 26, 1),
(860, 73, 'Sabado 8 de Septiembre', 6, 'Comida Parrillada', '357.14', 28, 1),
(861, 73, 'Sabado 8 de Septiembre', 19, 'Medio Dia Coffe Break', '95.24', 26, 1),
(892, 37, 'Martes 4 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 15, 1),
(893, 37, 'Martes 4 de Septiembre', 14, 'Cena Parrillada', '357.14', 15, 1),
(894, 37, 'Martes 4 de Septiembre', 20, 'Dia Completo Coffe Break', '190.48', 15, 1),
(895, 37, 'Martes 4 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(896, 37, 'Martes 4 de Septiembre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(897, 37, 'Martes 4 de Septiembre', 26, 'Microfono Adicional', '317.46', 1, 1),
(898, 37, 'Miercoles 5 de Septiembre', 1, 'Desayuno', '158.73', 15, 1),
(899, 37, 'Miercoles 5 de Septiembre', 19, 'Medio Dia Coffe Break', '95.24', 15, 1),
(900, 37, 'Miercoles 5 de Septiembre', 24, 'Infocus', '1289.68', 1, 1),
(901, 37, 'Miercoles 5 de Septiembre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(902, 37, 'Miercoles 5 de Septiembre', 26, 'Microfono Adicional', '317.46', 1, 1),
(903, 78, 'Sabado 27 de Octubre', 15, 'Cena Buffet', '234.13', 46, 1),
(904, 78, 'Domingo 28 de Octubre', 2, 'Desayuno Buffet', '174.60', 46, 1),
(922, 79, 'Viernes 19 de Octubre', 2, 'Desayuno Buffet', '174.60', 65, 1),
(923, 79, 'Viernes 19 de Octubre', 4, 'Comida 2 Tiempos', '261.90', 65, 1),
(924, 79, 'Viernes 19 de Octubre', 14, 'Cena Parrillada', '357.14', 65, 1),
(925, 79, 'Viernes 19 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 65, 1),
(926, 79, 'Viernes 19 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(927, 79, 'Viernes 19 de Octubre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(928, 79, 'Sabado 20 de Octubre', 2, 'Desayuno Buffet', '174.60', 65, 1),
(939, 71, 'Lunes 3 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 63, 1),
(940, 71, 'Lunes 3 de Septiembre', 13, 'Cena 3 Tiempos', '293.65', 63, 1),
(941, 71, 'Lunes 3 de Septiembre', 19, 'Medio Dia Coffe Break', '95.24', 63, 1),
(942, 71, 'Martes 4 de Septiembre', 1, 'Desayuno', '158.73', 63, 1),
(943, 71, 'Martes 4 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 63, 1),
(944, 71, 'Martes 4 de Septiembre', 14, 'Cena Parrillada', '357.14', 63, 1),
(945, 71, 'Martes 4 de Septiembre', 19, 'Medio Dia Coffe Break', '95.24', 63, 1),
(946, 71, 'Miercoles 5 de Septiembre', 19, 'Medio Dia Coffe Break', '95.24', 63, 1),
(947, 71, 'Miercoles 5 de Septiembre', 23, 'Box Lunch Op. 2', '154.76', 63, 1),
(948, 71, 'Miercoles 5 de Septiembre', 21, 'Servicios Adicionales', '83.33', 63, 1),
(949, 80, 'Miercoles 7 de Noviembre', 1, 'Desayuno', '158.73', 70, 1),
(950, 80, 'Miercoles 7 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 70, 1),
(951, 80, 'Miercoles 7 de Noviembre', 19, 'Medio Dia Coffe Break', '95.24', 70, 1),
(952, 80, 'Jueves 8 de Noviembre', 1, 'Desayuno', '158.73', 70, 1),
(953, 80, 'Jueves 8 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 70, 1),
(954, 80, 'Jueves 8 de Noviembre', 19, 'Medio Dia Coffe Break', '95.24', 70, 1),
(955, 81, 'Lunes 26 de Noviembre', 14, 'Cena Parrillada', '357.14', 14, 1),
(956, 81, 'Martes 27 de Noviembre', 1, 'Desayuno', '158.73', 14, 1),
(997, 83, 'Martes 13 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 24, 1),
(998, 83, 'Martes 13 de Noviembre', 13, 'Cena 3 Tiempos', '293.65', 24, 1),
(999, 83, 'Martes 13 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 24, 1),
(1000, 83, 'Miercoles 14 de Noviembre', 1, 'Desayuno', '158.73', 24, 1),
(1001, 83, 'Miercoles 14 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 24, 1),
(1002, 83, 'Miercoles 14 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 24, 1),
(1003, 83, 'Jueves 15 de Noviembre', 1, 'Desayuno', '158.73', 24, 1),
(1004, 83, 'Jueves 15 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 24, 1),
(1005, 83, 'Jueves 15 de Noviembre', 13, 'Cena 3 Tiempos', '293.65', 24, 1),
(1006, 83, 'Jueves 15 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 24, 1),
(1007, 83, 'Viernes 16 de Noviembre', 1, 'Desayuno', '158.73', 24, 1),
(1008, 83, 'Viernes 16 de Noviembre', 19, 'Medio Dia Coffe Break', '95.24', 24, 1),
(1009, 70, 'Lunes 22 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 200, 1),
(1010, 70, 'Lunes 22 de Octubre', 16, 'Cena Buffet Norteño', '416.67', 200, 1),
(1011, 70, 'Lunes 22 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 200, 1),
(1012, 70, 'Martes 23 de Octubre', 1, 'Desayuno', '158.73', 200, 1),
(1013, 70, 'Martes 23 de Octubre', 7, 'Comida Buffet', '234.13', 200, 1),
(1014, 70, 'Martes 23 de Octubre', 14, 'Cena Parrillada', '357.14', 200, 1),
(1015, 70, 'Martes 23 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 200, 1),
(1016, 70, 'Miercoles 24 de Octubre', 2, 'Desayuno Buffet', '174.60', 200, 1),
(1017, 70, 'Miercoles 24 de Octubre', 19, 'Medio Dia Coffe Break', '95.24', 200, 1),
(1018, 77, 'Jueves 11 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 40, 1),
(1019, 77, 'Jueves 11 de Octubre', 14, 'Cena Parrillada', '357.14', 40, 1),
(1020, 77, 'Jueves 11 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 40, 1),
(1021, 77, 'Jueves 11 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1022, 77, 'Viernes 12 de Octubre', 1, 'Desayuno', '158.73', 40, 1),
(1051, 82, 'Viernes 30 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 90, 1),
(1052, 82, 'Viernes 30 de Noviembre', 13, 'Cena 3 Tiempos', '293.65', 90, 1),
(1053, 82, 'Viernes 30 de Noviembre', 19, 'Medio Dia Coffe Break', '95.24', 90, 1),
(1054, 82, 'Viernes 30 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(1055, 82, 'Viernes 30 de Noviembre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(1056, 82, 'Viernes 30 de Noviembre', 26, 'Microfono Adicional', '317.46', 1, 1),
(1057, 82, 'Sabado 1 de Diciembre', 2, 'Desayuno Buffet', '174.60', 90, 1),
(1058, 82, 'Sabado 1 de Diciembre', 5, 'Comida 3 Tiempos', '293.65', 90, 1),
(1059, 82, 'Sabado 1 de Diciembre', 9, 'Comida Buffet Mexicano O Taquiza', '309.52', 90, 1),
(1060, 82, 'Sabado 1 de Diciembre', 20, 'Dia Completo Coffe Break', '190.48', 90, 1),
(1061, 82, 'Sabado 1 de Diciembre', 24, 'Infocus', '1289.68', 1, 1),
(1062, 82, 'Sabado 1 de Diciembre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(1063, 82, 'Sabado 1 de Diciembre', 26, 'Microfono Adicional', '317.46', 1, 1),
(1064, 82, 'Domingo 2 de Diciembre', 2, 'Desayuno Buffet', '174.60', 90, 1),
(1074, 85, 'Miercoles 21 de Noviembre', 1, 'Desayuno', '158.73', 70, 1),
(1075, 85, 'Miercoles 21 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 70, 1),
(1076, 85, 'Miercoles 21 de Noviembre', 13, 'Cena 3 Tiempos', '293.65', 70, 1),
(1077, 85, 'Miercoles 21 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(1078, 85, 'Miercoles 21 de Noviembre', 19, 'Medio Dia Coffe Break', '95.24', 70, 1),
(1079, 85, 'Jueves 22 de Noviembre', 1, 'Desayuno', '158.73', 70, 1),
(1080, 85, 'Jueves 22 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 70, 1),
(1081, 85, 'Jueves 22 de Noviembre', 14, 'Cena Parrillada', '357.14', 70, 1),
(1082, 85, 'Jueves 22 de Noviembre', 19, 'Medio Dia Coffe Break', '95.24', 70, 1),
(1083, 85, 'Jueves 22 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(1084, 85, 'Viernes 23 de Noviembre', 1, 'Desayuno', '158.73', 70, 1),
(1103, 87, 'Viernes 28 de Septiembre', 13, 'Cena 3 Tiempos', '293.65', 12, 1),
(1104, 87, 'Sabado 29 de Septiembre', 1, 'Desayuno', '158.73', 12, 1),
(1105, 87, 'Sabado 29 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 12, 1),
(1106, 87, 'Sabado 29 de Septiembre', 14, 'Cena Parrillada', '357.14', 12, 1),
(1107, 87, 'Sabado 29 de Septiembre', 20, 'Dia Completo Coffe Break', '190.48', 12, 1),
(1108, 87, 'Domingo 30 de Septiembre', 1, 'Desayuno', '158.73', 12, 1),
(1129, 75, 'Jueves 20 de Septiembre', 5, 'Comida 3 Tiempos', '293.65', 31, 1),
(1130, 75, 'Jueves 20 de Septiembre', 19, 'Medio Dia Coffe Break', '95.24', 31, 1),
(1131, 75, 'Jueves 20 de Septiembre', 13, 'Cena 3 Tiempos', '293.65', 31, 1),
(1132, 75, 'Viernes 21 de Septiembre', 1, 'Desayuno', '158.73', 27, 1),
(1133, 75, 'Viernes 21 de Septiembre', 20, 'Dia Completo Coffe Break', '190.48', 27, 1),
(1134, 75, 'Viernes 21 de Septiembre', 4, 'Comida 2 Tiempos', '261.90', 27, 1),
(1135, 75, 'Viernes 21 de Septiembre', 14, 'Cena Parrillada', '357.14', 27, 1),
(1136, 75, 'Sabado 22 de Septiembre', 1, 'Desayuno', '158.73', 27, 1),
(1137, 75, 'Sabado 22 de Septiembre', 19, 'Medio Dia Coffe Break', '95.24', 27, 1),
(1138, 75, 'Sabado 22 de Septiembre', 23, 'Box Lunch Op. 2', '154.76', 27, 1),
(1139, 88, 'Lunes 8 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 55, 1),
(1140, 88, 'Lunes 8 de Octubre', 13, 'Cena 3 Tiempos', '293.65', 55, 1),
(1141, 88, 'Lunes 8 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 55, 1),
(1142, 88, 'Lunes 8 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1143, 88, 'Martes 9 de Octubre', 1, 'Desayuno', '158.73', 55, 1),
(1144, 88, 'Martes 9 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 55, 1),
(1145, 88, 'Martes 9 de Octubre', 13, 'Cena 3 Tiempos', '293.65', 55, 1),
(1146, 88, 'Martes 9 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 55, 1),
(1147, 88, 'Martes 9 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1148, 88, 'Miercoles 10 de Octubre', 1, 'Desayuno', '158.73', 55, 1),
(1149, 88, 'Miercoles 10 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 55, 1),
(1150, 88, 'Miercoles 10 de Octubre', 19, 'Medio Dia Coffe Break', '95.24', 55, 1),
(1151, 88, 'Miercoles 10 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1152, 84, 'Jueves 1 de Noviembre', 1, 'Desayuno', '158.73', 54, 1),
(1153, 84, 'Jueves 1 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 54, 1),
(1154, 84, 'Jueves 1 de Noviembre', 14, 'Cena Parrillada', '357.14', 54, 1),
(1155, 84, 'Jueves 1 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 54, 1),
(1156, 84, 'Jueves 1 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(1157, 84, 'Viernes 2 de Noviembre', 1, 'Desayuno', '158.73', 54, 1),
(1158, 84, 'Viernes 2 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 54, 1),
(1159, 84, 'Viernes 2 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 54, 1),
(1160, 84, 'Viernes 2 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(1164, 76, 'Lunes 15 de Octubre', 13, 'Cena 3 Tiempos', '293.65', 11, 1),
(1165, 76, 'Martes 16 de Octubre', 1, 'Desayuno', '158.73', 11, 1),
(1166, 76, 'Martes 16 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 11, 1),
(1167, 76, 'Martes 16 de Octubre', 6, 'Comida Parrillada', '357.14', 11, 1),
(1168, 76, 'Martes 16 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 11, 1),
(1169, 76, 'Miercoles 17 de Octubre', 1, 'Desayuno', '158.73', 11, 1),
(1170, 76, 'Miercoles 17 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 11, 1),
(1171, 76, 'Miercoles 17 de Octubre', 19, 'Medio Dia Coffe Break', '95.24', 11, 1),
(1179, 92, 'Jueves 18 de Octubre', 2, 'Desayuno Buffet', '174.60', 50, 1),
(1180, 92, 'Viernes 19 de Octubre', 2, 'Desayuno Buffet', '174.60', 50, 1),
(1181, 93, 'Jueves 8 de Noviembre', 13, 'Cena 3 Tiempos', '293.65', 26, 1),
(1182, 93, 'Viernes 9 de Noviembre', 1, 'Desayuno', '158.73', 26, 1),
(1201, 95, 'Lunes 3 de Diciembre', 5, 'Comida 3 Tiempos', '293.65', 26, 1),
(1202, 95, 'Lunes 3 de Diciembre', 13, 'Cena 3 Tiempos', '293.65', 26, 1),
(1203, 95, 'Lunes 3 de Diciembre', 20, 'Dia Completo Coffe Break', '190.48', 26, 1),
(1204, 95, 'Lunes 3 de Diciembre', 24, 'Infocus', '1289.68', 1, 1),
(1205, 95, 'Martes 4 de Diciembre', 1, 'Desayuno', '158.73', 26, 1),
(1206, 95, 'Martes 4 de Diciembre', 20, 'Dia Completo Coffe Break', '190.48', 26, 1),
(1207, 96, 'Jueves 11 de Octubre', 13, 'Cena 3 Tiempos', '293.65', 10, 1),
(1208, 96, 'Viernes 12 de Octubre', 1, 'Desayuno', '158.73', 10, 1),
(1209, 96, 'Viernes 12 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 10, 1),
(1210, 96, 'Viernes 12 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 10, 1),
(1211, 96, 'Viernes 12 de Octubre', 14, 'Cena Parrillada', '357.14', 10, 1),
(1212, 96, 'Viernes 12 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1213, 96, 'Viernes 12 de Octubre', 27, 'Pinos, Sauces', '1984.13', 1, 1),
(1214, 96, 'Sabado 13 de Octubre', 1, 'Desayuno', '158.73', 10, 1),
(1225, 97, 'Jueves 18 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 15, 1),
(1226, 97, 'Jueves 18 de Octubre', 14, 'Cena Parrillada', '357.14', 15, 1),
(1227, 97, 'Jueves 18 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 15, 1),
(1228, 97, 'Jueves 18 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1229, 97, 'Viernes 19 de Octubre', 1, 'Desayuno', '158.73', 15, 1),
(1230, 97, 'Viernes 19 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 15, 1),
(1231, 97, 'Viernes 19 de Octubre', 19, 'Medio Dia Coffe Break', '95.24', 15, 1),
(1232, 97, 'Viernes 19 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1257, 98, 'Jueves 27 de Septiembre', 11, 'Cena Sencilla', '186.51', 96, 1),
(1258, 98, 'Viernes 28 de Septiembre', 1, 'Desayuno', '158.73', 96, 1),
(1259, 98, 'Viernes 28 de Septiembre', 3, 'Comida Sencilla', '186.51', 96, 1),
(1260, 98, 'Viernes 28 de Septiembre', 11, 'Cena Sencilla', '186.51', 96, 1),
(1261, 98, 'Sabado 29 de Septiembre', 1, 'Desayuno', '158.73', 96, 1),
(1262, 98, 'Sabado 29 de Septiembre', 3, 'Comida Sencilla', '186.51', 96, 1),
(1263, 98, 'Sabado 29 de Septiembre', 11, 'Cena Sencilla', '186.51', 96, 1),
(1264, 98, 'Domingo 30 de Septiembre', 1, 'Desayuno', '158.73', 96, 1),
(1317, 102, 'Martes 30 de Octubre', 1, 'Desayuno', '158.73', 12, 1),
(1318, 102, 'Martes 30 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 12, 1),
(1319, 102, 'Martes 30 de Octubre', 13, 'Cena 3 Tiempos', '293.65', 12, 1),
(1320, 102, 'Martes 30 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 12, 1),
(1321, 102, 'Martes 30 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1322, 102, 'Miercoles 31 de Octubre', 1, 'Desayuno', '158.73', 12, 1);
INSERT INTO `cotizacion_dia` (`id`, `id_empresa`, `dia`, `id_servicio`, `servicio`, `precio`, `cantidad`, `state`) VALUES
(1323, 102, 'Miercoles 31 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 12, 1),
(1324, 102, 'Miercoles 31 de Octubre', 14, 'Cena Parrillada', '357.14', 12, 1),
(1325, 102, 'Miercoles 31 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 12, 1),
(1326, 102, 'Miercoles 31 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1327, 102, 'Jueves 1 de Noviembre', 1, 'Desayuno', '158.73', 12, 1),
(1328, 102, 'Jueves 1 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 12, 1),
(1329, 102, 'Jueves 1 de Noviembre', 13, 'Cena 3 Tiempos', '293.65', 12, 1),
(1330, 102, 'Jueves 1 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 12, 1),
(1331, 102, 'Jueves 1 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(1332, 102, 'Viernes 2 de Noviembre', 1, 'Desayuno', '158.73', 12, 1),
(1333, 99, 'Martes 30 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 12, 1),
(1334, 99, 'Martes 30 de Octubre', 13, 'Cena 3 Tiempos', '293.65', 12, 1),
(1335, 99, 'Martes 30 de Octubre', 19, 'Medio Dia Coffe Break', '95.24', 12, 1),
(1336, 99, 'Martes 30 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1337, 99, 'Miercoles 31 de Octubre', 1, 'Desayuno', '158.73', 12, 1),
(1338, 99, 'Miercoles 31 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 12, 1),
(1339, 99, 'Miercoles 31 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 12, 1),
(1340, 99, 'Miercoles 31 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1341, 99, 'Miercoles 31 de Octubre', 13, 'Cena 3 Tiempos', '293.65', 12, 1),
(1342, 99, 'Jueves 1 de Noviembre', 1, 'Desayuno', '158.73', 12, 1),
(1343, 99, 'Jueves 1 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 12, 1),
(1344, 99, 'Jueves 1 de Noviembre', 13, 'Cena 3 Tiempos', '293.65', 12, 1),
(1345, 99, 'Jueves 1 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 12, 1),
(1346, 99, 'Jueves 1 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(1347, 99, 'Viernes 2 de Noviembre', 1, 'Desayuno', '158.73', 12, 1),
(1348, 99, 'Viernes 2 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 12, 1),
(1349, 99, 'Viernes 2 de Noviembre', 19, 'Medio Dia Coffe Break', '95.24', 12, 1),
(1350, 99, 'Viernes 2 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(1360, 94, 'Lunes 15 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 57, 1),
(1361, 94, 'Lunes 15 de Octubre', 9, 'Comida Buffet Mexicano O Taquiza', '309.52', 57, 1),
(1362, 94, 'Martes 16 de Octubre', 2, 'Desayuno Buffet', '174.60', 57, 1),
(1363, 94, 'Martes 16 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 57, 1),
(1364, 94, 'Martes 16 de Octubre', 14, 'Cena Parrillada', '357.14', 57, 1),
(1365, 94, 'Martes 16 de Octubre', 19, 'Medio Dia Coffe Break', '95.24', 57, 1),
(1366, 94, 'Martes 16 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1367, 94, 'Miercoles 17 de Octubre', 2, 'Desayuno Buffet', '174.60', 57, 1),
(1368, 103, 'Viernes 8 de Marzo', 3, 'Comida Sencilla', '186.51', 28, 1),
(1369, 103, 'Viernes 8 de Marzo', 11, 'Cena Sencilla', '186.51', 28, 1),
(1370, 103, 'Sabado 9 de Marzo', 1, 'Desayuno', '158.73', 28, 1),
(1371, 103, 'Sabado 9 de Marzo', 3, 'Comida Sencilla', '186.51', 28, 1),
(1372, 103, 'Sabado 9 de Marzo', 11, 'Cena Sencilla', '186.51', 28, 1),
(1373, 103, 'Domingo 10 de Marzo', 1, 'Desayuno', '158.73', 28, 1),
(1386, 86, 'Miercoles 21 de Noviembre', 1, 'Desayuno', '158.73', 70, 1),
(1387, 86, 'Miercoles 21 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 70, 1),
(1388, 86, 'Miercoles 21 de Noviembre', 13, 'Cena 3 Tiempos', '293.65', 70, 1),
(1389, 86, 'Miercoles 21 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(1390, 86, 'Miercoles 21 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 70, 1),
(1391, 86, 'Miercoles 21 de Noviembre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(1392, 86, 'Jueves 22 de Noviembre', 1, 'Desayuno', '158.73', 70, 1),
(1393, 86, 'Jueves 22 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 70, 1),
(1394, 86, 'Jueves 22 de Noviembre', 14, 'Cena Parrillada', '357.14', 70, 1),
(1395, 86, 'Jueves 22 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(1396, 86, 'Jueves 22 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 70, 1),
(1397, 86, 'Jueves 22 de Noviembre', 25, 'Equipo de Sonido', '1309.52', 1, 1),
(1398, 86, 'Viernes 23 de Noviembre', 1, 'Desayuno', '158.73', 70, 1),
(1399, 105, 'Viernes 30 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 21, 1),
(1400, 105, 'Viernes 30 de Noviembre', 14, 'Cena Parrillada', '357.14', 21, 1),
(1401, 105, 'Viernes 30 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 21, 1),
(1402, 105, 'Viernes 30 de Noviembre', 27, 'Pinos, Sauces', '1984.13', 1, 1),
(1403, 105, 'Sabado 1 de Diciembre', 1, 'Desayuno', '158.73', 21, 1),
(1404, 106, 'Viernes 30 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 21, 1),
(1405, 106, 'Viernes 30 de Noviembre', 14, 'Cena Parrillada', '357.14', 21, 1),
(1406, 106, 'Viernes 30 de Noviembre', 27, 'Pinos, Sauces', '1984.13', 1, 1),
(1407, 106, 'Viernes 30 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 21, 1),
(1408, 106, 'Sabado 1 de Diciembre', 1, 'Desayuno', '158.73', 21, 1),
(1426, 108, 'Miercoles 5 de Diciembre', 13, 'Cena 3 Tiempos', '293.65', 16, 1),
(1427, 108, 'Jueves 6 de Diciembre', 1, 'Desayuno', '158.73', 16, 1),
(1428, 108, 'Jueves 6 de Diciembre', 5, 'Comida 3 Tiempos', '293.65', 16, 1),
(1429, 108, 'Jueves 6 de Diciembre', 14, 'Cena Parrillada', '357.14', 39, 1),
(1430, 108, 'Jueves 6 de Diciembre', 20, 'Dia Completo Coffe Break', '190.48', 16, 1),
(1431, 108, 'Viernes 7 de Diciembre', 1, 'Desayuno', '158.73', 39, 1),
(1432, 108, 'Viernes 7 de Diciembre', 5, 'Comida 3 Tiempos', '293.65', 39, 1),
(1433, 108, 'Viernes 7 de Diciembre', 13, 'Cena 3 Tiempos', '293.65', 39, 1),
(1434, 108, 'Viernes 7 de Diciembre', 20, 'Dia Completo Coffe Break', '190.48', 39, 1),
(1435, 108, 'Sabado 8 de Diciembre', 1, 'Desayuno', '158.73', 39, 1),
(1440, 109, 'Miercoles 17 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 10, 1),
(1441, 109, 'Miercoles 17 de Octubre', 13, 'Cena 3 Tiempos', '293.65', 10, 1),
(1442, 109, 'Miercoles 17 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1443, 109, 'Jueves 18 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 20, 1),
(1444, 109, 'Jueves 18 de Octubre', 1, 'Desayuno', '158.73', 20, 1),
(1445, 109, 'Jueves 18 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 20, 1),
(1446, 109, 'Jueves 18 de Octubre', 13, 'Cena 3 Tiempos', '293.65', 20, 1),
(1447, 109, 'Jueves 18 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1448, 109, 'Viernes 19 de Octubre', 1, 'Desayuno', '158.73', 20, 1),
(1450, 111, 'Martes 23 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 9, 1),
(1451, 111, 'Martes 23 de Octubre', 14, 'Cena Parrillada', '357.14', 9, 1),
(1452, 111, 'Martes 23 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 9, 1),
(1453, 111, 'Martes 23 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1454, 111, 'Miercoles 24 de Octubre', 1, 'Desayuno', '158.73', 9, 1),
(1455, 111, 'Miercoles 24 de Octubre', 19, 'Medio Dia Coffe Break', '95.24', 9, 1),
(1456, 111, 'Miercoles 24 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1457, 101, 'Sabado 6 de Octubre', 14, 'Cena Parrillada', '357.14', 15, 1),
(1458, 107, 'Jueves 18 de Octubre', 19, 'Medio Dia Coffe Break', '95.24', 13, 1),
(1459, 107, 'Jueves 18 de Octubre', 14, 'Cena Parrillada', '357.14', 13, 1),
(1460, 107, 'Viernes 19 de Octubre', 1, 'Desayuno', '158.73', 13, 1),
(1461, 107, 'Viernes 19 de Octubre', 19, 'Medio Dia Coffe Break', '95.24', 13, 1),
(1462, 112, 'Jueves 25 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 16, 1),
(1463, 112, 'Jueves 25 de Octubre', 14, 'Cena Parrillada', '357.14', 16, 1),
(1464, 112, 'Jueves 25 de Octubre', 19, 'Medio Dia Coffe Break', '95.24', 16, 1),
(1465, 112, 'Jueves 25 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1466, 112, 'Viernes 26 de Octubre', 1, 'Desayuno', '158.73', 16, 1),
(1467, 91, 'Jueves 22 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 14, 1),
(1468, 91, 'Jueves 22 de Noviembre', 14, 'Cena Parrillada', '357.14', 14, 1),
(1469, 91, 'Jueves 22 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 14, 1),
(1470, 91, 'Viernes 23 de Noviembre', 1, 'Desayuno', '158.73', 14, 1),
(1471, 91, 'Viernes 23 de Noviembre', 5, 'Comida 3 Tiempos', '293.65', 14, 1),
(1472, 91, 'Viernes 23 de Noviembre', 20, 'Dia Completo Coffe Break', '190.48', 14, 1),
(1512, 104, 'Miercoles 24 de Octubre', 1, 'Desayuno', '158.73', 11, 1),
(1513, 104, 'Miercoles 24 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 11, 1),
(1514, 104, 'Miercoles 24 de Octubre', 13, 'Cena 3 Tiempos', '293.65', 11, 1),
(1515, 104, 'Miercoles 24 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 11, 1),
(1516, 104, 'Miercoles 24 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1517, 104, 'Jueves 25 de Octubre', 1, 'Desayuno', '158.73', 11, 1),
(1518, 104, 'Jueves 25 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 11, 1),
(1519, 104, 'Jueves 25 de Octubre', 13, 'Cena 3 Tiempos', '293.65', 11, 1),
(1520, 104, 'Jueves 25 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 11, 1),
(1521, 104, 'Jueves 25 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1522, 104, 'Viernes 26 de Octubre', 1, 'Desayuno', '158.73', 11, 1),
(1523, 104, 'Viernes 26 de Octubre', 5, 'Comida 3 Tiempos', '293.65', 11, 1),
(1524, 104, 'Viernes 26 de Octubre', 14, 'Cena Parrillada', '357.14', 11, 1),
(1525, 104, 'Viernes 26 de Octubre', 20, 'Dia Completo Coffe Break', '190.48', 11, 1),
(1526, 104, 'Viernes 26 de Octubre', 24, 'Infocus', '1289.68', 1, 1),
(1527, 104, 'Sabado 27 de Octubre', 1, 'Desayuno', '158.73', 11, 1),
(1528, 114, 'Miercoles 28 de Noviembre', 7, 'Comida Buffet', '234.13', 58, 1),
(1529, 114, 'Miercoles 28 de Noviembre', 15, 'Cena Buffet', '234.13', 58, 1),
(1530, 114, 'Miercoles 28 de Noviembre', 19, 'Medio Dia Coffe Break', '95.24', 58, 1),
(1531, 114, 'Miercoles 28 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(1532, 114, 'Jueves 29 de Noviembre', 2, 'Desayuno Buffet', '174.60', 58, 1),
(1533, 114, 'Jueves 29 de Noviembre', 9, 'Comida Buffet Mexicano O Taquiza', '309.52', 58, 1),
(1534, 114, 'Jueves 29 de Noviembre', 16, 'Cena Buffet Norteño', '416.67', 58, 1),
(1535, 114, 'Jueves 29 de Noviembre', 19, 'Medio Dia Coffe Break', '95.24', 58, 1),
(1536, 114, 'Jueves 29 de Noviembre', 24, 'Infocus', '1289.68', 1, 1),
(1537, 114, 'Viernes 30 de Noviembre', 2, 'Desayuno Buffet', '174.60', 58, 1),
(1538, 114, 'Viernes 30 de Noviembre', 7, 'Comida Buffet', '234.13', 58, 1),
(1539, 114, 'Viernes 30 de Noviembre', 19, 'Medio Dia Coffe Break', '95.24', 58, 1),
(1540, 114, 'Viernes 30 de Noviembre', 24, 'Infocus', '1289.68', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `id` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `departamento` varchar(150) NOT NULL,
  `hora` time DEFAULT NULL,
  `lugar` varchar(100) DEFAULT NULL,
  `descripcion` longtext NOT NULL,
  `notas` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`id`, `id_empresa`, `departamento`, `hora`, `lugar`, `descripcion`, `notas`) VALUES
(1, 105, 'reception', NULL, NULL, 'descripcion de recepcion', '{\"reception\":[{\"nota\":\"nota de recepciu00f3n 1\"},{\"nota\":\"nota de recepciu00f3n 2\"}]}'),
(2, 105, 'food', NULL, NULL, '', ''),
(3, 105, 'support', NULL, NULL, 'descripcion de mtto', '{\"support\":[{\"nota\":\"nota de mtto 1\"},{\"nota\":\"nota de mtto 2\"}]}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `extras`
--

CREATE TABLE `extras` (
  `id` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `dia` varchar(150) NOT NULL,
  `servicio` varchar(150) NOT NULL,
  `costo` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `extras`
--

INSERT INTO `extras` (`id`, `id_empresa`, `dia`, `servicio`, `costo`) VALUES
(1, 4, 'Viernes 31 de Agosto', '54 Copas De Vino Tinto', '4320.00'),
(2, 71, 'Martes 4 de Septiembre', 'Descorche', '2000'),
(3, 71, 'Martes 4 de Septiembre', 'Meseros', '2040'),
(4, 71, 'Martes 4 de Septiembre', 'Molienda', '8631'),
(5, 71, 'Martes 4 de Septiembre', 'Varios', '1226'),
(6, 37, 'Martes 4 de Septiembre', 'Hospedaje', '2600'),
(7, 37, 'Martes 4 de Septiembre', 'Cerveza', '525'),
(8, 37, 'Martes 4 de Septiembre', 'Botella De Vino Tinto', '1190'),
(9, 37, 'Martes 4 de Septiembre', 'Desayuno', '1846'),
(10, 87, 'Sabado 29 de Septiembre', 'Extra', '723'),
(11, 94, 'Martes 16 de Octubre', 'Vendimia', '7520.00'),
(12, 95, 'Lunes 3 de Diciembre', 'Barra Libre', '20800.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id` int(11) NOT NULL,
  `clave` varchar(150) NOT NULL,
  `num_cotizaciones` int(11) NOT NULL,
  `ingresos` decimal(11,2) NOT NULL,
  `state` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `clave`, `num_cotizaciones`, `ingresos`, `state`) VALUES
(1, 'CG_5b718ed833079', 1, '35087.00', 1),
(2, 'CG_5b719f3381178', 1, '100981.00', 1),
(3, 'CG_5b719fc940fe4', 1, '262950.00', 1),
(4, 'CG_5b71a031f12b2', 1, '50625.00', 1),
(5, 'CG_5b71a0f32a496', 1, '98512.00', 1),
(6, 'CG_5b71a1886259c', 1, '490563.00', 1),
(7, 'CG_5b71a2028bb3a', 1, '24336.00', 1),
(8, 'CG_5b71a2d8a54c3', 1, '56403.00', 1),
(9, 'CG_5b71a352c0ef8', 2, '939446.00', 1),
(10, 'CG_5b71a3e14a794', 1, '69855.00', 1),
(11, 'CG_5b71a443ef7cf', 2, '45446.00', 1),
(12, 'CG_5b71e36fb3e7a', 1, '214147.00', 1),
(13, 'CG_5b71e471d3338', 1, '323001.00', 1),
(14, 'CG_5b71e53aae17e', 1, '117305.00', 1),
(15, 'CG_5b71e5b38b035', 1, '84550.00', 1),
(16, 'CG_5b71e6104fdb9', 3, '283773.00', 1),
(17, 'CG_5b71e6ddc45f7', 1, '250448.00', 1),
(18, 'CG_5b71e76c806ca', 1, '173645.04', 1),
(19, 'CG_5b71e7f22e204', 1, '165704.00', 1),
(20, 'CG_5b71e955856c0', 1, '197008.00', 1),
(21, 'CG_5b71ead40e195', 2, '416530.00', 1),
(22, 'CG_5b71eb49213d4', 1, '21282.00', 1),
(23, 'CG_5b71eb8e72ed6', 1, '31239.00', 1),
(24, 'CG_5b71ebb02de6f', 1, '108370.00', 1),
(25, 'CG_5b71ebfa47ad5', 1, '36022.00', 1),
(26, 'CG_5b71ec4755006', 1, '57965.00', 1),
(27, 'CG_5b71ec7068768', 1, '77669.00', 1),
(28, 'CG_5b71ecbd0ca89', 1, '211249.00', 1),
(29, 'CG_5b71ed07d6a0a', 1, '20172.00', 1),
(30, 'CG_5b71ed3ac5adb', 1, '89106.00', 1),
(31, 'CG_5b71eda33ba23', 1, '29441.00', 1),
(33, 'CG_5b71ee4070e29', 1, '11746.00', 1),
(34, 'CG_5b71ee7956cda', 1, '166010.00', 1),
(35, 'CG_5b71eee0f131d', 1, '33182.00', 1),
(36, 'CG_5b71ef335ef4c', 2, '384546.28', 1),
(37, 'CG_5b71ef6059c2e', 1, '126142.00', 1),
(38, 'CG_5b71efb8def80', 1, '64406.00', 1),
(39, 'CG_5b71efd87651b', 1, '17588.00', 1),
(40, 'CG_5b71f03be3cda', 1, '38232.00', 1),
(41, 'CG_5b71f08b05d6a', 1, '30940.00', 1),
(42, 'CG_5b71f09a025d1', 1, '36264.00', 1),
(43, 'CG_5b71f144985cd', 3, '1045743.50', 1),
(45, 'CG_5b71f31a65713', 1, '95558.00', 1),
(47, 'CG_5b733dc71dc1d', 2, '126057.00', 1),
(48, 'CG_5b744bb6a9161', 1, '13393.00', 1),
(49, 'CG_5b7484f42d584', 1, '93613.00', 1),
(50, 'CG_5b74a09ec4b90', 1, '34628.00', 1),
(51, 'CG_5b75ac1b950e0', 1, '7936.00', 1),
(52, 'CG_5b75b2c202572', 1, '60514.00', 1),
(53, 'CG_5b75e29d23e85', 1, '35272.00', 1),
(54, 'CG_5b76d14b88187', 1, '108923.00', 1),
(55, 'CG_5b76ea3f51cff', 1, '56528.00', 1),
(56, 'CG_5b7ac1457fa74', 1, '40521.00', 1),
(57, 'CG_5b7d8353b7211', 1, '67810.00', 1),
(58, 'CG_5b7da72da6288', 1, '86914.00', 1),
(60, 'CG_5b819eab87545', 2, '115926.00', 1),
(61, 'CG_5b81b18eb4fe6', 1, '179271.00', 1),
(63, 'CG_5b8d8ed893b91', 1, '640624.00', 1),
(64, 'CG_5b8e8ca40866e', 0, '0.00', 1),
(65, 'CG_5b8e8dd1c06d7', 1, '123767.00', 1),
(66, 'CG_5b8ffbee07cfc', 1, '66611.00', 1),
(67, 'CG_5b8ffd5ea5b5e', 1, '21258.00', 1),
(68, 'CG_5b904dbe39486', 1, '96403.00', 1),
(69, 'CG_5b91ac352da89', 1, '44278.00', 1),
(70, 'CG_5b940bd92d511', 1, '63129.72', 1),
(71, 'CG_5b97026e0594b', 1, '126459.00', 1),
(72, 'CG_5b9835a92992f', 1, '114887.00', 1),
(73, 'CG_5b98377342959', 1, '14866.00', 1),
(74, 'CG_5b9851071a835', 1, '420188.00', 1),
(75, 'CG_5b99a9f597854', 1, '141291.00', 1),
(76, 'CG_5ba13dd28ffe2', 1, '120778.00', 1),
(77, 'CG_5ba15a0d6b375', 1, '52732.12', 1),
(78, 'CG_5ba1875f28956', 1, '189426.00', 1),
(80, 'CG_5ba96114051ce', 1, '27416.00', 1),
(81, 'CG_5baa69a8acd4b', 1, '38724.00', 1),
(82, 'CG_5baaa23b6ef4d', 1, '27050.00', 1),
(83, 'CG_5babdd6b7625c', 1, '43428.00', 1),
(84, 'CG_5bac03333309d', 1, '33241.00', 1),
(85, 'CG_5bac169f0a9b0', 1, '301655.00', 1),
(86, 'CG_5bad1beb42074', 1, '81709.00', 1),
(88, 'CG_5bad474d63d1f', 1, '7143.00', 1),
(89, 'CG_5bad49e6af90c', 1, '79562.00', 1),
(90, 'CG_5bae999b0c7c2', 1, '70966.00', 1),
(91, 'CG_5baebfd1c1095', 1, '89435.00', 1),
(92, 'CG_5bb27ea51773e', 2, '62149.00', 1),
(93, 'CG_5bb295dc40c38', 1, '17919.00', 1),
(94, 'CG_5bb3b0201ffaf', 1, '187431.00', 1),
(95, 'CG_5bb3daa59f8e0', 1, '47889.00', 1),
(97, 'CG_5bb3f78c3aad6', 1, '22265.00', 1),
(98, 'CG_5bb5583a0efbf', 1, '24502.00', 1),
(100, 'CG_5bb7b74838067', 1, '186888.00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `subcategoria` varchar(150) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `precio` varchar(10) NOT NULL,
  `precio_iva` varchar(10) NOT NULL,
  `tipo` varchar(100) DEFAULT NULL,
  `state` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `categoria`, `subcategoria`, `nombre`, `precio`, `precio_iva`, `tipo`, `state`) VALUES
(1, 'Alimentos', 'Desayuno', 'Desayuno', '158.73', '200', 'Normal', 1),
(2, 'Alimentos', 'Desayuno', 'Desayuno Buffet', '174.60', '220', 'Buffet', 1),
(3, 'Alimentos', 'Comida', 'Comida Sencilla', '186.51', '235', 'Normal', 1),
(4, 'Alimentos', 'Comida', 'Comida 2 Tiempos', '261.90', '330', 'Normal', 1),
(5, 'Alimentos', 'Comida', 'Comida 3 Tiempos', '293.65', '370', 'Normal', 1),
(6, 'Alimentos', 'Comida', 'Comida Parrillada', '357.14', '450', 'Normal', 1),
(7, 'Alimentos', 'Comida', 'Comida Buffet', '234.13', '295', 'Buffet', 1),
(8, 'Alimentos', 'Comida', 'Comida Buffet Norteño', '416.67', '525', 'Buffet', 1),
(9, 'Alimentos', 'Comida', 'Comida Buffet Mexicano O Taquiza', '309.52', '390', 'Buffet', 1),
(11, 'Alimentos', 'Cena', 'Cena Sencilla', '186.51', '235', 'Normal', 1),
(12, 'Alimentos', 'Cena', 'Cena 2 Tiempos', '261.90', '330', 'Normal', 1),
(13, 'Alimentos', 'Cena', 'Cena 3 Tiempos', '293.65', '370', 'Normal', 1),
(14, 'Alimentos', 'Cena', 'Cena Parrillada', '357.14', '450', 'Normal', 1),
(15, 'Alimentos', 'Cena', 'Cena Buffet', '234.13', '295', 'Buffet', 1),
(16, 'Alimentos', 'Cena', 'Cena Buffet Norteño', '416.67', '525', 'Buffet', 1),
(17, 'Alimentos', 'Cena', 'Cena Buffet Mexicano O Taquiza', '309.52', '390', 'Buffet', 1),
(19, 'Servicios', 'Coffe Break Tradicional', 'Medio Dia Coffe Break', '95.24', '120', '', 1),
(20, 'Servicios', 'Coffe Break Tradicional', 'Dia Completo Coffe Break', '190.48', '240', '', 1),
(21, 'Servicios', 'Coffe Break Tradicional', 'Servicios Adicionales', '83.33', '105', '', 1),
(22, 'Servicios', 'Box Lunch', 'Box Lunch Op. 1', '123.02', '155', '', 1),
(23, 'Servicios', 'Box Lunch', 'Box Lunch Op. 2', '154.76', '195', '', 1),
(24, 'Precios Generales', 'Equipo Audiovisual', 'Infocus', '1289.68', '1625', '', 1),
(25, 'Precios Generales', 'Equipo Audiovisual', 'Equipo de Sonido', '1309.52', '1650', '', 1),
(26, 'Precios Generales', 'Equipo Audiovisual', 'Microfono Adicional', '317.46', '400', '', 1),
(27, 'Precios Generales', 'Renta de Salon sin Coffe Break', 'Pinos, Sauces', '1984.13', '2500', '', 1),
(28, 'Precios Generales', 'Renta de Salon sin Coffe Break', 'Fresnos', '5555.56', '7000', '', 1),
(29, 'Precios Generales', 'Renta de Salon sin Coffe Break', 'Casa Club (Medio)', '10714.29', '13500', '', 1),
(30, 'Precios Generales', 'Renta de Salon sin Coffe Break', 'Casa Club (Completo)', '21428.57', '27000', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `correo` varchar(70) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `usuario` varchar(150) NOT NULL,
  `password` varchar(250) NOT NULL,
  `contrasena` varchar(60) NOT NULL,
  `token` longtext NOT NULL,
  `rol` varchar(50) NOT NULL,
  `state` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `correo`, `telefono`, `foto`, `usuario`, `password`, `contrasena`, `token`, `rol`, `state`) VALUES
(1, 'Ing. Ignacio', 'Martinez Castañeda', 'ventas@rincondelmontero.com', '(871)316-71-13', 'Ing. Ignacio_Martinez Catañeda_20-48.png', 'ignacio', '$2y$12$DhmUpRiR5bqXy5S8xgtoAOXCP0tDeYqLMsRjX5lm6Fe3hvGcC7fEW', 'RM8DCTDE', '89f6be0a798c52ebb1194efdf964a69fd8ee4e6c966095edb8f34f9328675532fc015bf54634c2ce06657775d711c1c1a36d8426818eae048cd1a724d8ad6a977a3405f6436cf6b89c0b802113b3a3fc5b8ca0bfa769075e2152f42de0949dfe5ecf5656ecd988edfcc4088f32a04dcc51026e8fa556c3fe4e62dac38ab7ffc4', 'vendedor', 1),
(2, 'Nayeli', 'Sustaita Hernandez', 'nayeli.sustaita@rincondelmontero.com', '(842)423-88-97', 'Nayeli_Sustaita Hernandez_17-18.jpg', 'nayeli', '$2y$12$lbzDYUWG4NwwPMWNVSblmOJ3GBdZ2cPxBoIU.cYzGwMm4n1JeFYd6', 'RMC680N5', '80aac1c8e973710d6199ce762cd917b961e323b3b6e4d8a616a4151ac515a02276987af6839221ec26a3d4d19ae966ca445e72c6337d7397f44d26e7cb12115668a4fd2489e05321aafdacb4fa9d55187bcda349fd23fd4fa16f855d4857636b936d8fe2353287077e61bee38a4be80848fe917f0ef058d727f27f0916eae1b0', 'usuario', 1),
(3, 'Silvia', 'Montes Escobedo', 'smontes@rincondelmontero.com', '(871)316-98-12', 'Silvia_Montes Escobedo_18-40.jpg', 'silvia', '$2y$12$YVe09epIv1Ru.kgBCyrZcuryC6xqcVpqRiTDS943tNWRHobx2CYU.', 'RMND6RM5', 'a7f5db88f6d67bc4d77cd373316181dd91b9170ce3e2c372412e35ebc3b63764ef0a2c727bc247511a7608a003e9996ecc5916f8c74b61dcdb8dbe12522531c035a62a54533fdd13ab808663676d156f447580be7ca9e19a68e46164304ff5d059c9b65f4549f7102758ddda66ff4f4baf8e9efc5d02b02788dd4611f08c24cc', 'usuario', 1),
(4, 'Evelyn', 'Rodriguez Alvarado', 'reservaciones@rincondelmontero.com', '(844)283-28-55', 'Evelyn_Rodriguez Alvarado_19-48.jpg', 'evelyn', '$2y$12$7xpJp7REDfdkrwUw3g1NBuG5OtVhujpMKzUiULsQJX7tVorOPi4.C', 'RMNOBDC30', '1cc5af581c8d5241c4dd68970688f9bd50459a9a10c109813dbacb210bf7517e2c9e728b130435740695f327561bd05c3dd49fc136e5392cfd4c9692976e7bb1df65a631bb87b3b54a34b853c9a11ce1b77e32b8a43510e57cb7f2b2b1742077d362346fe267abc1edb8b86169b8237ce59b4f88e7a22f1c93f4ab5a687dab43', 'usuario', 1),
(5, 'Karely', 'Olmos Lara', 'karely.olmos@rincondelmontero.com', '(842)108-00-70', 'Karely_Olmos Lara_05-12.jpg', 'karely', '$2y$12$9AlcDCDozspRdfO2wViFiuIEt0pPrKxgUaogDZKzWQT/KnRn562fq', 'karely olmos', 'd725a6df9712e9e2d53688eb80f94433ad584946c564663c0a20cf39f4156f4c2b15311f81eb345ed8f2d1722ef38e36ddc5f2fd98526e6b8a36d9cbf24de7785aacc6f0e0c4c42845fbd18816f7db8e6ae4dd1564e6da49b044e40ed2238bc5e9805d962d44ffeb0d263dc84a8b3c070b3a9ebf019684fb343e48078b573c4c', 'admin', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ayb`
--
ALTER TABLE `ayb`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cotizacion_dia`
--
ALTER TABLE `cotizacion_dia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ayb`
--
ALTER TABLE `ayb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cotizaciones`
--
ALTER TABLE `cotizaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT de la tabla `cotizacion_dia`
--
ALTER TABLE `cotizacion_dia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1541;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `extras`
--
ALTER TABLE `extras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
