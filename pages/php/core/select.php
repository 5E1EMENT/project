<?php session_start();
require_once '../connection.php'; // подключаем скрипт
$connect = mysqli_connect($host, $user, $password, $database);
$output = '';
ini_set('display_errors',1);
error_reporting(E_ALL);

$idhole = $_POST['idhole'];

$_SESSION['idhole'] = $idhole;
//echo "idhole", $idhole;

//echo "Имя филда",$namefield, "номер id", $id + 100;
//if (isset($_GET['namefield'])) // Проверка существования переменной
//{
//    // Складываем значение полученной переменной с 10
//    $a = $_GET['namefield'];
//
//    echo "asdasd", $a ;
//}
// $sql = "SELECT * FROM field_doc ORDER BY id DESC";
$sql = "SELECT * FROM `core`,`linkcm`,`mine` WHERE `core`.`idcore` = `linkcm`.`idcore` and
`linkcm`.`idmine` = `mine`.`idmine` and `core`.`idhole` =".$idhole ; //ORDER BY `field_doc`.`id` DESC
$result = mysqli_query($connect, $sql);


// $fetchresult = mysqli_fetch_array($result);
// $idmine = $fetchresult ["idmine"];
// $_SESSION['idmine'] = $idmine;



$sql2 = "SELECT DISTINCT * FROM `mine`";
$result2 = mysqli_query($connect, $sql2);
$t='';
while ($rw = mysqli_fetch_array($result2) ) {

    $t.='<option data-id6="'.$rw["idmine"].'">'.$rw["name"].'</option>';
};
$output .= '  
 <div class="live_data-close"></div>
      <div class="table-responsive field-core_table">
          <div class="field-core_table-close"></div>  
           <table class="table table-bordered">
           <thead class="thead-dark">

                <tr>  
                    <!-- <th >Id</th>-->
                     <th >Номер керна</th>
                     <th >Длина керна</th>
                     <th >Полезное ископаемое</th>
                     <th >Проценты</th>
                     <th >Добавить</th>
                </tr>
                </thead>
                 <tbody>';
$rows = mysqli_num_rows($result);
if($rows > 0){
//	  if($rows > 10)
//	  {
//		  $delete_records = $rows - 10;
//		  $delete_sql = "DELETE FROM hole LIMIT $delete_records";
//		  mysqli_query($connect, $delete_sql);
//	  }
    while($row = mysqli_fetch_array($result)) {
    //idhole(ncore)

      //echo $row['name'];


        $tt='<option data-id6="'.$row["idmine"].'">'.$row["name"].'</option>'.$t;
        $output .= '  
                <tr>  
                   
                     <td class="ncore" data-id1="'.$row["idcore"].'" data-label="Номер керна" contenteditable>'.$row["ncore"].'</td>
                     <td class="l" data-id2="'.$row["idcore"].'" data-label="Длина керна" contenteditable>'.$row["l"].'</td>
                     <td class="name"   data-label="Полезное ископаемое" >
                    <select class="name_core form-control form-control-lg" data-id3="'.$row["idcore"].'" class="form-control form-control-lg" name="sel1" >
                     '.$tt.'
                      </select>
                     </td>

                     <td class="perc" data-id4="'.$row["idcore"].'" data-label="Проценты" contenteditable>'.$row["perc"].'</td>
                     <td data-label="Удалить"><button type="button" name="delete_btn" data-id5="'.$row["idcore"].'" class="btn btn-xs btn-danger btn_delete_core">x</button></td>
                </tr>  
           ';
    }
    $output .= '  
           <tr>  
                <td id="ncore" contenteditable></td>
                 <td id="l" contenteditable></td>
                <td id="name" >
                <select id="name_core" class="form-control form-control-lg" name="sel1">
                     '.$tt.'
                      </select>
                </td>
               <td id="perc" contenteditable></td>
                <td data-label="Добавить"><button type="button" name="btn_add" id="btn_add_core" class="btn btn-xs btn-success">+</button></td>
           </tr>  
      ';


}
else
{
  $row = mysqli_fetch_array($result);
   $tt='<option data-id6="'.$row["idmine"].'">'.$row["name"].'</option>'.$t;
    $output .= '  
             <tr>  
                <td id="ncore" contenteditable></td>
                 <td id="l" contenteditable></td>
                <td id="name" >
                <select id="name_core" class="form-control form-control-lg" name="sel1">
                     '.$tt.'
                      </select>
                </td>
               <td id="perc" contenteditable></td>
                <td data-label="Добавить"><button type="button" name="btn_add" id="btn_add_core" class="btn btn-xs btn-success">+</button></td>
           </tr>  
      ';
}
$output .= '</tbody></table>
      </div>';

echo $output;
?>