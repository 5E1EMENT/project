<?php
require_once 'connection.php'; // подключаем скрипт

// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));

// выполняем операции с базой данных
$query ="SELECT * FROM map";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if($result)
{

}
$N = mysqli_query($link, 'SELECT nmod, namemap , h ,x1y1,x2y2,nfield,typemap from map') or die("Ошибка " . mysqli_error($N));

$table = "<table border='1' class='table'>";
while ($row = mysqli_fetch_array($N)) {

    $table.="<tr><td>";
    $table.=$row['nmod'];
    $table.="</td><td>";
    $table.=$row['namemap'];
    $table.="</td><td>";
    $table.=$row['h'];
    $table.="</td><td>";
    $table.=$row['x1y1'];
    $table.="</td><td>";
    $table.=$row['x2y2'];
    $table.="</td><td>";
    $table.=$row['nfield'];
    $table.="</td><td>";
    $table.=$row['typemap'];
    $table.="</td></tr>";




};
$table.="</table>";
echo $table;

// закрываем подключение
mysqli_close($link);
?>