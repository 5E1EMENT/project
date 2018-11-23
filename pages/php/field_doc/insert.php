<?php  
require_once '../connection.php'; // подключаем скрипт
$connect = mysqli_connect($host, $user, $password, $database);
$sql = "INSERT INTO field_doc (nfield, doc,doc_desc) VALUES('".$_POST["nfield"]."','".$_POST["doc"]."','".$_POST["doc_desc"]."')";

if(mysqli_query($connect, $sql))  
{
    //echo "asdasdasdas", $_POST["nfield"];
     echo 'Документ добавлен';
}  
 ?>