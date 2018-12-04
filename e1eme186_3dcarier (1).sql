-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Дек 04 2018 г., 10:50
-- Версия сервера: 5.6.41
-- Версия PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `e1eme186_3dcarier`
--

-- --------------------------------------------------------

--
-- Структура таблицы `block`
--

CREATE TABLE `block` (
  ` nblock` int(11) NOT NULL COMMENT '№ блока',
  `x` int(11) NOT NULL COMMENT 'Координата x',
  `y` int(11) NOT NULL COMMENT 'Координата y',
  `z` int(11) NOT NULL COMMENT 'Координата z',
  `nmod` int(11) NOT NULL COMMENT '№ модели'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `block`
--

INSERT INTO `block` (` nblock`, `x`, `y`, `z`, `nmod`) VALUES
(1, 170, 200, 50, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `blockmap`
--

CREATE TABLE `blockmap` (
  `nmap` int(11) NOT NULL COMMENT '№ блока разреза или карты',
  `namemap` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Название разрера или карты',
  `xy` int(11) NOT NULL COMMENT 'Координата xy',
  `z` int(11) NOT NULL COMMENT 'Координата z'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Блок разреза или карты';

--
-- Дамп данных таблицы `blockmap`
--

INSERT INTO `blockmap` (`nmap`, `namemap`, `xy`, `z`) VALUES
(1, 'Map Sokolovsko-sarbaiskoe', 10, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `core`
--

CREATE TABLE `core` (
  `idcore` int(11) NOT NULL COMMENT 'ID керна',
  `idhole` int(11) NOT NULL COMMENT 'Номер скважины',
  `ncore` int(11) NOT NULL COMMENT '№ керна',
  `l` int(11) NOT NULL COMMENT 'Длина керна'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Керн';

--
-- Дамп данных таблицы `core`
--

INSERT INTO `core` (`idcore`, `idhole`, `ncore`, `l`) VALUES
(1, 6, 3, 1),
(2, 6, 4, 1),
(3, 6, 5, 1),
(4, 7, 4, 1),
(5, 7, 5, 1),
(6, 8, 4, 1),
(7, 8, 5, 1),
(8, 11, 3, 1),
(9, 11, 4, 1),
(10, 11, 5, 1),
(11, 11, 6, 1),
(12, 11, 7, 1),
(13, 12, 2, 1),
(14, 12, 3, 1),
(15, 12, 4, 1),
(16, 13, 3, 1),
(17, 13, 4, 1),
(18, 13, 5, 1),
(19, 16, 4, 1),
(20, 17, 3, 1),
(22, 17, 4, 1),
(23, 18, 3, 1),
(24, 18, 4, 1),
(28, 7, 6, 2),
(34, 44, 4, 1),
(35, 45, 3, 1),
(36, 45, 4, 1),
(37, 45, 5, 1),
(38, 45, 6, 1),
(39, 49, 4, 1),
(40, 50, 3, 1),
(41, 50, 4, 1),
(42, 50, 5, 1),
(43, 50, 6, 1),
(44, 54, 3, 1),
(45, 54, 4, 1),
(46, 54, 5, 1),
(47, 54, 6, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `field`
--

CREATE TABLE `field` (
  `id` int(11) NOT NULL COMMENT 'id',
  `nfield` int(11) NOT NULL COMMENT '№ месторождения ',
  `namefield` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Имя месторождения',
  `x` int(11) NOT NULL COMMENT 'Х координата',
  `y` int(11) NOT NULL COMMENT 'Y координата',
  `z` int(11) NOT NULL COMMENT 'Z координата',
  `l` int(11) NOT NULL COMMENT 'Длина',
  `d` int(11) NOT NULL COMMENT 'Глубина',
  `w` int(11) NOT NULL COMMENT 'Ширина'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `field`
--

INSERT INTO `field` (`id`, `nfield`, `namefield`, `x`, `y`, `z`, `l`, `d`, `w`) VALUES
(13, 4, 'Test Field 40x40x8', 0, 0, 0, 40, 8, 40),
(14, 3, 'Test Field 3', 1, 2, 3, 4, 1, 2),
(15, 2, 'Test Field 2', 1, 2, 3, 4, 4, 24),
(16, 1, 'Test Field 1', 1, 2, 3, 44, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `field_doc`
--

CREATE TABLE `field_doc` (
  `id_doc` int(11) NOT NULL,
  `nfield` int(11) NOT NULL COMMENT '№ месторождения',
  `doc` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT 'Ссылка на документ',
  `doc_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT 'Описание документа'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `field_doc`
--

INSERT INTO `field_doc` (`id_doc`, `nfield`, `doc`, `doc_desc`) VALUES
(3, 2, 'https://mail.ru', 'mail'),
(4, 3, 'https://coinmarketcap.com', 'cryptocurrecy'),
(5, 0, 'https://habr.ru', 'habr'),
(21, 5, '33', '4'),
(18, 5, '33', '5'),
(39, 4, '1.pdf', 'Документ месторождения'),
(37, 4, '13jTH.png', 'Фотография месторождения'),
(35, 1, '22.pdf', 'pdf');

-- --------------------------------------------------------

--
-- Структура таблицы `hole`
--

CREATE TABLE `hole` (
  `idhole` int(11) NOT NULL COMMENT 'id',
  `nfield` int(11) NOT NULL COMMENT '№ месторождения',
  `nhole` int(11) NOT NULL COMMENT '№ cкважины',
  `x` int(11) NOT NULL COMMENT 'Х координата',
  `y` int(11) NOT NULL COMMENT 'Y координата',
  `z` int(11) NOT NULL COMMENT 'Z координата',
  `a` int(11) NOT NULL COMMENT 'Угол альфа',
  `b` int(11) NOT NULL COMMENT 'Угол бета',
  `d` int(11) NOT NULL COMMENT 'Глубина'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `hole`
--

INSERT INTO `hole` (`idhole`, `nfield`, `nhole`, `x`, `y`, `z`, `a`, `b`, `d`) VALUES
(7, 1, 7, 20, 10, 0, 0, 0, 0),
(6, 1, 6, 0, 10, 0, 0, 0, 8),
(4, 1, 4, 40, 0, 0, 0, 0, 8),
(3, 1, 3, 30, 0, 0, 0, 0, 8),
(2, 1, 2, 20, 0, 0, 0, 0, 8),
(1, 1, 1, 10, 0, 0, 0, 0, 8),
(0, 1, 0, 0, 0, 0, 0, 0, 8),
(38, 4, 1, 0, 0, 0, 0, 0, 8),
(39, 4, 2, 10, 0, 0, 0, 0, 8),
(40, 4, 3, 20, 0, 0, 0, 0, 8),
(41, 4, 4, 30, 0, 0, 0, 0, 8),
(42, 4, 5, 40, 0, 0, 0, 0, 8),
(43, 4, 6, 0, 10, 0, 0, 0, 8),
(44, 4, 7, 10, 10, 0, 0, 0, 8),
(45, 4, 8, 10, 20, 0, 0, 0, 8),
(46, 4, 9, 10, 30, 0, 0, 0, 0),
(47, 4, 10, 10, 40, 0, 0, 0, 8),
(48, 4, 11, 0, 20, 0, 0, 0, 8),
(49, 4, 12, 10, 20, 0, 0, 0, 8),
(50, 4, 13, 20, 20, 0, 0, 0, 8),
(51, 4, 14, 30, 20, 0, 0, 0, 8),
(52, 4, 15, 40, 20, 0, 0, 0, 8),
(53, 4, 16, 0, 30, 0, 0, 0, 8),
(54, 4, 17, 10, 30, 0, 0, 0, 8),
(55, 4, 18, 20, 30, 0, 0, 0, 8),
(56, 4, 19, 30, 30, 0, 0, 0, 8),
(57, 4, 20, 40, 30, 0, 0, 0, 8),
(58, 4, 21, 0, 40, 0, 0, 0, 8),
(59, 4, 22, 10, 40, 0, 0, 0, 8),
(60, 4, 23, 20, 40, 0, 0, 0, 8),
(61, 4, 24, 30, 40, 0, 0, 0, 8),
(62, 4, 25, 40, 40, 0, 0, 0, 8);

-- --------------------------------------------------------

--
-- Структура таблицы `holedoc`
--

CREATE TABLE `holedoc` (
  `nhole` int(11) NOT NULL COMMENT '№ скважины',
  `dochole` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Документы по скважине',
  `deschole` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT 'Описание скважины'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Скважина (документы)';

-- --------------------------------------------------------

--
-- Структура таблицы `linkcm`
--

CREATE TABLE `linkcm` (
  `idcore` int(11) NOT NULL,
  `idmine` int(11) NOT NULL,
  `perc` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Связь керн - полезные ископаемые';

--
-- Дамп данных таблицы `linkcm`
--

INSERT INTO `linkcm` (`idcore`, `idmine`, `perc`) VALUES
(1, 1, 25),
(2, 1, 25),
(3, 1, 25),
(4, 1, 50),
(5, 1, 50),
(6, 1, 25),
(7, 1, 25),
(8, 1, 25),
(9, 1, 25),
(10, 1, 25),
(11, 1, 25),
(12, 1, 25),
(13, 1, 50),
(14, 1, 50),
(15, 1, 50),
(16, 1, 50),
(17, 1, 50),
(18, 1, 50),
(19, 1, 25),
(20, 1, 50),
(21, 1, 50),
(22, 1, 25),
(23, 1, 25),
(28, 3, 25),
(29, 3, 50),
(30, 1, 25),
(31, 2, 50),
(32, 3, 50),
(33, 5, 25),
(34, 1, 25),
(35, 1, 50),
(36, 1, 50),
(37, 1, 50),
(38, 1, 25),
(39, 1, 25),
(40, 1, 50),
(41, 1, 25),
(42, 1, 50),
(43, 1, 25),
(44, 1, 25),
(45, 1, 25),
(46, 1, 25),
(47, 1, 50),
(48, 1, 50);

-- --------------------------------------------------------

--
-- Структура таблицы `map`
--

CREATE TABLE `map` (
  `nmod` int(11) NOT NULL COMMENT '№ 3d модели',
  `namemap` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Название разрера или карты',
  `h` int(11) NOT NULL COMMENT 'высота',
  `x1y1` int(11) NOT NULL COMMENT 'координата x1y1',
  `x2y2` int(11) NOT NULL COMMENT 'координата x2y2',
  `nfield` int(11) NOT NULL COMMENT '№ месторождения',
  `typemap` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Тип (разрер/карта)'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Разрез или карта';

--
-- Дамп данных таблицы `map`
--

INSERT INTO `map` (`nmod`, `namemap`, `h`, `x1y1`, `x2y2`, `nfield`, `typemap`) VALUES
(1, 'Map Sokolovsko-sarbaiskoe', 10, 0, 0, 1, 'Razrez');

-- --------------------------------------------------------

--
-- Структура таблицы `mine`
--

CREATE TABLE `mine` (
  `idmine` int(11) NOT NULL COMMENT '№ полезного ископаемого',
  `name` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Название полезного ископаемого',
  `clr` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Цвет отображения'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Полезные ископаемые';

--
-- Дамп данных таблицы `mine`
--

INSERT INTO `mine` (`idmine`, `name`, `clr`) VALUES
(1, 'Gold', '#DAA520'),
(2, 'Ferum', '#B8860B'),
(3, 'Platinum', '#FF7F50'),
(4, 'Cuprum', '#d142f4'),
(5, 'Сalcium', '#E0FFFF');

-- --------------------------------------------------------

--
-- Структура таблицы `model`
--

CREATE TABLE `model` (
  `nfield` int(11) NOT NULL,
  `nmod` int(11) NOT NULL COMMENT '№ модели',
  `namemod` varchar(255) COLLATE utf8_bin NOT NULL COMMENT 'Название 3D модели',
  `d` int(11) NOT NULL COMMENT 'Глубина',
  `l` int(11) NOT NULL COMMENT 'Длина',
  `w` int(11) NOT NULL COMMENT 'Ширина',
  `unitb` int(11) NOT NULL COMMENT 'Единичный объем блока'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Дамп данных таблицы `model`
--

INSERT INTO `model` (`nfield`, `nmod`, `namemod`, `d`, `l`, `w`, `unitb`) VALUES
(0, 3, 'Three', 2, 3, 4, 5),
(0, 1, 'One', 2, 3, 4, 5),
(2, 1, 'Lol', 2, 3, 4, 5),
(3, 1, 'dssd', 2, 3, 4, 5),
(1, 1, 'DAD', 2, 3, 4, 5),
(0, 3, 'Two', 2, 3, 5, 12),
(0, 4, 'Four', 1, 2, 3, 4),
(4, 1, 'BBB', 2, 3, 4, 5),
(2, 2, 'lol2', 5, 5, 5, 55);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (` nblock`);

--
-- Индексы таблицы `blockmap`
--
ALTER TABLE `blockmap`
  ADD PRIMARY KEY (`nmap`);

--
-- Индексы таблицы `core`
--
ALTER TABLE `core`
  ADD PRIMARY KEY (`idcore`);

--
-- Индексы таблицы `field`
--
ALTER TABLE `field`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `field_doc`
--
ALTER TABLE `field_doc`
  ADD PRIMARY KEY (`id_doc`);

--
-- Индексы таблицы `hole`
--
ALTER TABLE `hole`
  ADD PRIMARY KEY (`idhole`);

--
-- Индексы таблицы `holedoc`
--
ALTER TABLE `holedoc`
  ADD PRIMARY KEY (`nhole`);

--
-- Индексы таблицы `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`nmod`,`namemap`);

--
-- Индексы таблицы `mine`
--
ALTER TABLE `mine`
  ADD PRIMARY KEY (`idmine`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `block`
--
ALTER TABLE `block`
  MODIFY ` nblock` int(11) NOT NULL AUTO_INCREMENT COMMENT '№ блока', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `blockmap`
--
ALTER TABLE `blockmap`
  MODIFY `nmap` int(11) NOT NULL AUTO_INCREMENT COMMENT '№ блока разреза или карты', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `core`
--
ALTER TABLE `core`
  MODIFY `idcore` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID керна', AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT для таблицы `field`
--
ALTER TABLE `field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `field_doc`
--
ALTER TABLE `field_doc`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT для таблицы `hole`
--
ALTER TABLE `hole`
  MODIFY `idhole` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT для таблицы `holedoc`
--
ALTER TABLE `holedoc`
  MODIFY `nhole` int(11) NOT NULL AUTO_INCREMENT COMMENT '№ скважины';

--
-- AUTO_INCREMENT для таблицы `map`
--
ALTER TABLE `map`
  MODIFY `nmod` int(11) NOT NULL AUTO_INCREMENT COMMENT '№ 3d модели', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `mine`
--
ALTER TABLE `mine`
  MODIFY `idmine` int(11) NOT NULL AUTO_INCREMENT COMMENT '№ полезного ископаемого', AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
