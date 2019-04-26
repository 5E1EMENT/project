<?php
require_once '../connection.php'; // подключаем скрипт
$connect = mysqli_connect($host, $user, $password, $database);
$output = '';
$sql = "SELECT * FROM field  ORDER BY id DESC";
$result = mysqli_query($connect, $sql);
$output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">
           <thead class="thead-dark">
                <tr>  
                     <!-- <th >Id</th>-->
                     <!--<th >№ месторождения</th>-->
                     <th scope="col">Имя месторождения</th>
                     <th scope="col">X</th>
                     <th scope="col">Y</th>
                     <th scope="col">Z</th>
                     <th scope="col">Длина</th>
                     <th scope="col">Глубина</th>
                     <th scope="col">Ширина</th>
                     <th scope="col">Скважины</th>
                     <th scope="col">Документы</th>
                     <th scope="col">3д Модель</th>
                     <th scope="col">Добавить</th>
                </tr>
                 </thead>
                 <tbody>';
$rows = mysqli_num_rows($result);
if($rows > 0)
{
    if($rows > 10)
    {
        $delete_records = $rows - 10;
        $delete_sql = "DELETE FROM field LIMIT $delete_records";
        mysqli_query($connect, $delete_sql);
    }
    while($row = mysqli_fetch_array($result))
    {
        $output .= '
    <a>  
         <!--<td data-label="ID">'.$row["id"].'</td>-->
         <!--<td class="nfield" data-id1="'.$row["id"].'"data-label="№ месторождения" data-label="ID" contenteditable>'.$row["nfield"].'</td>-->
         <td class="namefield" data-id2="'.$row["id"].'" data-label="Имя месторождения" contenteditable>'.$row["namefield"].'</td>
         <td class="x" data-id3="'.$row["id"].'" data-label="X координата" contenteditable>'.$row["x"].'</td>
         <td class="y" data-id4="'.$row["id"].'" data-label="Y координата" contenteditable>'.$row["y"].'</td>
         <td class="z" data-id5="'.$row["id"].'" data-label="Z координата" contenteditable>'.$row["z"].'</td>
         <td class="l" data-id6="'.$row["id"].'" data-label="Длина" contenteditable>'.$row["l"].'</td>
         <td class="d" data-id7="'.$row["id"].'" data-label="Глубина" contenteditable>'.$row["d"].'</td>
         <td class="w" data-id8="'.$row["id"].'" data-label="Ширина" contenteditable>'.$row["w"].'</td>
         <td class="hole" data-id8="'.$row["id"].'" data-label="Скважины" ><a href="/pages/chink/chink.php?sel1='.$row["namefield"].'"><div name="btn_hole" id="btn_add_hole" data-id="'.$row["id"].'" class="hole_watch"></div></a></td>
         <td class="documents" data-id8="'.$row["id"].'" data-label="Документы" ><div name="btn_doc" class="btn_doc"></div></td>
         <td class="model" data-id8="'.$row["id"].'" data-label="3д Модель" ><a href="/pages/3dmodel/3dmodel.php?sel1='.$row["namefield"].'"><div name="sel1" id="btn_doc" ></div></a></td>
         <td data-label="Удалить"><button type="button" name="delete_btn" data-id9="'.$row["id"].'" class="btn btn-xs btn-danger btn_delete">x</button></td>
    </tr>
           ';
    }
    $output .= '  
           <tr>  
               
                <td id="namefield" contenteditable></td>
                <td id="x" contenteditable></td>
                <td id="y" contenteditable></td>
                <td id="z" contenteditable></td>
                <td id="l" contenteditable></td>
                <td id="d" contenteditable></td>
                <td id="w" contenteditable></td>
                <td id="hole" ></td>
                <td id="model" ></td>
                <td id="doc" ></td>
                <td data-label="Добавить"><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>
           </tr>  
      ';
}
else
{
    $output .= '
				<tr>  
                    <td id="namefield" contenteditable></td>
                    <td id="x" contenteditable></td>
                    <td id="y" contenteditable></td>
                    <td id="z" contenteditable></td>
                    <td id="l" contenteditable></td>
                    <td id="d" contenteditable></td>
                    <td id="w" contenteditable></td>
                    <td id="hole" ></td>
                    <td id="model" ></td>
                    <td id="doc" ></td>
					<td data-label="Добавить"><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>
			   </tr>';
}
$output .= '</tbody></table>
      </div>';
echo $output;
?>