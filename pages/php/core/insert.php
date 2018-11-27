<?php  
require_once '../connection.php'; // подключаем скрипт
$connect = mysqli_connect($host, $user, $password, $database);
$sql = "INSERT INTO core (nhole, ncore,l) VALUES('".$_POST["nhole"]."','".$_POST["ncore"]."','".$_POST["l"]."')";
if(mysqli_query($connect, $sql))  
{  
     echo 'Скважина добавлена';
}  
 ?>