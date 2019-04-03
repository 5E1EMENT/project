<?php
 require_once 'connection.php'; // подключаем скрипт
 
// 1 подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка подключения к базе" . mysqli_error($link));
// 2 Выбор месторождения - ниспадающий список №1 месторожденией из базы и кнопка "Выберите месторождение"
$query ="SELECT nfield, namefield FROM field";
$result = mysqli_query($link, $query) or die("Ошибка 1!!! " . mysqli_error($link));
 	
echo '<form action ="3dcut.php" method="GET">';
echo '<select class="form-control" name="sel1" >';

if (isset($_SESSION['fieldname'])) { $temp = '<option> '.$_SESSION['fieldname'].' </option>'; }
else { 	$temp = '<option> Выберите месторождение </option>'; };		
while ($row = mysqli_fetch_array($result))
{
	$temp.='<option>';
	$temp.=$row['namefield'];
	$temp.='</option>';
};
echo $temp;
echo '</select>';
echo '<input type="submit" class="btn btn-xs btn-success btn_add" name="sel_field" value="Открыть модели месторождения"/><br><br>';
echo '</form><BR>';

// 3 Выбор 3Д модели в ниcпадающий список №2 и кнопка "Открыть разрезы и карты"
// 3.1 Проверяем наличие переданного fieldname в методе GET
if (isset($_GET['sel1'])) 
{
   	$fieldname=$_GET['sel1'];
   	$_SESSION['fieldname']=$fieldname;
}
elseif (isset($_SESSION['fieldname'])) { $fieldname = $_SESSION['fieldname']; }
else { $fieldname=''; };   
   	
$query ="SELECT * FROM `field`, `model` WHERE `field`.`nfield`=`model`.`nfield` and `field`.`namefield`='".$fieldname."'";
$result = mysqli_query($link, $query) or die("Ошибка 2!!! " . mysqli_error($link));

// 3.2 Если выбран 2 список - заполняем в ОЗУ переменные $modelname и $fieldname
if (isset($_GET['sel2']))
{ 
   	$modelname=$_GET['sel2'];
   	$_SESSION['modelname']=$modelname;
   	$fieldname=$_SESSION['fieldname'];
}
elseif (isset($_SESSION['modelname'])) { $modelname=$_SESSION['modelname']; }
else {	$modelname=''; };
// 3.3 Заполняем ниспадающий список моделей из базы и кнопка
echo '<form action ="3dcut.php" method="GET">';
echo '<select class="form-control" name="sel2" >';
if (isset($_SESSION['modelname'])) { $temp = '<option> '.$_SESSION['modelname'].' </option>';}
else { $temp = '<option> Выберите модель </option>'; }; 
while ($row = mysqli_fetch_array($result))
{
 	$temp.='<option>';
 	$temp.=$row['namemod'];
 	$temp.='</option>';
};
echo $temp;
echo '</select>';
echo '<input type="submit" class="btn btn-xs btn-success btn_add" name="sel_field" value="Открыть разрезы и карты"/> <br><br>';
echo '</form><BR>';

