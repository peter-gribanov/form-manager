<?php
$form = 'C:8:"FormForm":8494:{a:2:{i:0;a:7:{s:6:"action";s:0:"";s:6:"method";s:4:"post";s:4:"name";s:16:"catalog_item_add";s:8:"template";s:8:".default";s:8:"required";b:1;s:12:"submit_title";s:27:"Добавить аниме";s:7:"buttons";a:1:{i:0;a:2:{i:0;s:28:"Автозаполнение";i:1;a:2:{s:4:"type";s:6:"submit";s:2:"id";s:21:"catalog-item-autofill";}}}}i:1;C:14:"FormCollection":8120:{a:2:{i:0;s:0:"";i:1;a:14:{i:0;C:8:"FormText":313:{a:7:{s:4:"name";s:12:"world_art_id";s:5:"title";s:31:"ID на сайте world-art.ru";s:7:"comment";s:0:"";s:7:"default";s:0:"";s:4:"view";a:2:{i:0;s:4:"text";i:1;a:1:{s:6:"length";i:6;}}s:7:"filters";a:2:{i:0;a:2:{i:0;s:3:"int";i:1;a:0:{}}i:1;a:2:{i:0;s:6:"length";i:1;a:1:{s:3:"max";i:6;}}}s:8:"required";b:0;}}i:1;C:10:"FormSelect":610:{a:7:{s:4:"name";s:4:"type";s:5:"title";s:17:"Тип аниме";s:7:"comment";s:0:"";s:7:"default";s:2:"tv";s:4:"view";a:2:{i:0;s:6:"select";i:1;a:3:{s:7:"use_key";b:0;s:14:"optionsByQuery";s:89:"SELECT LOWER(type_id) AS `key`, name AS `value` FROM catalog_item_type ORDER BY name DESC";s:7:"options";a:6:{s:2:"tv";s:17:"ТВ сериал";s:7:"feature";s:39:"Полнометражный фильм";s:10:"featurette";s:43:"Короткометражный фильм";s:3:"ova";s:3:"OVA";s:3:"ona";s:3:"ONA";s:3:"oav";s:3:"OAV";}}}s:7:"filters";a:1:{i:0;a:2:{i:0;s:6:"select";i:1;a:0:{}}}s:8:"required";b:0;}}i:2;C:8:"FormText":313:{a:7:{s:4:"name";s:7:"name_ru";s:5:"title";s:31:"Русское название";s:7:"comment";s:0:"";s:7:"default";s:0:"";s:4:"view";a:2:{i:0;s:4:"text";i:1;a:1:{s:6:"length";i:128;}}s:7:"filters";a:2:{i:0;a:2:{i:0;s:5:"empty";i:1;a:0:{}}i:1;a:2:{i:0;s:6:"length";i:1;a:1:{s:3:"max";i:128;}}}s:8:"required";b:1;}}i:3;C:8:"FormText":319:{a:7:{s:4:"name";s:7:"name_en";s:5:"title";s:37:"Английское название";s:7:"comment";s:0:"";s:7:"default";s:0:"";s:4:"view";a:2:{i:0;s:4:"text";i:1;a:1:{s:6:"length";i:128;}}s:7:"filters";a:2:{i:0;a:2:{i:0;s:5:"empty";i:1;a:0:{}}i:1;a:2:{i:0;s:6:"length";i:1;a:1:{s:3:"max";i:128;}}}s:8:"required";b:1;}}i:4;C:8:"FormText":365:{a:7:{s:4:"name";s:10:"date_start";s:5:"title";s:36:"Дата начала сериала";s:7:"comment";s:0:"";s:7:"default";s:10:"09.09.2011";s:4:"view";a:2:{i:0;s:4:"date";i:1;a:1:{s:6:"length";i:10;}}s:7:"filters";a:3:{i:0;a:2:{i:0;s:6:"length";i:1;a:1:{s:2:"eq";i:10;}}i:1;a:2:{i:0;s:4:"date";i:1;a:0:{}}i:2;a:2:{i:0;s:5:"empty";i:1;a:0:{}}}s:8:"required";b:1;}}i:5;C:8:"FormText":461:{a:7:{s:4:"name";s:8:"date_end";s:5:"title";s:44:"Дата завершения сериала";s:7:"comment";s:136:"Если сериал продолжает выпускаться или это не сериал оставьте поле пустым";s:7:"default";s:0:"";s:4:"view";a:2:{i:0;s:4:"date";i:1;a:1:{s:6:"length";i:10;}}s:7:"filters";a:2:{i:0;a:2:{i:0;s:6:"length";i:1;a:1:{s:2:"eq";i:10;}}i:1;a:2:{i:0;s:4:"date";i:1;a:0:{}}}s:8:"required";b:0;}}i:6;C:10:"FormSelect":1473:{a:7:{s:4:"name";s:5:"genre";s:5:"title";s:8:"Жанр";s:7:"comment";s:94:"Можно выбрать несколько жанров удерживая кнопку Ctrl";s:7:"default";s:0:"";s:4:"view";a:2:{i:0;s:6:"select";i:1;a:5:{s:7:"use_key";b:0;s:4:"size";i:5;s:8:"multiple";b:1;s:14:"optionsByQuery";s:81:"SELECT genre_id AS `key`, name AS `value` FROM `catalog_genres` ORDER BY name ASC";s:7:"options";a:35:{i:5;s:12:"Боевик";i:6;s:31:"Боевые искусства";i:7;s:10:"Война";i:8;s:16:"Детектив";i:9;s:17:"Для детей";i:4;s:10:"Драма";i:10;s:14:"История";i:2;s:14:"Комедия";i:11;s:19:"Махо-сёдзё";i:12;s:8:"Меха";i:13;s:14:"Мистика";i:14;s:22:"Музыкальный";i:15;s:30:"Образовательный";i:16;s:14:"Пародия";i:17;s:28:"Повседневность";i:18;s:14:"Полиция";i:1;s:22:"Приключения";i:19;s:18:"Романтика";i:20;s:35:"Самурайский боевик";i:21;s:10:"Сёдзё";i:22;s:15:"Сёдзё-ай";i:23;s:10:"Сёнэн";i:24;s:15:"Сёнэн-ай";i:47;s:12:"Сказка";i:48;s:10:"Спорт";i:49;s:14:"Триллер";i:54;s:10:"Ужасы";i:3;s:20:"Фантастика";i:51;s:14:"Фэнтези";i:55;s:12:"Хентай";i:50;s:10:"Школа";i:52;s:14:"Эротика";i:53;s:8:"Этти";i:56;s:6:"Юри";i:57;s:6:"Яой";}}}s:7:"filters";a:1:{i:0;a:2:{i:0;s:6:"select";i:1;a:0:{}}}s:8:"required";b:0;}}i:7;C:10:"FormSelect":1170:{a:7:{s:4:"name";s:10:"production";s:5:"title";s:24:"Производство";s:7:"comment";s:0:"";s:7:"default";s:2:"jp";s:4:"view";a:2:{i:0;s:6:"select";i:1;a:3:{s:7:"use_key";b:0;s:14:"optionsByQuery";s:82:"SELECT country_id AS `key`, name AS `value` FROM catalog_country ORDER BY name ASC";s:7:"options";a:25:{s:2:"au";s:18:"Австралия";s:2:"at";s:14:"Австрия";s:2:"ar";s:18:"Аргентина";s:2:"be";s:14:"Бельгия";s:2:"gb";s:28:"Великобритания";s:2:"hu";s:14:"Венгрия";s:2:"de";s:16:"Германия";s:2:"in";s:10:"Индия";s:2:"es";s:14:"Испания";s:2:"it";s:12:"Италия";s:2:"ca";s:12:"Канада";s:2:"cn";s:10:"Китай";s:2:"pl";s:12:"Польша";s:2:"ru";s:12:"Россия";s:2:"us";s:6:"США";s:2:"uz";s:20:"Узбекистан";s:2:"ua";s:14:"Украина";s:2:"fi";s:18:"Финляндия";s:2:"fr";s:14:"Франция";s:2:"cz";s:10:"Чехия";s:2:"cl";s:8:"Чили";s:2:"se";s:12:"Швеция";s:2:"ee";s:14:"Эстония";s:2:"kr";s:21:"Южная Корея";s:2:"jp";s:12:"Япония";}}}s:7:"filters";a:1:{i:0;a:2:{i:0;s:6:"select";i:1;a:0:{}}}s:8:"required";b:0;}}i:8;C:8:"FormText":450:{a:7:{s:4:"name";s:8:"duration";s:5:"title";s:34:"Продолжительность";s:7:"comment";s:139:"Укажите продолжительность одной серии, если это сериал или фильма в минутах";s:7:"default";i:25;s:4:"view";a:2:{i:0;s:4:"text";i:1;a:1:{s:6:"length";i:3;}}s:7:"filters";a:2:{i:0;a:2:{i:0;s:3:"int";i:1;a:0:{}}i:1;a:2:{i:0;s:6:"length";i:1;a:1:{s:3:"max";i:3;}}}s:8:"required";b:0;}}i:9;C:11:"FormElement":284:{a:7:{s:4:"name";s:11:"description";s:5:"title";s:35:"Краткое содержание";s:7:"comment";s:0:"";s:7:"default";s:0:"";s:4:"view";a:2:{i:0;s:8:"textarea";i:1;a:2:{s:4:"cols";i:35;s:4:"rows";i:6;}}s:7:"filters";a:1:{i:0;a:2:{i:0;s:4:"null";i:1;a:0:{}}}s:8:"required";b:0;}}i:10;C:20:"FormNestedCollection":704:{a:2:{i:0;s:0:"";i:1;a:2:{i:0;C:8:"FormText":323:{a:7:{s:4:"name";s:9:"image-url";s:5:"title";s:3:"URL";s:7:"comment";s:72:"Загрузка картинки с удаленного сервера";s:7:"default";s:0:"";s:4:"view";a:2:{i:0;s:4:"text";i:1;a:1:{s:6:"length";i:256;}}s:7:"filters";a:1:{i:0;a:2:{i:0;s:6:"length";i:1;a:1:{s:3:"max";i:256;}}}s:8:"required";b:0;}}i:1;C:11:"FormElement":300:{a:7:{s:4:"name";s:10:"image-file";s:5:"title";s:18:"Зугрузить";s:7:"comment";s:68:"Загрузка картинки с локальной машины";s:7:"default";s:0:"";s:4:"view";a:2:{i:0;s:4:"file";i:1;a:0:{}}s:7:"filters";a:1:{i:0;a:2:{i:0;s:4:"null";i:1;a:0:{}}}s:8:"required";b:0;}}}}}i:11;C:8:"FormText":377:{a:7:{s:4:"name";s:4:"path";s:5:"title";s:24:"Путь на диске";s:7:"comment";s:73:"Полный путь расположения аниме на диске";s:7:"default";s:0:"";s:4:"view";a:2:{i:0;s:4:"text";i:1;a:1:{s:6:"length";i:256;}}s:7:"filters";a:2:{i:0;a:2:{i:0;s:5:"empty";i:1;a:0:{}}i:1;a:2:{i:0;s:6:"length";i:1;a:1:{s:3:"max";i:256;}}}s:8:"required";b:1;}}i:12;C:8:"FormText":337:{a:7:{s:4:"name";s:10:"storage_id";s:5:"title";s:21:"ID хранилища";s:7:"comment";s:0:"";s:7:"default";s:0:"";s:4:"view";a:2:{i:0;s:4:"text";i:1;a:1:{s:6:"length";i:2;}}s:7:"filters";a:3:{i:0;a:2:{i:0;s:5:"empty";i:1;a:0:{}}i:1;a:2:{i:0;s:3:"int";i:1;a:0:{}}i:2;a:2:{i:0;s:6:"length";i:1;a:1:{s:3:"max";i:2;}}}s:8:"required";b:1;}}i:13;C:11:"FormElement":530:{a:7:{s:4:"name";s:8:"episodes";s:5:"title";s:29:"Список эпизодов";s:7:"comment";s:253:"Список эпизодов, по одному на каждую строчку. Серии можно разбивать на сезоны. Пример описания сезона: Первый сезон "Ranma 1/2" (c 15.04.1989 по 16.09.1989)";s:7:"default";s:0:"";s:4:"view";a:2:{i:0;s:8:"textarea";i:1;a:2:{s:4:"cols";i:35;s:4:"rows";i:12;}}s:7:"filters";a:1:{i:0;a:2:{i:0;s:4:"null";i:1;a:0:{}}}s:8:"required";b:0;}}}}}}}';