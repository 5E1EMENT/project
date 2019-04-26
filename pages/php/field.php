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
$table = "<table border='1' class='table_field table'>
    <thead class='thead-dark'>
        <tr>
            <th scope='col'>Номер месторожденияs</th>
            <th scope='col'>Имя месторождения</th>
            <th scope='col'>X</th>
            <th scope='col'>Y</th>
            <th scope='col'>Z</th>
            <th scope='col'>L</th>
            <th scope='col'>D</th>
            <th scope='col'>W</th>
        </tr>
    </thead>";
while ($row = mysqli_fetch_array($N)) {
    $table.="<tbody><td>";

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
$table.="</tbody></table>";

echo $table;
echo $input_field;
//закрываем подключение
mysqli_close($link);
?>