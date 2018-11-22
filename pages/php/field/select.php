<?php  
 require_once '../connection.php'; // подключаем скрипт
 $connect = mysqli_connect($host, $user, $password, $database);
 $output = '';  
 $sql = "SELECT * FROM field  ORDER BY id DESC";
 $result = mysqli_query($connect, $sql);  
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">
           <thead>
                <tr>  
                     <!-- <th >Id</th>-->
                     <!--<th >№ месторождения</th>-->
                     <th >Имя месторождения</th>
                     <th >X координата</th>
                     <th >Y координата</th>
                     <th >Z координата</th>
                     <th >Длина</th>
                     <th >Глубина</th>
                     <th >Ширина</th>
                     <th >Скважины</th>
                     <th >Документы</th>
                     <th >3д Модель</th>
                     <th >Добавить</th>
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

    <tr>  
         <!--<td data-label="ID">'.$row["id"].'</td>-->
         <!--<td class="nfield" data-id1="'.$row["id"].'"data-label="№ месторождения" data-label="ID" contenteditable>'.$row["nfield"].'</td>-->

         <td class="namefield" data-id2="'.$row["id"].'" data-label="Имя месторождения" contenteditable>'.$row["namefield"].'</td>
         <td class="x" data-id3="'.$row["id"].'" data-label="X координата" contenteditable>'.$row["x"].'</td>
         <td class="y" data-id4="'.$row["id"].'" data-label="Y координата" contenteditable>'.$row["y"].'</td>
         <td class="z" data-id5="'.$row["id"].'" data-label="Z координата" contenteditable>'.$row["z"].'</td>
         <td class="l" data-id6="'.$row["id"].'" data-label="Длина" contenteditable>'.$row["l"].'</td>
         <td class="d" data-id7="'.$row["id"].'" data-label="Глубина" contenteditable>'.$row["d"].'</td>
         <td class="w" data-id8="'.$row["id"].'" data-label="Ширина" contenteditable>'.$row["w"].'</td>
         <td class="hole" data-id8="'.$row["id"].'" data-label="Скважины" ><button type="button" name="btn_hole" id="btn_add_hole" data-id="'.$row["id"].'" class="btn btn-xs btn-success">Edit</button></td>
         <td class="documents" data-id8="'.$row["id"].'" data-label="Документы" ><button type="button" name="btn_doc"  class="btn btn-xs btn-success btn_doc">Edit</button></td>
         <td class="model" data-id8="'.$row["id"].'" data-label="3д Модель" ><a href="/pages/3dmodel/3dmodel.php?sel1='.$row["namefield"].'"><button type="button" name="sel1" id="btn_doc" class="btn btn-xs btn-success">Просмотр</button></a></td>
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