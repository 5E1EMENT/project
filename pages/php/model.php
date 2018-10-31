<?php
require_once 'connection.php'; // подключаем скрипт

// подключаемся к серверу
$link = mysqli_connect($host, $user, $password, $database)
    or die("Ошибка " . mysqli_error($link));

// выполняем операции с базой данных
$query ="SELECT * FROM model";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
if($result)
{

}

$N = mysqli_query($link, 'SELECT nmod, namemod , d ,l,w,unitb from model') or die("Ошибка " . mysqli_error($N));

$table = "<table border='1' class='table'>";
while ($row = mysqli_fetch_array($N)) {

    $table.="<tr><td>";
    $table.=$row['nmod'];
    $table.="</td><td>";
    $table.=$row['namemod'];
    $table.="</td><td>";
    $table.=$row['d'];
    $table.="</td><td>";
    $table.=$row['l'];
    $table.="</td><td>";
    $table.=$row['w'];
    $table.="</td><td>";
    $table.=$row['unitb'];
    $table.="</td></tr>";


};

$table.="</table>";
echo $table;

// закрываем подключение
mysqli_close($link);
?>