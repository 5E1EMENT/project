<?php
    require_once '../connection.php'; // подключаем скрипт
	$connect = mysqli_connect($host, $user, $password, $database);
	$sql = "DELETE FROM mine WHERE idmine = '".$_POST["idmine"]."'";
	if(mysqli_query($connect, $sql))  
	{
		echo 'Полезное ископаемое удалено';
	}  
 ?>