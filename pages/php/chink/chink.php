<?php


require_once 'connection.php'; // подключаем скрипт

//echo "XXX"; print_r ( 	$_SESSION);

// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка 0. Нет подключения к Базе данных" . mysqli_error($link));


// выполняем операции с базой данных
$query ="SELECT nfield, namefield FROM field";
$result = mysqli_query($link, $query) or die("Ошибка 1 - Нет связи с таблицей nfield" . mysqli_error($link));

// Выбор месторождения - ниспадающий список месторожденией из базы и кнопка
echo '<div class="chink_wrapper>"<form action ="chink.php" method="GET">';
echo '<select class="form-control form-control-lg chink-select" name="sel1" >';

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
echo '<center><input type="submit" class="btn btn-lg btn-primary btn_open_chink" name="sel_chink" value="Открыть скважины"/></center>';

echo '</form><BR>';

// Add new model
if (isset($_GET["nfield"])&&isset($_GET["nhole"])&&isset($_GET["x"])&&isset($_GET["y"])&&isset($_GET["z"])&&isset($_GET["a"])&&isset($_GET["b"])&&isset($_GET["d"]))
{
    $nfield = strip_tags($_GET["nfield"]);
    $nhole = strip_tags($_GET["nhole"]);
    $x = strip_tags($_GET["x"]);
    $y = strip_tags($_GET["y"]);
    $z = strip_tags($_GET["z"]);
    $a = strip_tags($_GET["a"]);
    $b = strip_tags($_GET["b"]);
    $d = strip_tags($_GET["d"]);
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
    $query = "INSERT INTO `hole` 
 		(`nfield`, `nhole` ,`x`, `y`, `z`, `a`, `b`,`d`) 
 		VALUES (".$nfield.",".$nhole.",'".$x."', ".$y.", ".$z.", ".$a.", ".$b.", ".$d.")";
    mysqli_query($link, $query) or die ("Ошибка 3 - не всавляются в таблицу hole" . mysqli_error($link));
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

        echo "nhole=",$i, "nfield=",$nfield;
        $query = "DELETE FROM `hole` WHERE `nhole`=".$i." and `nfield`=".$nfield;
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
//and field.namefield='".$namefield."'"

    $query ="SELECT * FROM field, hole where field.nfield=hole.nfield and field.namefield='".$namefield."'";
    $result = mysqli_query($link, $query) or die("Ошибка 607" . mysqli_error($link));

    // ini_set('display_errors',1);
    // error_reporting(E_ALL);

    $table = "<form action='chink.php' method='GET'> 
 		<div class='table-responsive'> 
 		<table  class='table table-responsive'> 
 		<thead class='thead-dark'>
 		<tr>
 		<th scope='col'>Id</th>
 		<th scope='col'>Номер скважины</th>
 		<th scope='col'>Х координата</th>
 		<th scope='col'>Y координатаа</th>
 		<th scope='col'>Z координата</th>
 		<th scope='col'>Угол Альфа</th>
 		<th scope='col'>Угол Бета</th>
 		<th scope='col'>Глубина</th>
 		<th scope='col'>Керны</th>
 		<th scope='col'>Редактировать</th>
 		</tr>
		</thead>
		<tbody>
 		";
    while ($row = mysqli_fetch_array($result))
    {
        $table.='<tr><td class="idhole" data-id2="'.$row["idhole"].'">';
        $table.= $row['idhole'];
        $table.="</td><td>";
        $table.= $row['nhole'];
        $table.="</td><td>";
        $table.= $row['x'];
        $table.= "</td><td>";
        $table.= $row['y'];
        $table.="</td><td>";
        $table.= $row['z'];
        $table.="</td><td>";
        $table.= $row['a'];
        $table.= "</td><td>";
        $table.= $row['b'];
        $table.="</td><td>";
        $table.= $row['d'];
        $table.="</td>";
        $table.="<td><div  name=\"btn_core\"  class=\"btn_core\"></div></td>";
        $table.="<td><input type='submit' class='btn btn-xs btn-danger btn_delete' name='del_".$row['nhole']."' value='X'/> </td></tr>";
    };
    //<input type='submit' class='btn btn-xs btn-success btn_add' name='view_".$row['nhole']."' value='Просмотр'/>
    $table.= "</tbody></table></div>";
    $table.="</form>";
    echo $table;
    echo "<input type='submit' class='btn btn-lg btn-success btn_add btn_add_hole' name='add1' id='btn_add_hole' value='Добавить скважину'/></div>";

};


if (isset($_GET['add1'])&&!empty($_GET['add1']))
{
//    echo '<form action="chink.php" method="GET" name="add1">';
//    echo 'Номер месторождения   <input type="text" name="nfield"/> <br>';
//    echo 'Номер скважины   <input type="text" name="nhole"/> <br>';
//    echo 'X координата <input type="text" name="x"/><br>';
//    echo 'Y координата <input type="text" name="y"/><br>';
//    echo 'Z координата  <input type="text" name="z"/><br>';
//    echo 'Уголь альфа <input type="text" name="a"/><br>';
//    echo 'Уголь бета <input type="text" name="b"/><br>';
//    echo 'Глубина <input type="text" name="d"/><br>';
//
//    echo '<input type="submit" value="Add record"/>';
//    echo '</FORM>';
}
else
{
//    echo '<form action="chink.php?act=1" method="GET">';
//    echo '<center><input type="submit" name="add" value="Add new hole" /></center>';
//    echo '</form>';
};




// закрываем подключение
mysqli_close($link);
?>