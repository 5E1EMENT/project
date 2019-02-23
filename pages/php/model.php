<?php 


 require_once 'connection.php'; // подключаем скрипт

 //echo "XXX"; print_r ( 	$_SESSION);

 // подключаемся к серверу
 $link = mysqli_connect($host, $user, $password, $database)
     or die("Ошибка 0. Нет подключения к БД" . mysqli_error($link));

 // выполняем операции с базой данных
 $query ="SELECT nfield, namefield FROM field";
 	$result = mysqli_query($link, $query) or die("Ошибка 1 - Нет связи с таблицей nfield" . mysqli_error($link));

 // Выбор месторождения - ниспадающий список месторожденией из базы и кнопка
 	echo '<form class="model-choose" action ="3dmodel.php" method="GET">';
 	echo '<select class="form-control form-control-lg" name="sel1" >';
 	$temp = '<option> Выберите месторождение </option>';
 	while ($row = mysqli_fetch_array($result))
 	{
 		$temp.='<option>';
 		$temp.=$row['namefield'];
 		$temp.='</option>';
 	};
 	//mysql_free_result($result);
 	echo $temp;
 	echo '</select>';
 	echo '<input type="submit" class="btn btn-lg btn-info btn_add" name="sel_field" value="Открыть модели месторождения"/>';

 	echo '</form><BR>';


 // Add new model
 	if (isset($_GET["namemod"])&&isset($_GET["l"])&&isset($_GET["d"])&&isset($_GET["w"])&&isset($_GET["ub"])&&isset($_GET["nmod"]))
 	{
 		$namemod = strip_tags($_GET["namemod"]);
		$nmod = strip_tags($_GET["nmod"]);
 		$l = strip_tags($_GET["l"]);
 		$d = strip_tags($_GET["d"]);
 		$w = strip_tags($_GET["w"]);
 		$unitb = strip_tags($_GET["ub"]);
 		$query ="SELECT DISTINCT nfield, namefield  FROM field";
 		$result = mysqli_query($link, $query) or die("Ошибка 2 - Нет связи с таблицей nfield" . mysqli_error($link));
 		$s= $_SESSION['nf'];
 		//echo "S=", $s,'<br>';

 		while ($row = mysqli_fetch_array($result))
 		{
 			if ($row['namefield'] == $_SESSION['nf'])
 			{
 				$nfield=$row['nfield'];
 			};
 		};
 		//echo $_SESSION['nf'], $nfield, $namemod, $l, $d, $w, $unitb, '<BR>';
 		$query = "INSERT INTO `model` 
 		(`nfield`, `nmod` ,`namemod`, `l`, `d`, `w`, `unitb`) 
 		VALUES (".$nfield.",".$nmod.",'".$namemod."', ".$l.", ".$d.", ".$w.", ".$unitb.")";
 		mysqli_query($link, $query) or die ("Ошибка 3 - не всавляются в таблицу model" . mysqli_error($link));
 	};

 // Dell model

 for ($i=0; $i<1000; ++$i)
 	{
       $temp='del_'.$i;
 	  if (isset($_GET[$temp])&&!empty($_GET[$temp]))
 	  {
 		   
 		$query ="SELECT DISTINCT nfield, namefield  FROM field";
 		$result = mysqli_query($link, $query) or die("Ошибка 2 - Нет связи с таблицей nfield" . mysqli_error($link));
 		$s= $_SESSION['nf'];
 		//echo "S=", $s,'<br>';

 		while ($row = mysqli_fetch_array($result))
 		{
 			if ($row['namefield'] == $_SESSION['nf'])
 			{
 				$nfield=$row['nfield'];
 			};
 		};

 		   //echo "nmod=",$i, "nfield=",$nfield;
           $query = "DELETE FROM `model` WHERE `nmod`=".$i." and `nfield`=".$nfield;
           mysqli_query($link, $query) or die ("ERROR!" . mysqli_error($link));
 		};

 	};


 	// выполняем операции с базой данных по выводу списка моделей по выбранному месторождению
 	if (isset($_GET['sel1']) || isset($_SESSION['nf']))
 	{
 		if (isset($_GET['sel1']))
 		{
 			
 			$namefield=$_GET['sel1'];
 			$_SESSION['nf'] = $namefield;
 		}
 		else
 		{

 			 $namefield=$_SESSION['nf'];
 		};
 		//echo $namefield;


 		$query ="SELECT model.nmod, model.namemod, model.d, model.l, model.w, model.unitb FROM field, model where field.nfield=model.nfield and field.namefield='".$namefield."'";
 		$result = mysqli_query($link, $query) or die("Ошибка 607" . mysqli_error($link));

 // ini_set('display_errors',1);
 // error_reporting(E_ALL);

 		$table = "<div class='form-wrapper'><form action='3dmodel.php' method='GET' id='model-form' class='model-form'> 
 		<div class='table-responsive'> 
 		<table  class='table table-bordered'> 
 		<thead>
 			<tr>
 		<th>Имя модели</th><th>Номер Модели</th><th>Длина</th><th>Высота</th><th>Ширина</th><th>Размер блока</th><th class='model-form__view'></th><th class='model-form__delete'></th></tr>
		</thead>
		<tbody>
 		";
 		while ($row = mysqli_fetch_array($result))
 		{
 			$table.="<tr class='table-row'><td>";
 			$table.= $row['namemod'];
 			$table.="</td><td class='nmod' data-nmod='".$row['nmod']."'>";
 			$table.= $row['nmod'];
 			$table.="</td><td class='l' data-l='".$row['l']."'>";
 			$table.= $row['l'];
 			$table.= "</td><td class='d' data-d='".$row['d']."'>";
 			$table.= $row['d'];
 			$table.="</td><td class='w' data-w='".$row['w']."'>";
 			$table.= $row['w'];
 			$table.="</td><td class='ub' data-ub='".$row['unitb']."'>";
 			$table.= $row['unitb'];
 			$table.= "</td>";
 			$table.="<td><input type='button' class='btn btn-xs btn-success btn_view' data-nmod='".$row['nmod']."' name='view_".$row['nmod']."' value='Просмотр'/> </td>";
 			$table.="<td><input type='submit' class='btn btn-xs btn-danger btn_delete' name='del_".$row['nmod']."' value='Удалить'/> </td>";
 		};
 	$table.= "</tbody></table></div><br>";
 	$table.="</form><input type='submit' class='btn btn-lg btn-success btn_add btn_add_model' name='add' id='btn_add_model' value='Добавить новую модель'/></div>";
 	echo $table, "<div class='canvas-wrapper'>
        <label for='tbase'>Топаоснова</label>
 		    <input type='checkbox' name='tbase' checked='checked'>
 		<label for='minerals'>Полезные ископаемые</label> 
		    <input type='checkbox' name='minerals' checked='checked'>
		<label for='hydro'>Гидрогеология</label>
		    <input type='checkbox' name='hydro'>
		<label for='3d'>3D</label>
		    <input type='checkbox' name='3d' checked='checked'>
		<label for='2d'>2D</label>
		    <input type='checkbox' name='2d'>
		</div>";
 	

 	};


 	




 // закрываем подключение
 mysqli_close($link);
?>