// 4 Добавление нового разреза или карты в таблицу
if (isset($_GET["namemap"])&&isset($_GET["coordinate"])&&(isset($_GET["rbx"])||isset($_GET["rby"])||isset($_GET["rbz"])))
{
	$namemap = strip_tags($_GET["namemap"]);
	$coordinate = strip_tags($_GET["coordinate"]);
	// Выбор (по какой координате будет сечение) что это: разрез по Х или по У или это карта по Z
	$xmap=0; $ymap=0;	$hmap=0;	
   	if(isset($_GET["rbx"])) {$xmap=$coordinate; $t="Разрез по х";};
	if(isset($_GET["rby"])) {$ymap=$coordinate; $t="Разрез по y";};
	if(isset($_GET["rbz"])) {$hmap=$coordinate; $t="Карта по z";};
	
	$query ="SELECT DISTINCT * FROM field";
	$result = mysqli_query($link, $query) or die("Ошибка 3!!! " . mysqli_error($link));
	// for namefield=nf find nfield ищем nfield 
	while ($row = mysqli_fetch_array($result))
	{
		if ($row['namefield'] == $_SESSION['fieldname'])
		{
			$nfield=$row['nfield'];
		};
	};
		
	$query ="SELECT DISTINCT * FROM model";
	$result = mysqli_query($link, $query) or die("Ошибка 4!!! " . mysqli_error($link));
	// for namemod=nf find nfield 
	while ($row = mysqli_fetch_array($result))
	{
		if ($row['namemod'] == $_SESSION['modelname'])
		{
			$nmod=$row['nmod'];
			$d=$row['d'];
			$l=$row['l'];
			$w=$row['w'];
			$ub=$row['unitb'];
		};
	};

	// 4.2 Добавление разреза в таблицу blockmap
	//заполняем пустые массивы 3Д модели для процентов и АйдиПИ
	for ($x=0; $x<=$l; $x=$x+$ub)
		{ for ($y=0; $y<=$w; $y=$y+$ub)
			{for ($z=0; $z<=$d; $z=$z+$ub)
				{
					$perc[$x] [$y] [$z] = 0;
					$idmine[$x] [$y] [$z] = 0;
				};
			};
		};
	// заполняем значениями массив 3Д модели из таблицы blockmodel
	$q="SELECT * FROM `blockmodel` WHERE `nfield`=".$nfield." and `nmod`=".$nmod;
	$result=mysqli_query($link, $q) or die ("Ошибка 5!!! " . mysqli_error($link));
	while ($r = mysqli_fetch_array($result))
	{
		$perc[$r['x']] [$r['y']] [$r['z']] = $r['perc'];
		$idmine[$r['x']] [$r['y']] [$r['z']] = $r['idmine'];
	};
	// формирование карты по Z
	if ($hmap>0)
	{
 		$NX=$l; $NY=$w;
 	    for ($x=0; $x<=$NX; $x=$x+$ub)
 		{ for ($y=0; $y<=$NY; $y=$y+$ub)
 			{
 				$percmap[$x] [$y]  = $perc[$x] [$y] [$hmap];
 				$idmine[$x] [$y] = $idmine[$x] [$y] [$hmap];
 			};
 		};
 	};
 	// формирование карты по X
 	if ($xmap>0)
 	{
 		$NX=$w; $NY=$d;
 	    for ($x=0; $x<=$NX; $x=$x+$ub)
 		{ for ($y=0; $y<=$NY; $y=$y+$ub)
 			{
 				$percmap[$x] [$y]  = $perc[$xmap] [$y] [$x];
 				$idmine[$x] [$y] = $idmine[$xmap] [$y] [$x];
 			};
 		};
 	};
  	// формирование карты по Y
 	if ($ymap>0)
 	{
 		$NX=$l; $NY=$d;
 	    for ($x=0; $x<=$NX; $x=$x+$ub)
 		{ for ($y=0; $y<=$NY; $y=$y+$ub)
 			{
 				$percmap[$x] [$y]  = $perc[$x] [$ymap] [$y];
 				$idmine[$x] [$y] = $idmine[$x] [$ymap] [$y];
 			};
 		};
 	};				

	// 4.2.1 Добавление записи в таблицу blockmap
	for ($x=0; $x<=$NX; $x=$x+$ub)
	{ 
		for ($y=0; $y<=$NY; $y=$y+$ub)
		{
			if ($zmap>0)
			{
				$q= "INSERT INTO `blockmap` 
				(`idmap`,`nmap`,`namemap`,`x`,`y`,`idmine`,`perc`)
				VALUES (".$idmap.",".$nmap.",'".$namemap."',".$x.",".$y.",".$idmine.",".$perc.",)";
				mysql_query($link, $q) or die ("Ошибка 7!!!" . mysql_error($link));
			};
		};
	};

	// 4.3 Добавление записи в таблицу map		
	$qqq = "INSERT INTO `map` 
	(`nfield`,`nmod`,`namemap`, `h` ,`x1y1`, `x2y2`, `typemap`,`NX`,`NY`) 
	VALUES (".$nfield.",".$nmod.",'".$namemap."', ".$hmap.", ".$xmap.", ".$ymap.", '".$t."',".$NX.", ".$NY.")";
	mysqli_query($link, $qqq) or die ("Ошибка 8!!! " . mysqli_error($link));

};
	
