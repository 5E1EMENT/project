-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3307
-- Время создания: Ноя 27 2018 г., 12:05
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
(24, 18, 4, 1);

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
(13, 4, 'Test Field 40x40x8', 0, 0, 0, 44, 1238, 44),
(14, 2, 'Test Field 40x40x5', 1, 2, 3, 4, 1, 2),
(15, 3, 'Test Field 40x40x7', 1, 2, 3, 4, 4, 24),
(16, 1, 'Test Field 40x40x6', 1, 2, 3, 44, 1, 2);

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
(26, 1, 'https://youtube.com', 'youtube'),
(4, 3, 'https://coinmarketcap.com', 'cryptocurrecy'),
(5, 0, 'https://habr.ru', 'habr'),
(21, 5, '33', '4'),
(18, 5, '33', '5'),
(14, 4, 'asdasdd', 'sadsad');

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
(0, 1, 0, 0, 0, 0, 0, 0, 8);

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
(23, 1, 25);

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
(2, 'Ferum', '#B8860B');

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
  MODIFY `idcore` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID керна', AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `field`
--
ALTER TABLE `field`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `field_doc`
--
ALTER TABLE `field_doc`
  MODIFY `id_doc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `hole`
--
ALTER TABLE `hole`
  MODIFY `idhole` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=38;

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
  MODIFY `idmine` int(11) NOT NULL AUTO_INCREMENT COMMENT '№ полезного ископаемого', AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
