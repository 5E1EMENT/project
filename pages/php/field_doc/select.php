<?php  
 require_once '../connection.php'; // подключаем скрипт
 $connect = mysqli_connect($host, $user, $password, $database);
 $output = '';
//ini_set('display_errors',1);
//error_reporting(E_ALL);

$id = $_POST['id'];
$namefield = $_POST['namefield'];
echo "Имя филда",$namefield, "номер id", $id + 100;
//if (isset($_GET['namefield'])) // Проверка существования переменной
//{
//    // Складываем значение полученной переменной с 10
//    $a = $_GET['namefield'];
//
//    echo "asdasd", $a ;
//}
$sql = "SELECT * FROM field_doc ORDER BY id DESC";
//$sql = "SELECT * FROM `field_doc`,`field` WHERE `field`.`nfield` = `field_doc`.`nfield`  ORDER BY `field_doc`.`id` DESC";
 $result = mysqli_query($connect, $sql);


 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">
           <thead>
                <tr>  
                    <!-- <th >Id</th>-->
                     <th >Номер месторождения</th>
                     <th >Ссылка на документ</th>
                     <th >Описание документа</th>
                     <th >Добавить</th>
                </tr>
                </thead>
                 <tbody>';
 $rows = mysqli_num_rows($result);
 if($rows > 0)  
 {  
//	  if($rows > 10)
//	  {
//		  $delete_records = $rows - 10;
//		  $delete_sql = "DELETE FROM hole LIMIT $delete_records";
//		  mysqli_query($connect, $delete_sql);
//	  }
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                   
                     <td class="nfield" data-id1="'.$row["id"].'" data-label="Номер месторождения" contenteditable>'.$row["nfield"].'</td>
                     <td class="doc"  data-id2="'.$row["id"].'" data-label="Ссылка на документ" > <a href="'.$row["doc"].'"><button type="button" class="btn btn-xs btn-success">Открыть</button></a></td>
                     <td class="doc_desc" data-id3="'.$row["id"].'" data-label="Описание документа" contenteditable>'.$row["doc_desc"].'</td>
                     <td data-label="Удалить"><button type="button" name="delete_btn" data-id4="'.$row["id"].'" class="btn btn-xs btn-danger btn_delete_doc">x</button></td>
                </tr>  
           ';  
      }  
      $output .= '  
           <tr>  
                <td id="nfield" contenteditable></td>
                <td id="document" contenteditable></td>
                <td id="doc_desc" contenteditable></td>
                <td data-label="Добавить"><button type="button" name="btn_add" id="btn_add_doc" class="btn btn-xs btn-success">+</button></td>
           </tr>  
      ';  
 }  
 else  
 {  
      $output .= '
				<tr>  
                <td id="nfield" contenteditable></td>
                <td id="document" contenteditable></td>
                <td id="doc_desc" contenteditable></td>
                <td data-label="Добавить"><button type="button" name="btn_add" id="btn_add_doc" class="btn btn-xs btn-success">+</button></td>
           </tr>  ';
 }  
 $output .= '</tbody></table>
      </div>';

 echo $output;  
 ?>