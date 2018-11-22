<?php  
	require_once '../connection.php'; // подключаем скрипт
    $connect = mysqli_connect($host, $user, $password, $database);
	$id = $_POST["id"];  
	$text = $_POST["text"];  
	$column_name = $_POST["column_name"];  
	$sql = "UPDATE field_doc SET ".$column_name."='".$text."' WHERE id='".$id."'";
	if(mysqli_query($connect, $sql))  
	{  
		echo 'Документ обновлен';
	}  
 ?>