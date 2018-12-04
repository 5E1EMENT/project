<?php  
	require_once '../connection.php'; // подключаем скрипт
    $connect = mysqli_connect($host, $user, $password, $database);
	$id = $_POST["id"];
	$text = $_POST["text"];  
	$column_name = $_POST["column_name"];  
	$sql = "UPDATE mine SET ".$column_name."='".$text."' WHERE idmine='".$id."'";
	if(mysqli_query($connect, $sql))  
	{  
		
		echo 'Полезное ископаемое обновлено';
	}  
 ?>