<?php
    require_once '../connection.php'; // подключаем скрипт
	$connect = mysqli_connect($host, $user, $password, $database);
	$sql = "DELETE FROM core WHERE idcore = '".$_POST["id"]."'";
	if(mysqli_query($connect, $sql))  
	{  
		echo 'Керн удален';
	}  
 ?>