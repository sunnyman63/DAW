-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-11-2021 a las 12:55:33
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `verequiz`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion`
--

CREATE TABLE `clasificacion` (
  `nombreUsu` varchar(100) NOT NULL,
  `puntuacion` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `pregunta` varchar(300) NOT NULL,
  `respuesta1` varchar(100) NOT NULL,
  `respuesta2` varchar(100) NOT NULL,
  `respuesta3` varchar(100) NOT NULL,
  `respuesta4` varchar(100) NOT NULL,
  `respuestaCorrecta` varchar(10) NOT NULL,
  `categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `pregunta`, `respuesta1`, `respuesta2`, `respuesta3`, `respuesta4`, `respuestaCorrecta`, `categoria`) VALUES
(1, '¿Quién escribió \'Azazel\'?', 'Isaac Asimov', 'Lewis Carroll', 'Terrance Hambury White', 'George R. R. Martin', 'respuesta1', 'Arte'),
(2, '¿En qué isla vivía Otelo?', 'Skorpios', 'Creta', 'Ítaca', 'Icaria', 'respuesta2', 'Arte'),
(3, '¿Cuál es el nombre del primer gran poema épico de la literatura inglesa?', 'El paraiso Perdido', 'Widsith', 'Beowulf', 'El Mensaje del Marido', 'respuesta3', 'Arte'),
(4, '¿Quién pintó \'Mujer mirando por la ventana\'?', 'Pablo Picasso', 'Vincent Van Gogh', 'Rembrandt', 'Salvador Dalí', 'respuesta4', 'Arte'),
(5, '¿En qué ciudad nació el pintor y escultor Joan Miro?', 'Barcelona', 'Madrid', 'Valencia', 'Vigo', 'respuesta1', 'Arte'),
(6, '¿Qué usamos para diluir los colores de las acuarelas?', 'Aceite', 'Agua', 'Agua oxigenada', 'Disolvente', 'respuesta2', 'Arte'),
(7, '¿Cuál de los siguientes personajes no aparece en la portada del álbum Sgt. Pepper\'s Lonely Hearts Club Band, de la banda británica The Beatles?', 'Oscar Wilde', 'John Lennon', 'Bob Marley', 'Albert Einstein', 'respuesta3', 'Arte'),
(8, '¿Cuál es el baile popular de Aragón?', 'Samba', 'Sevillana', 'Sardana', 'Jota', 'respuesta4', 'Arte'),
(9, '¿En qué año se suicidó Van Gogh?', '1890', '1899', '1870', '1901', 'respuesta1', 'Arte'),
(10, '¿Cuál es el baile típico de Galicia?', 'Paso Doble', 'Muiñeira', 'Bolero', 'Cachucha', 'respuesta2', 'Arte'),
(11, '¿Quién escribió La Divina Comedia?', 'Gustavo Adolfo Bécquer', 'Benedetti', 'Dante Alighieri', 'Rafael Alberti', 'respuesta3', 'Arte'),
(12, '¿Cuántas cuerdas suele tener un bajo eléctrico?', 'Cinco', 'Nueve', 'Seis', 'Cuatro', 'respuesta4', 'Arte'),
(13, '¿Quién escribió \"El Ejército Negro\"?', 'Santiago García-Clairac', 'CS Lewis', 'JRR Tolkien', 'Diana Wynne Jones', 'respuesta1', 'Arte'),
(14, '¿Cuál de las siguientes obras fue escrita por Wolfgang Amadeus Mozart?', 'Las Cuatro Estaciones', 'Réquiem', 'El Mesías', 'La 9º Sinfonia', 'respuesta2', 'Arte'),
(15, '¿Para qué sirve la paleta?', 'Para chuparla', 'Para darle a la pelota', 'Para mezclar pinturas', 'Para cavar', 'respuesta3', 'Arte'),
(16, '¿Quién escribió el poema romano, Las Metamorfosis?', 'Batilo', 'Prudencio', 'Cayo Valgio Rufo', 'Ovidio', 'respuesta4', 'Arte'),
(17, '¿Qué ruta se hace en honor al poeta Miguel Hernández?', 'La senda del poeta', 'Cahorros del Río Chillar', 'Ruta de los Pantaneros en Chulilla', 'Camí de Cavalls', 'respuesta1', 'Arte'),
(18, '¿Cuántos anillos fueron creados por Sauron para los Señores Enanos en el Señor de los Anillos?', 'Cinco', 'Siete', 'Dos', 'Cuatro', 'respuesta2', 'Arte'),
(19, '¿Según el cuento de \"el principito\" cuál fue el séptimo planeta que visitó?', 'El Planeta del Rey', 'El Planeta del Bebedor', 'El planeta tierra', 'El Planeta del Geógrafo', 'respuesta3', 'Arte'),
(20, '¿Qué tendencia musical es la que más incursiona en Jamaica?', 'Pop', 'Rock', 'Reggaeton', 'Reggae', 'respuesta4', 'Arte'),
(21, '¿Cuál de las siguientes enfermedades es muy común en los mayores por la disminución de la densidad de los huesos?', 'Osteoporosis', 'Tumores Óseos', 'Ostemielitis', 'Acromegalia', 'respuesta1', 'Ciencia'),
(22, '¿Qué parte del cuerpo tiene 27 huesos y 35 músculos?', 'Pie', 'Mano', 'Cabeza', 'Torso', 'respuesta2', 'Ciencia'),
(23, '¿Cuál de estos animales es endémico de Colombia?', 'Tamarino Labiado', 'Delfín del amazonas', 'Titi gris', 'Guanaco', 'respuesta3', 'Ciencia'),
(24, '¿En matemáticas, ¿qué es 3,14?', 'e', 'Avogadro', 'Logaritmo', 'Pi', 'respuesta4', 'Ciencia'),
(25, '¿Qué animal puede correr sobre el agua?', 'Lagarto basilisco', 'Guepardo', 'Antílope', 'Rana Toro', 'respuesta1', 'Ciencia'),
(26, '¿Por qué vía parenteral se obtiene una biodisponibilidad del 100 por cien del fármaco?', 'Intramuscular', 'Intravenosa', 'Subcutánea', 'Intradérmica', 'respuesta2', 'Ciencia'),
(27, '¿Cuál es la fórmula química del ácido clorhídrico?', 'C2H5OH', 'CaO', 'HCl', 'H2O', 'respuesta3', 'Ciencia'),
(28, '¿A cuántas personas podría matar un solo gramo de veneno de la cobra?', '200', '10', '80', '150', 'respuesta4', 'Ciencia'),
(29, '¿Qué órgano es el encargado de fabricar insulina?', 'Páncreas', 'Pulmón', 'Hígado', 'Riñón', 'respuesta1', 'Ciencia'),
(30, '¿Qué número equivale al 16 en hexadecimal?', '2', '10', '16', '8', 'respuesta2', 'Ciencia'),
(31, '¿Cuántas vertebras forman la columna vertebral humana?', '30', '42', '33', '24', 'respuesta3', 'Ciencia'),
(32, '¿Qué compañía multinacional compró al sistema de mensajería WhatsApp?', 'Apple', 'Samsung', 'Twiter', 'Facebook', 'respuesta4', 'Ciencia'),
(33, '¿Cómo se llaman los vasos sanguíneos más finos?', 'Capilares', 'Arterias', 'Vénulas', 'Venas', 'respuesta1', 'Ciencia'),
(34, '¿Cómo se denomina a la nube que se encuentra a nivel de superficie?', 'Nube', 'Niebla', 'Cumulus', 'Cirrus', 'respuesta2', 'Ciencia'),
(35, '¿Cuántos millones de años se estima que le restan de vida a nuestro Sol?', '5000', '4500', '5500', '6000', 'respuesta3', 'Ciencia'),
(36, '¿Cuál es la hormona sexual masculina más importante?', 'Estrogenos', 'vasopresina', 'Glucoproteicas', 'Testosterona', 'respuesta4', 'Ciencia'),
(37, '¿Gracias a cuál de tus cinco sentidos puedes descodificar vibraciones en el aire?', 'Oído', 'Tacto', 'Olfato', 'Vista', 'respuesta1', 'Ciencia'),
(38, '¿De qué sustrato se nutre principalmente el cerebro?', 'Lipidos', 'Glucosa', 'Proteinas', 'Agua', 'respuesta2', 'Ciencia'),
(39, '¿Cuánto midió el hombre más alto del mundo (acreditado)?', '2.8m', '3m', '2.72m', '2.68', 'respuesta3', 'Ciencia'),
(40, '¿Qué virus se atacó con la primera vacuna?', 'Sarampion', 'Tuberculosis', 'Malaria', 'Viruela', 'respuesta4', 'Ciencia'),
(41, '¿Qué duración tiene un partido de fútbol que llega a la tanda de penaltis?', '120 minutos', '150 minutos', '100 minutos', '110 minutos', 'respuesta1', 'Deporte'),
(42, '¿En cuál de los siguientes deportes se puede tocar el balón con las manos?', 'Fútbol', 'Baloncesto', 'Tennis', 'Billar', 'respuesta2', 'Deporte'),
(43, '¿Quién es \'O Rei\'?', 'Maradona', 'Ronaldinho', 'Pelé', 'Messi', 'respuesta3', 'Deporte'),
(44, '¿Cuál es el nombre de pila del tenista Federer?', 'Rafa', 'Dimitri', 'Alfonso', 'Roger', 'respuesta4', 'Deporte'),
(45, 'Evgenia Kanaeva es la \'reina\' de...', 'Gimnasia rítmica', 'Tiro con Arco', 'Voleibol', 'Patinaje sobre Hielo', 'respuesta1', 'Deporte'),
(46, '¿Cómo se llama Iniesta?', 'Carlos', 'Andrés', 'Julian', 'Gerard', 'respuesta2', 'Deporte'),
(47, '¿A qué deporte pertenece la WWE?', 'Ciclismo', 'Atletismo', 'Lucha libre', 'Boxeo', 'respuesta3', 'Deporte'),
(48, '¿En qué país ganó Alemania su primer mundial de fútbol?', 'Alemania', 'Italia', 'Francia', 'Suiza', 'respuesta4', 'Deporte'),
(49, '¿En cuántos mundiales participó la selección de Inglaterra?', '14', '7', '2', '10', 'respuesta1', 'Deporte'),
(50, '¿Con qué deporte relacionarías a Aitor Osa?', 'Fútbol', 'Ciclismo', 'Baloncesto', 'Esgrima', 'respuesta2', 'Deporte'),
(51, '¿Quién ganó el mundial de 2010 en Sudáfrica?', 'Italia', 'Francia', 'España', 'Portugal', 'respuesta3', 'Deporte'),
(52, '¿Cuántos tiempos tiene un partido de baloncesto?', 'Dos', 'Ocho', 'Seis', 'Cuatro', 'respuesta4', 'Deporte'),
(53, '¿Cuál fue el único club español donde jugó El Piojo López?', 'Valencia CF', 'Barcelona FC', 'Real Betis', 'Atletico de Bilbao', 'respuesta1', 'Deporte'),
(54, '¿Qué deporte estamos viendo si el árbitro señala \"falta de rotación\"?', 'Baloncesto', 'Voleibol', 'Fútbol', 'Tennis', 'respuesta2', 'Deporte'),
(55, '¿Cuál es el salto más alto en caballo?', '3m', '2.1m', '1.20m', '1.7m', 'respuesta3', 'Deporte'),
(56, '¿Cuántos jugadores componen usualmente un equipo de rugby?', '10', '12', '23', '15', 'respuesta4', 'Deporte'),
(57, '¿Cómo se llama el lugar destinado a las carreras de caballos?', 'Hipódromo', 'Canódromo', 'Circuito', 'Cancha', 'respuesta1', 'Deporte'),
(58, '¿Cómo se llama la anotación de un tanto en el fútbol americano?', 'Gol', 'Touchdown', 'Ensallo', 'Canasta', 'respuesta2', 'Deporte'),
(59, '¿Quién ganó la Eurocopa 2000?', 'Alemania', 'España', 'Francia', 'Suiza', 'respuesta3', 'Deporte'),
(60, '¿Quién tiene más balones de oro?', 'Cristiano Ronaldo', 'Andrés Iniesta', 'Luka Modric', 'Lionel Messi', 'respuesta4', 'Deporte'),
(61, '¿Qué fruta es la casa de Bob Esponja?', 'Una Piña', 'Un Coco', 'Un Platano', 'Una Sandia', 'respuesta1', 'Entretenimiento'),
(62, '¿Quién es el marido de la actriz Angelina Jolie?', 'Javier Barden', 'Brad Pitt', 'Leonardo Dicaprio', 'Tom Holland', 'respuesta2', 'Entretenimiento'),
(63, '¿Cómo se llama la actriz que interpreta a una pequeña vampira en \"Entrevista con el vampiro\"?', 'Audrey Hepburn', 'Elle Fanning', 'Kirsten Dunst', 'Jennifer Lawrence', 'respuesta3', 'Entretenimiento'),
(64, '¿En el juego preguntados, de qué color es el muñeco de arte?', 'Amarillo', 'Verde', 'Azul', 'Rojo', 'respuesta4', 'Entretenimiento'),
(65, '¿En la serie Los Simpson de qué color son las perlas de Lisa?', 'Blancas', 'Amarillas', 'Cian', 'Violetas', 'respuesta1', 'Entretenimiento'),
(66, '¿Qué pedía el Espantapájaros al Mago de Oz en la película del mismo nombre?', 'Unos Brazos', 'Un cerebro', 'Un Corazón', 'Volver a Casa', 'respuesta2', 'Entretenimiento'),
(67, '¿Cómo se llama el vocalista de los Guns \"N\" Roses?', 'Slash', 'Rob Gardner', 'Axl Rose', 'Duff McKagan', 'respuesta3', 'Entretenimiento'),
(68, '¿Cómo se llama el juguete que es un cubo de colores el cual giran sus partes?', 'Kubric', 'Matic', 'Rompecabezas', 'Rubik', 'respuesta4', 'Entretenimiento'),
(69, '¿Cómo se llama el gremlin bueno de la película \"Gremlins\"?', 'Gizmo', 'Lazaro', 'Matias', 'Fligel', 'respuesta1', 'Entretenimiento'),
(70, '¿Cuál fue la primera película de Disney?', 'Cenicienta', 'Blancanieves', 'La Bella Durmiente', 'Pocahontas', 'respuesta2', 'Entretenimiento'),
(71, '¿En qué año se estrenó la película de Disney \"Pinocho\"?', '1899', '1958', '1940', '1932', 'respuesta3', 'Entretenimiento'),
(72, '¿En qué programa sale Sheldon Cooper?', 'Como Conocí a Vuestra Madre', 'Dos Hombres y Medio', 'Modern Family', 'The Big Bang Theory', 'respuesta4', 'Entretenimiento'),
(73, '¿De quién es la canción \"Cosas que suenan a triste\"?', 'Maldita Nerea', 'La Oreja de Van Gogh', 'Extremoduro', 'El Canto del Loco', 'respuesta1', 'Entretenimiento'),
(74, '¿Cómo se llama el programa de la Sexta presentado por Antonio García, en el que se revisa la actualidad?', 'El Hormiguero', 'Al Rojo Vivo', 'El Intermedio', 'Comando Actualidad', 'respuesta2', 'Entretenimiento'),
(75, '¿Cómo se llama el cangrejo de la película \"La sirenita\" de Walt Disney?', 'Juan Carlos', 'Miguel', 'Sebastián', 'Don Cangrejo', 'respuesta3', 'Entretenimiento'),
(76, '¿Cómo se llama el personaje de la mejor amiga de Mia Thermopolis en la película \"El Diario de la Princesa\"?', 'Samantha', 'Bethany', 'Rose', 'Lilly', 'respuesta4', 'Entretenimiento'),
(77, '----¿Qué famoso personaje animado sacaba inventos del futuro de su bolsillo mágico?', 'Doraemon', 'Gumball', 'Oliver', 'Inuyasha', 'respuesta1', 'Entretenimiento'),
(78, '¿Cuántas veces hay que nombrar a Beetlejuice para que aparezca?', '1', '3', '5', '2', 'respuesta2', 'Entretenimiento'),
(79, '¿Quién presenta el concurso \'Ahora Caigo\'?', 'Juanra Bonet', 'David Broncano', 'Arturo Valls', 'Carlos Sobera', 'respuesta3', 'Entretenimiento'),
(80, '¿Cómo se llama la cuarta película de Harry Potter?', 'El Prisionero de Azkaban', 'La Piedra Filosofal', 'La Orden del Fenix', 'El cáliz de fuego', 'respuesta4', 'Entretenimiento'),
(81, '¿Qué civilización antigua tenía faraones como gobernantes?', 'Egipcios', 'Romanos', 'Griegos', 'Otomanos', 'respuesta1', 'Historia'),
(82, '¿Qué país NO sudamericano estuvo involucrado en la guerra del Pacífico?', 'Francia', 'Inglaterra', 'España', 'Portugal', 'respuesta2', 'Historia'),
(83, '¿Cuándo se viaja por primera vez al espacio?', '1900', '1998', '1961', '1552', 'respuesta3', 'Historia'),
(84, '¿A qué pueblo derrotó Julio César?', 'Galo', 'Helvecio', 'Confederación Belga', 'Todas las respuestas son correctas', 'respuesta4', 'Historia'),
(85, '¿Cuándo se produjo la Batalla de Las Piedras?', '1811', '1800', '1820', '1797', 'respuesta1', 'Historia'),
(86, '¿Qué ciudad quedó partida en dos tras la Segunda Guerra Mundial?', 'Moscu', 'Berlín', 'Amsterdam', 'Madrid', 'respuesta2', 'Historia'),
(87, '¿En la antigua Grecia, como participaban en los juegos olímpicos?', 'En mallas', 'Bañados en Sangre', 'Desnudos', 'Con Sotana', 'respuesta3', 'Historia'),
(88, '¿Qué país reconoció Italia a través de los Pactos de Letrán de 1929?', 'Alemania', 'Andorra', 'Grecia', 'La Ciudad del Vaticano', 'respuesta4', 'Historia'),
(89, '¿Cómo se llama el burro de Sancho Panza?', 'Rucio', 'Rocinante', 'Santiago', 'Velocin', 'respuesta1', 'Historia'),
(90, '¿Cómo se decía en latín la famosa expresión \"La suerte está echada\"?', 'Carpe Diem', 'Alea Iacta Est', 'Ad Aeternam', 'Ad Astra', 'respuesta2', 'Historia'),
(91, '¿Por cuánto vendió Rusia a Alaska a los Estados Unidos?', '8.7 millones de dólares', '7 millones de dólares', '7.2 millones de dólares', '5 millones de dólares', 'respuesta3', 'Historia'),
(92, '¿Qué evento marca el fin de la prehistoria?', 'La Danza', 'La Religión', 'El Fuego', 'La escritura', 'respuesta4', 'Historia'),
(93, '¿Qué le fue devuelto a China el 1º de Julio de 1997?', 'Hong Kong', 'Pekín', 'Shanghái', 'Wuhan', 'respuesta1', 'Historia'),
(94, '¿Qué país comenzó la Segunda Guerra Mundial?', 'Japón', 'Alemania', 'Estados Unidos', 'Francia', 'respuesta2', 'Historia'),
(95, '¿Cuál de estos países no ha invadido nunca el Reino Unido?', 'España', 'Alemania', 'Bolivia', 'México', 'respuesta3', 'Historia'),
(96, '¿Qué ciudad fue capital de España en el siglo 17?', 'Vigo', 'Sevilla', 'Barcelona', 'Valladolid', 'respuesta4', 'Historia'),
(97, '¿Quién recibió en 2009 el Premio Nobel de la Paz?', 'Barack Obama', 'Donald Trump', 'JF Kennedy', 'Angela Merkel', 'respuesta1', 'Historia'),
(98, '¿Cuál era el nombre de pila de Lenin?', 'Patrik', 'Vladímir', 'Crhistof', 'Dimitri', 'respuesta2', 'Historia'),
(99, '¿De qué estaba fabricado originalmente el maquillaje blanco de las Geishas?', 'Cal', 'Carbon', 'Plomo', 'Polen', 'respuesta3', 'Historia'),
(100, '¿Cómo se llamaba el caballo de Alejandro Magno?', 'Manuel', 'Rocinante', 'Augusto', 'Bucéfalo', 'respuesta4', 'Historia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasenya` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `correo`, `contrasenya`) VALUES
('aromerop', 'aromp@gmail.com', '$2y$10$du1wq5vEbjo0sMsF49AY7O0gOYF7Ld8Yq4WCoZDbFPgVOMWu0P/Da'),
('master', 'alex@gmail.com', '$2y$10$sjsk1gLGDKT/Q4YNIdFU/.0ebZYvXx01iROtyf6tztPZYiEjXblhe');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  ADD KEY `nombreUsu` (`nombreUsu`,`puntuacion`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nombre`),
  ADD KEY `nombre` (`nombre`,`correo`,`contrasenya`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clasificacion`
--
ALTER TABLE `clasificacion`
  ADD CONSTRAINT `clasificacion_ibfk_1` FOREIGN KEY (`nombreUsu`) REFERENCES `usuario` (`nombre`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
