<?php
    require_once '../connection.php'; // подключаем скрипт
	$connect = mysqli_connect($host, $user, $password, $database);
	$sql = "DELETE FROM core WHERE id = '".$_POST["id_core"]."'";
	if(mysqli_query($connect, $sql))  
	{  
		echo 'Керн удален';
	}  
 ?>