<?php
require_once 'connection.php'; // подключаем скрипт

// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));

// выполняем операции с базой данных
$query ="SELECT * FROM field";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if($result)
{

}

$N = mysqli_query($link, 'SELECT nhole, nfield, x, y, z, a, b, d from hole') or die("Ошибка " . mysqli_error($N));

$table = "<table border='1' class='table'>";
while ($row = mysqli_fetch_array($N)) {

    $table.="<tr><td>";
    $table.=$row['nhole'];
    $table.="</td><td>";
    $table.=$row['nfield'];
    $table.="</td><td>";
    $table.=$row['x'];
    $table.="</td><td>";
    $table.=$row['y'];
    $table.="</td><td>";
    $table.=$row['z'];
    $table.="</td><td>";
    $table.=$row['a'];
    $table.="</td><td>";
    $table.=$row['b'];
    $table.="</td><td>";
    $table.=$row['d'];
    $table.="</td></tr>";


};

$table.="</table>";
echo $table;

// закрываем подключение
mysqli_close($link);
?>