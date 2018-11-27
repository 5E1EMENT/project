<?php  
require_once '../connection.php'; // подключаем скрипт
$connect = mysqli_connect($host, $user, $password, $database);
$sql = "INSERT INTO mine (name, clr) VALUES('".$_POST["name"]."','".$_POST["clr"]."')";
if(mysqli_query($connect, $sql))  
{  
     echo 'Полезное ископаемое добавлено';
}  
 ?>