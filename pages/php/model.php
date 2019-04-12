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


 
 // Add new model and blocks
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
 		mysqli_query($link, $query) or die ("Ошибка 3 - не вставляются в таблицу model" . mysqli_error($link));
 	 	
		// создание пустого массива блоков
 		for ($x=0; $x <=$l; $x=$x+$unitb) 
		{ 
 			for ($y=0; $y <=$w; $y=$y+$unitb)
			{
 				for ($z=0; $z <$d; $z=$z+$unitb)
				{
 					$block_perc[$x] [$y] [$z] [0] = 0;///Topo Основа
 					$block_perc[$x] [$y] [$z] [2] = 0;/// Pi

 				};
 			};
 		};
 	 
		// заполнение массива значениями из скважин и кернов
 	   $query ="SELECT DISTINCT  `hole`.`x`,`hole`.`y`,`hole`.`z`, `linkcm`.`perc`, `linkcm`.`idmine`, `core`.`ncore`, `core`.`idhole`, `core`.`l` FROM `core`, `hole`, `linkcm` WHERE `hole`.`idhole`=`core`.`idhole` and `core`.`idcore`=`linkcm`.`idcore` and `hole`.`nfield`=".$nfield;
 	   $result = mysqli_query($link, $query) or die("Ошибка 4 - Нет связи с таблицами core, hole, linkcm" . mysqli_error($link));
 	   
 	   while ($row = mysqli_fetch_array($result))
 		{
          	$query1 ="SELECT DISTINCT  `ncore`, `l` FROM `core` WHERE `idhole`=".$row["idhole"]. " and `ncore`<".$row["ncore"];
 	        $result1 = mysqli_query($link, $query1) or die("Ошибка 4 - Нет связи с таблицами core, hole, linkcm" . mysqli_error($link));
            $nt=0;
            while ($row1 = mysqli_fetch_array($result1))
 			{
 				$nt=$nt+$row1['l'];// summa dlin predidushih kernov

 			};
 			
       	    for ($zz=0; $zz<$row["l"];$zz=$zz+1)
      	    {
 			  	$block_perc[$row["x"]] [$row["y"]] [$row["z"]+$nt+$zz] [0]= 1;
 			  	$block_perc[$row["x"]] [$row["y"]] [$row["z"]+$nt+$zz] [2]= $row["perc"];
 			  	//$block_perc[$row["x"]] [$row["y"]] [$row["z"]+$nt+$zz] [0]]= 1;

			}; 	
 			
 		};

 		$query ="SELECT DISTINCT  `hole`.`x`,`hole`.`y`,`hole`.`z` FROM `hole` WHERE `hole`.`nfield`=".$nfield;
 	   $result = mysqli_query($link, $query) or die("Ошибка 222 - Нет связи с таблицами hole" . mysqli_error($link));
 	   $i=0;
 	   while ($row = mysqli_fetch_array($result))
 		{
 			++$i;
 			$arrayHole[$i] = array($row['x'],$row['y']);
 		};
 		// $arrayData = array(
			//   2 => $block_perc,
			//   3 => $Clr
			// );

 		$json_data = json_encode($arrayHole);
	        $fd = fopen("dataHole.json", 'w') or die("не удалось создать файл");
			$str = $json_data;
			fwrite($fd, $str);
			fclose($fd);

			$queryDx ="SELECT DISTINCT  `hole`.`x` FROM `hole`, `field` WHERE `hole`.`nfield`=".$nfield;
			$resultDx = mysqli_query($link, $queryDx) or die("Ошибка 4 - Нет связи с таблицами hole" . mysqli_error($link));
            $count=0;
			while ($rowDx = mysqli_fetch_array($resultDx))
 			{
 				$count=$count+1;
 				$xx[$count]=$rowDx['x'];
 			};    


			$dx = abs($xx[1] - $xx[2]);
			for($i = 1 ; $i <$count; $i++) {
				for($j = $i+1; $j <=$count; $j++) {
					if($dx > abs($xx[$i] - $xx[$j])) {
						$dx = abs($xx[$i] - $xx[$j]);
					};	
				};	
			};



			$queryDy ="SELECT DISTINCT  `hole`.`y` FROM `hole`, `field` WHERE `hole`.`nfield`=".$nfield;
			$resultDy = mysqli_query($link, $queryDy) or die("Ошибка 4 - Нет связи с таблицами hole" . mysqli_error($link));
            $count=0;
			while ($rowDy = mysqli_fetch_array($resultDy))
 			{
 				$count=$count+1;
 				$yy[$count]=$rowDy['y'];
 			};    


			$dy = abs($yy[1] - $yy[2]);
			for($i = 1 ; $i <$count; $i++) {
				for($j = $i+1; $j <=$count; $j++) {
					if($dy > abs($yy[$i] - $yy[$j])) {
						$dy = abs($yy[$i] - $yy[$j]);
					};	
				};	
			};

			// интерполяция значений м\у скважинами
			$dz=$unitb; // Z step of model 
 			//$dx=5; // distance betwen holes X
 			//$dy=5; // distance betwen holes Y
 			$el=0;
 			$el2=2;

