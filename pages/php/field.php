<?php
require_once 'connection.php'; // подключаем скрипт
require_once '../field/field.php'; // подключаем скрипт
// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));
// выполняем операции с базой данных
$query ="SELECT * FROM field";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if($result)
{
}
if (isset($_GET["field_number"])&&($_GET["field_name"])) {
$nfield = htmlentities($_GET["field_number"]);
$namefield = htmlentities($_GET["field_name"]);
$x = strip_tags($_GET["field_x"]);
$y = strip_tags($_GET["field_y"]);
$z = strip_tags($_GET["field_z"]);
$l = strip_tags($_GET["field_l"]);
$d = strip_tags($_GET["field_d"]);
$w = strip_tags($_GET["field_w"]);
$query = "INSERT INTO `e1eme186_3dcarier`.`field` (`nfield`, `namefield`, `x`, `y`, `z`, `l`, `d`, `w`) VALUES (".$nfield.", '".$namefield."', ".$x.", ".$y.", ".$z.", ".$l.", ".$d.", ".$w.")";
mysqli_query($link, $query) or die ("ERROR!" . mysqli_error($link));
};
$N = mysqli_query($link, 'SELECT nfield, namefield , x ,y,z,l,d,w from field') or die("Ошибка " . mysqli_error($N));
$input_field = "<input class ='add_field' type='submit' value='Добавить'/>";
$table = "<table border='1' class='table_field'><tr><td>Номер месторождения</td><td>Имя месторождения</td><td>X</td><td>Y</td><td>Z</td><td>L</td><td>D</td><td>W</td>";
while ($row = mysqli_fetch_array($N)) {
    $table.="<tr><td>";
    $table.=$row['nfield'];
    $table.="</td><td>";
    $table.=$row['namefield'];
    $table.="</td><td>";
    $table.=$row['x'];
    $table.="</td><td>";
    $table.=$row['y'];
    $table.="</td><td>";
    $table.=$row['z'];
    $table.="</td><td>";
    $table.=$row['l'];
    $table.="</td><td>";
    $table.=$row['d'];
    $table.="</td><td>";
    $table.=$row['w'];
    $table.="</td></tr>";
};
$table.="</table>";
echo $table;
echo $input_field;
//закрываем подключение
mysqli_close($link);
?>