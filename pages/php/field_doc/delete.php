<?php
    require_once '../connection.php'; // подключаем скрипт
	$connect = mysqli_connect($host, $user, $password, $database);
	$sql = "DELETE FROM `field_doc` WHERE `field_doc`.`id_doc` = '".$_POST["id"]."'";
	if(mysqli_query($connect, $sql))  
	{
	    echo $_POST["id"];
		echo 'Документ удалён';
		//echo "id:",$_POST["id"];
	}  
 ?>