function foo(&$block_perc,$w, $d, $l,$dx,$dy,$dz,$unitb,$el) {
//$block_perc[2] [2] [2] [$el] = 1;
//echo "123";
//return $block_perc[$x] [$y] [$z][$el];
// Проход по Х 				$block_perc[$xx] [$y] [$z] [$el] = $kk;
 			for ($y=0; $y<=$w; $y=$y+$dy)
 			{
 				for ($z=0; $z<$d; $z=$z+$dz)
 				{
 					for ($x=0; $x<=$l-$dx; $x=$x+$dx)
 				    {
 					
						$dp = ($block_perc[$x+$dx] [$y] [$z] [$el] - $block_perc[$x] [$y] [$z] [$el])/$dx; // приращение
 						for ($xx=$x+$unitb; $xx<=$x+$dx-$unitb; $xx=$xx+$unitb)
 						{
 							$kk=$block_perc[$xx-$unitb] [$y] [$z] [$el] + $dp;
							if($el == 0) 
							{
								$block_perc[$xx] [$y] [$z] [$el] = round($kk);
							} else 
							{
								$block_perc[$xx] [$y] [$z] [$el] = $kk;
							};
  						}; 
 						
 					};	
 								
 				};
 			};
 			


 			// // // Проход по Y 				
 			for ($x=0; $x<=$l; $x=$x+$unitb)
 			{
 				for ($z=0; $z<$d; $z=$z+$dz)
 				{
 					for ($y=0; $y<=$w-$dy; $y=$y+$dy)
 				    {
 					
 						$dp = ($block_perc[$x] [$y+$dy] [$z] [$el] - $block_perc[$x] [$y] [$z] [$el])/$dy; // приращение

 						for ($yy=$y+$unitb; $yy<=$y+$dy-$unitb; $yy=$yy+$unitb)
 						{
 								$kk=$block_perc[$x] [$yy-$unitb] [$z] [$el] + $dp;
 								//echo $kk,' ';
 								if($el == 0) {
 									$block_perc[$x] [$yy] [$z] [$el] = round($kk);
 								} else {
 									$block_perc[$x] [$yy] [$z] [$el] = $kk;
 								};
 								
 								
 						}; 
 						
 					};	
 								
 				};
 			};

 };
 			
		foo($block_perc, $w, $d, $l,$dx,$dy,$dz,$unitb, $el);
		foo($block_perc, $w, $d, $l,$dx,$dy,$dz,$unitb,$el2);

		//Создание высот топоосновы
		for ($x=0; $x<=$l; $x=$x+$unitb)
 			{
 				for ($y=0; $y<=$w; $y=$y+$unitb)
 				{
 					$topoBase[$x][$y] = 0;
 					for ($z=$unitb; $z<$d; $z=$z+$unitb)
 				    {
 						//echo $block_perc[$x] [$y] [$z] [0];
 						if($block_perc[$x] [$y] [$z-$unitb] [0] == 0 && $block_perc[$x] [$y] [$z] [0] == 1) {
 							
 							$topoBase[$x][$y] = $z;
 						};
 						
 					};	
 								
 				};
 			};

			$arrayDataTop = $topoBase;
 			$json_dataTop = json_encode($arrayDataTop);
	        $fdTop = fopen("dataTopoBase.json", 'w') or die("не удалось создать файл топоосновы");
			$strTop = $json_dataTop;
			fwrite($fdTop, $strTop);
			fclose($fdTop);

