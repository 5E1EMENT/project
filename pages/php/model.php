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
 	echo '<form action ="3dmodel.php" method="GET">';
 	echo '<select class="form-control" name="sel1" >';
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
 	echo '<input type="submit" class="btn btn-xs btn-success btn_add" name="sel_field" value="Открыть модели месторождения"/>';

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

 		   echo "nmod=",$i, "nfield=",$nfield;
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

 		$table = "<form action='3dmodel.php' method='GET'> 
 		<div class='table-responsive'> 
 		<table  class='table table-bordered'> 
 		<thead>
 			<tr>
 		<th>Имя модели</th><th>Номер Модели</th><th>Длина</th><th>Высота</th><th>Ширина</th><th>Размер блока</th><th></th><th></th></tr>
		</thead>
		<tbody>
 		";
 		while ($row = mysqli_fetch_array($result))
 		{
 			$table.="<tr><td>";
 			$table.= $row['namemod'];
 			$table.="</td><td>";
 			$table.= $row['nmod'];
 			$table.="</td><td>";
 			$table.= $row['l'];
 			$table.= "</td><td>";
 			$table.= $row['d'];
 			$table.="</td><td>";
 			$table.= $row['w'];
 			$table.="</td><td>";
 			$table.= $row['unitb'];
 			$table.= "</td>";
 			$table.="<td><input type='submit' class='btn btn-xs btn-success btn_add' name='view_".$row['nmod']."' value='Просмотр'/> </td>";
 			$table.="<td><input type='submit' class='btn btn-xs btn-danger btn_delete' name='del_".$row['nmod']."' value='Удалить'/> </td>";
 		};
 	$table.= "</tbody></table></div><br>";
 	$table.="<input type='submit' class='btn btn-xs btn-success btn_add btn_add_model' name='add' id='btn_add_model' value='Добавить новую модель'/></form>";
 	echo $table, '<br>';

 	};


 	if (isset($_GET['add'])&&!empty($_GET['add']))
 	{
 		echo '<form action="3dmodel.php" method="GET" name="add1">';
 		echo 'Имя модели   <input type="text" name="namemod"/> <br>';
 		echo 'Номер модели   <input type="text" name="nmod"/> <br>';
 		echo 'Высота <input type="text" name="d"/><br>';
 		echo 'Длина <input type="text" name="l"/><br>';
 		echo 'Ширина  <input type="text" name="w"/><br>';
 		echo 'Размер блока <input type="text" name="ub"/><br>';

 		echo '<input type="submit" value="Add record"/>';
 		echo '</FORM>';
 	//}
	//else
 	//{
 	//	echo '<form action="3dmodel.php?act=1" method="GET">';
 	//	echo '<center><input type="submit" name="add" value="Add new model" /></center>';
 	//	echo '</form>';
 	};




 // закрываем подключение
 mysqli_close($link);
?>