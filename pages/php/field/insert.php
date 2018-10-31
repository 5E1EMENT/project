<?php  
require_once '../connection.php'; // подключаем скрипт
$connect = mysqli_connect($host, $user, $password, $database);
$sql = "INSERT INTO field (nfield, namefield, x,y,z,l,d,w) VALUES('".$_POST["nfield"]."', '".$_POST["namefield"]."','".$_POST["x"]."','".$_POST["y"]."','".$_POST["z"]."','".$_POST["l"]."','".$_POST["d"]."','".$_POST["w"]."')";
if(mysqli_query($connect, $sql))  
{  
     echo 'Месторождение добавлено';
}  
 ?>