// 5. Удаление разреза или карты
for ($i=0; $i<1000; ++$i)
{
	//i = namemap
    $temp='del_'.$i;
	if (isset($_GET[$temp])&&!empty($_GET[$temp]))
 	{
		$query ="SELECT DISTINCT idmap, namemap FROM map";
 		$result = mysqli_query($link, $query) or die("Ошибка 9!!! " . mysqli_error($link));
 		while ($row = mysqli_fetch_array($result))
 		{
 			if ('del_'.$row['idmap'] == $temp)
 			{
 				$idmap=$row['idmap'];
			};
 		};
        //$query1 ="DELETE FROM `blockmap`"
        $query = "DELETE FROM `map` WHERE `map`.`idmap` = ".$idmap;
        mysqli_query($link, $query) or die ("Ошибка 10!!! " . mysqli_error($link));
	};
};

// 5.1 Просмотр разреза или карты
for ($i=0; $i<1000; ++$i)
{

	//i = namemap
    $temp='view_'.$i;
	if (isset($_GET[$temp])&&!empty($_GET[$temp]))
 	{
		$query ="SELECT DISTINCT idmap, namemap FROM map";
 		$result = mysqli_query($link, $query) or die("Ошибка 11!!! " . mysqli_error($link));
 		while ($row = mysqli_fetch_array($result))
 		{
 			if ('view_'.$row['idmap'] == $temp)
 			{
 				$idmap=$row['idmap'];
			};
 		};
        // Вывод картинки
        $query = "SELECT * FROM `map` WHERE `map`.`idmap` = ".$idmap;
        $result= mysqli_query($link, $query) or die ("Ошибка 12!!! " . mysqli_error($link));
        $r=mysqli_fetch_array($result);
        $NX=$r['NX'];
        $NY=$r['NY'];
        $ub=1; // дописать определние ub!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        for ($x=0; $x<=$NX; $x=$x+$ub) 
        {
        	for ($y=0; $y<=$NY; $y=$y+$ub) 
        	{
        		$clr [$x] [$y] = '#fff';
        	};
        };
        $query = "SELECT * FROM `blockmap`, `mine` WHERE `blockmap`.`idmap` = ".$idmap." and `mine`.`idmine`=`blockmap`.`idmap`";
        $result= mysqli_query($link, $query) or die ("Ошибка 13!!! " . mysqli_error($link));
        while ($r=mysqli_fetch_array($result)) 
        {
        	$clr [$r['x']] [$r['y']] = $r ['clr'];
        };



        $queryClr ="SELECT clr FROM mine";
        $resultClr = mysqli_query($link, $queryClr) or die("Ошибка (НИ*УЯ)!!! " . mysqli_error($link));

    while ($rowClr = mysqli_fetch_array($resultClr))
    {

    $tempClr.=$rowClr['clr'];
//        for ($q=0; $q<=count($rowClr); $q++) {
//            echo $tempClr[$q]."<br>";
//        }

    };



    ;
    echo "ВОТ", $tempClr;
	// Подключаем canvas
	echo "<canvas id='3DModel' width='400' height='400'>";
	echo "<script> 
    var drawingCanvas = document.getElementById('3DModel');
    console.log('$tempClr');
    var drawRect = function(x,y,ub,clrstroke,clrfill)
   {

        ctx.lineWidth = 1; // толщина линий контура
        ctx.globalAlpha= 1; // прозрачность
        ctx.strokeStyle = clrstroke;
        ctx.fillStyle = clrfill;
        ctx.beginPath();
        ctx.rect(x,y, ub,ub);
        ctx.closePath();        
        ctx.stroke(); // kонтур
        ctx.fill();   // zalivka  
   }
   function getColor() 
   {
   
    var colorGold = '#DAA520';
    
    return colorGold;
   }

    if(drawingCanvas && drawingCanvas.getContext) 
    {
     var  ctx = drawingCanvas.getContext('2d');
        
        ctx.strokeStyle = '#f00';
        ctx.beginPath();
        ctx.rect(1,1,498,498);
        ctx.closePath();        
        ctx.stroke(); // kонтур
               
       for (x=1; x<=400; x=x+50) {
          for (y=1; y<=400; y=y+50) {
              drawRect(x,y,50, \"#000\",getColor());
          }         
        }     
    }       
    
  		</script>
		</canvas>";


	};
};


// 6.Вывод таблицы с разрезами и картами
$q1 ="SELECT `idmap`, `namemap`, `h`, `x1y1`, `x2y2`, `typemap` 
      FROM `field`,`model`, `map` 
	  WHERE field.nfield=model.nfield
	  and model.nmod=map.nmod
	  and field.namefield='".$fieldname."'
	  and model.namemod='".$modelname."'";
$result = mysqli_query($link, $q1) or die("Ошибка 14!!! Ошибка запроса к таблице " . mysqli_error($link));
$table = "<form action='3dcut.php' class='form_cut' method='GET'> <table  class='table table-bordered table_cut'><tr><td>Название</td><td>Высота</td><td>Координата x1y1</td><td>Координата x2y2</td><td>Тип</td><td></td><td></td></tr>";
while ($row = mysqli_fetch_array($result)) 
{
	$table.="<tr><td>";
	$table.=$row['namemap'];
	$table.="</td><td>";
	$table.=$row['h'];
	$table.="</td><td>";
	$table.=$row['x1y1'];
	$table.="</td><td>";
	$table.=$row['x2y2'];
	$table.="</td><td>";
	$table.=$row['typemap'];
	$table.="</td><td><input type='submit' class='btn btn-xs btn-success btn_add' name='view_".$row['idmap']."' value='Просмотр'/> </td>";
	$table.="<td><input type='submit' class='btn btn-xs btn-danger btn_delete' name='del_".$row['idmap']."' value='Удалить'/>";
	$table.="</td></tr>";
 };
 $table.="</table>";
 $table.="</form>";
// 7. Если нажата кнопка "Добавить то выводим форму "Форма добавления нового разреза карты" по переменной GET(add)
if (isset($_GET['add'])&&!empty($_GET['add']))
{	
//	$table.= '<center>';
//	$table.= '<form action="3dcut.php" method="GET" name="add1">';
// 	$table.='Имя разреза или карты <input type="text" name="namemap"/> <br>';
// 	$table.= 'Разрез по Х     <input type="radio" name="rbx"/> <br>';
//	$table.= 'Разрез по У     <input type="radio" name="rby"/> <br>';
//	$table.= 'Карта по Z      <input type="radio" name="rbz"/> <br>';
//	$table.= ' Значение координаты <input type="text" name="coordinate"> <br><br>';
//	$table.= '<input type="submit" class="btn btn-xs btn-success btn_add" value="Подтвердить"/>';
// 	$table.= '</form>';
//	$table.= '</center>';
}
//else
//{
//	$table.= '<form action="3dcut.php?act=1" method="GET">';
//	$table.= '<center></center>';
//	$table.= '</form>';
//};
//
if (!empty($fieldname)&&!empty($modelname)) { echo $table;
//echo '<input type="submit" id="btn_add_cut" class="btn btn-xs btn-success" name="add" value="Добавить новый разрез или карту" />'
echo '<button id="btn_add_cut" class="btn btn-xs btn-success" name="add">Добавить новый разрез или карту</button>';
};

	

//8. закрываем подключение
mysqli_close($link);
?>