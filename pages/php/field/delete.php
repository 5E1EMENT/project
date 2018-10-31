<?php
    require_once '../connection.php'; // подключаем скрипт
	$connect = mysqli_connect($host, $user, $password, $database);
	$sql = "DELETE FROM field WHERE id = '".$_POST["id"]."'";
	if(mysqli_query($connect, $sql))  
	{  
		echo 'Месторождение удалено';
	}  
 ?>