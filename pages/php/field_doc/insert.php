<?php session_start();
require_once '../connection.php'; // подключаем скрипт
$connect = mysqli_connect($host, $user, $password, $database);
$namefile = $_SESSION['s'];
$sql = "INSERT INTO field_doc (nfield, doc,doc_desc) VALUES('".$_POST["nfield"]."','$namefile','".$_POST["doc_desc"]."')";
//echo "ССЫЛКА",$doc;
//echo "Номер месторождения",$_POST["nfield"];
//echo "ОПИСАНИЕ",$_POST["doc_desc"];

if(mysqli_query($connect, $sql))  
{
    //echo "asdasdasdas", $_POST["nfield"];
//    echo "BOT",$namefile;
     echo 'Документ добавлен';
}  
 ?>