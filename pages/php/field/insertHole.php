<?php
require_once '../connection.php'; // подключаем скрипт
$connect = mysqli_connect($host, $user, $password, $database);
$sql = "INSERT INTO field (id, nhole,  x,y,z,a,b,d) VALUES('".$_POST["id"]."','".$_POST["nhole"]."','".$_POST["x"]."','".$_POST["y"]."','".$_POST["z"]."','".$_POST["a"]."','".$_POST["b"]."','".$_POST["d"]."')";
if(mysqli_query($connect, $sql))
{
     echo 'Месторождение добавлено';
}
 ?>