// */ 
		$queryClr = "SELECT DISTINCT clr from `hole`, `core`, `linkcm`, `mine` where `hole`.`nfield` =".$nfield." and `hole`.`idhole` = `core`.`idhole` and `core`.`idcore` = `linkcm`.`idcore` and `linkcm`.`idmine` = `mine`.`idmine`";

		$resultClr = mysqli_query($link, $queryClr) or die("Ошибка 444 - Нет связи с таблицами core, hole, linkcm" . mysqli_error($link));
		$clrArr = mysqli_fetch_array($resultClr);
		$Clr = $clrArr['clr'];
			//echo $Clr;
		
			$arrayData = array(
			  2 => $block_perc,
			  3 => $Clr
			);
 			$json_data = json_encode($arrayData);
	        $fd = fopen("data.json", 'w') or die("не удалось создать файл");
			$str = $json_data;
			fwrite($fd, $str);
			fclose($fd);
			
		$c=2;	


		// запись блоков в таблицу
 		for ($x=0; $x <=$l; ($x=$x+$unitb)) 
 		{ 
 			
 			for ($y=0; $y <=$w ; ($y=$y+$unitb))
 			{
 				for ($z=0; $z <$d ; ($z=$z+$unitb))
 				{
					
 					$blperc = $block_perc [$x] [$y] [$z] [2];
					//echo $blperc;
 					if ($blperc>0) 
 					{
						 
 					  //echo $x, $y, $z, '=', $blperc, $blmine,'<br>';
 					  $query = "INSERT INTO `blockmodel` 
 					         (`x`, `y` ,`z`,`nfield`, `nmod`, `perc`, `idmine`) 
 					         VALUES (".$x.", ".$y.", ".$z.", ".$nfield.", ".$nmod.", ".$blperc.", ".$c.")";
 					 // echo $query, '<br>';       
 					  mysqli_query($link, $query) or die ("Ошибка 5 - не вставляются в таблицу blockmodel" . mysqli_error($link));
 					};         
 				};
 			};
 		};
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
		   $query = "DELETE FROM `blockmodel` WHERE `nmod`=".$i." and `nfield`=".$nfield;
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
 		<th>Имя модели</th><th>Номер Модели</th><th>Длина</th><th>Высота</th><th>Ширина</th><th>Размер блока</th><th class='model-form__view'>Просмотр модели</th><th class='model-form__topa'>Просмотр топаосновы</th><th class='model-form__delete'></th></tr>
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
 			$table.="<td><input type='button' class='btn btn-xs btn-success btn_view' data-nmod='".$row['nmod']."' name='view_".$row['nmod']."' value='Просмотр' /> </td>";
 			$table.="<td><input type='button' class='btn btn-xs btn-success btn_view_topa' data-nmod='".$row['nmod']."' name='view_".$row['nmod']."' value='Просмотр' /> </td>";
 			$table.="<td><input type='submit' class='btn btn-xs btn-danger btn_delete' name='del_".$row['nmod']."' value='Удалить'/> </td>";
 		};
 	$table.= "</tbody></table></div><br>";
 	$table.="</form><input type='submit' class='btn btn-lg btn-success btn_add btn_add_model' name='add' id='btn_add_model' value='Добавить новую модель'/></div>";
 	echo $table;
 	

 	};


 	




 // закрываем подключение
 mysqli_close($link);
?>