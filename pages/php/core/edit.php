<?php session_start();
if (!isset($_SESSION['idmine'])){session_start();}
require_once '../connection.php'; // подключаем скрипт
    $connect = mysqli_connect($host, $user, $password, $database);
	$id = $_POST["id"];  
	$idhole = $_SESSION['idhole'];
	$text = $_POST["text"];  
	$column_name = $_POST["column_name"];
	$textid = $_POST["textid"];


//$sqly = "SELECT DISTINCT * FROM `mine`";
//$resulty = mysqli_query($connect, $sqly);
//while ($row = mysqli_fetch_array($resulty) ) {
//
//    if ($row['name']==$_POST["column_name"])
//    {
//        $idmine = $row['idmine'];
//    };
//};

//echo $idhole;
	echo $column_name;
	echo $text;
	echo $textid;





$sql = "UPDATE `core` SET ".$column_name."='".$text."', idhole=".$idhole." WHERE idcore='".$id."'";
$sql1 = "UPDATE `linkcm` SET ".$column_name."='".$text."' WHERE idcore='".$id."'";
$sql2 = "UPDATE `mine` SET ".$column_name."='".$text."' WHERE idmine='".$textid."'";
	if(mysqli_query($connect, $sql))  
	{
        echo 'Керн обновлен', '  ';
	}
if(mysqli_query($connect, $sql1))
{

    echo 'Керн обновлен1', '  ';
}
if(mysqli_query($connect, $sql2))
{

    echo 'Керн обновлен2', '  ';

}
 ?>
 <?php  
// require_once '../connection.php'; // подключаем скрипт
// $idhole = $_SESSION['idhole'];
// $idmine = $_SESSION['idmine'];
// $connect = mysqli_connect($host, $user, $password, $database);
// $sql = "INSERT INTO core (idhole, ncore, l) VALUES($idhole,'".$_POST["ncore"]."','".$_POST["l"]."')";
// $sql2 = "INSERT INTO linkcm (idcore, idmine, perc) VALUES('".$_POST["idcore"]."',$idmine,'".$_POST["perc"]."')";

// if(mysqli_query($connect, $sql))  {  
	
// 		if(mysqli_query($connect,$sql2)) {
//      echo 'Скважина добавлена';
//      echo "ncore",' ',$_POST["ncore"],"l",' ',$_POST["l"],"name",' ',$_POST["name"],"perc",' ',$_POST["perc"];

// 		}

// }  
 ?>