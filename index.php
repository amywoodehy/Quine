<!DOCTYPE html>
<html lang="ru">
<head>
	<title>Individual work 1</title>
	<link rel="stylesheet" href="css/inwork.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300&subset=latin,cyrillic,cyrillic-ext' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">

	<!-- meta -->
	<meta name="Keywords" content="Квайн, Куайн, Мак, Класки, МакКласки, калькулятор, КГТУ, Кыргызстан, теория автоматов, автоматы, алгоритм, минимизация, метод минимизации">
	<meta name="author" content="Amy Woodehy" />
	<meta name="description" content="Метод минимизации Квайна-МакКласки" />
	<meta name="document-state" content="Dynamic" />
	<meta name="revisit" content="14" />
	<meta name="robots" content="all" />
	<meta http-equiv="content-language" content="ru" />
	<meta http-equiv="Content-Style-Type" content="text/css">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


</head>
<body>
<div id="page-wrapper">
	<div id="page">
		<header>
			<h1>Метод минимизации Квайна—Мак-Класки</h1>
			<div style="border-top: 1px solid #ddd">
			<p>
			<b>Метод Куайна—Мак-Класки </b>— табличный метод минимизации булевых функций, предложенный Уиллардом Куайном и усовершенствованный Эдвардом Мак-Класки. Представляет собой попытку избавиться от недостатков метода Куайна.
			</p>
			<p><b>Метод Квайна</b> — способ представления функции в ДНФ или КНФ с минимальным количеством членов и минимальным набором переменных.Преобразование функции можно разделить на два этапа:
			<ul>
				<li>на первом этапе осуществляется переход от канонической формы (СДНФ или СКНФ) к так называемой сокращённой форме;</li>
				<li>на втором этапе — переход от сокращённой формы к минимальной форме.</li>
			</ul>
			Source: <a href="https://ru.wikipedia.org/wiki/%D0%9C%D0%B8%D0%BD%D0%B8%D0%BC%D0%B8%D0%B7%D0%B0%D1%86%D0%B8%D1%8F_%D0%BB%D0%BE%D0%B3%D0%B8%D1%87%D0%B5%D1%81%D0%BA%D0%B8%D1%85_%D1%84%D1%83%D0%BD%D0%BA%D1%86%D0%B8%D0%B9_%D0%BC%D0%B5%D1%82%D0%BE%D0%B4%D0%BE%D0%BC_%D0%9A%D1%83%D0%B0%D0%B9%D0%BD%D0%B0">Wiki.com</a>
			</p>
		</header>

		<div id="input">
			<form method="post">
				<p><b>Введите строку с числами: </b><input type="text" name="input_string" style="width: 99.5%">
				<input type="submit" value="Выполнить" style="float: right; width: 100px; height: 50px; font-style: italic;">
				<p><i>Чтобы все сгенерировалось случайно, оставьте строку пустой</i></p>
				
				<p>Вывести таблицу истинности
				<input type="checkbox" name="write-table">
				<p>Вывести минтермы
				<input type="checkbox" name="write-minterm" >
				<p>Вывести кубы
				<input type="checkbox" name="write-cube" checked="checked">
				<p>Вывести конечную функцию
				<input type="checkbox" name="write-min-func">
				
				</p>
			</form>
		</div>
		<div id="content">
			<?php include_once 'ByteClass.php';
			$obj = new ByteSentence($_POST['input_string']);
			echo $obj->write_function();
			if($_POST['write-table'] == "on")
				echo $obj->write_table();
			if($_POST['write-cube'] == "on")
				echo $obj->write_all_cubes();
			// echo $obj->write_cube(1);
			?>
		</div>
	</div>
	<footer>
		<img src="logo.jpg" alt="kstu" class="left">
		<img src="logo2.jpg" alt="Computer Science and Engineering" class="right">
		<p>Кыргызский Государственный Технический Университет</p>
		<p>Кафедра Информатики и Вычислительной Техники</p>
		<p>Метод минимизации 2014г.</p>
		<p>
		<a href="mailto:amywoodehy@gmail.com" style="text-decoration: none">AmyWoodehy@gmail.com</a> | <a href="mailto:google@gmail.com" style="text-decoration: none">google@gmail.com</a> | <a href="mailto:google@gmail.com" style="text-decoration: none">google@gmail.com</a>
		</p>
		
		<!-- можете дописать свои ящики и имена -->
	</footer>
</div>
</body>
</html>