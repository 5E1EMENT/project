<?php session_start();  
if (!isset($_SESSION['idmine'])){session_start();}
require_once '../connection.php'; // подключаем скрипт
$idhole = $_SESSION['idhole'];
// $idmine = $_SESSION['idmine'];
$connect = mysqli_connect($host, $user, $password, $database);

$sqlx = "SELECT DISTINCT * FROM `mine`";
$resultx = mysqli_query($connect, $sqlx);
while ($row = mysqli_fetch_array($resultx) ) {

    if ($row['name']==$_POST["name"])
    	{
    		$idmine = $row['idmine'];
    	};
};


$sql = "INSERT INTO core (idhole, ncore, l) VALUES(".$idhole.",'".$_POST["ncore"]."','".$_POST["l"]."')";
//echo "(".$idhole.",'".$_POST["ncore"]."','".$_POST["l"]."')";


$r1 = mysqli_query($connect, $sql);

$sql3 = "select max(idcore) from core";
$r3 = mysqli_query($connect, $sql3);

$row = mysqli_fetch_array($r3);
//print_r($row);
$idcore = $row['max(idcore)'];

$sql2 = "INSERT INTO linkcm (idcore, idmine, perc) VALUES(".$idcore.", ".$idmine.",'".$_POST["perc"]."')";
$r2 = mysqli_query($connect, $sql2);

if($r1)  {

		if($r2) {
     echo 'Керн добавлен';
//     echo "ncore",' ',$_POST["ncore"],"l",' ',$_POST["l"],"name",' ',$_POST["name"],"perc",' ',$_POST["perc"];

		}

}
 ?>