<?php  
 require_once '../connection.php'; // подключаем скрипт
 $connect = mysqli_connect($host, $user, $password, $database);
 $output = '';  
 $sql = "SELECT * FROM mine  ORDER BY idmine DESC";
 $result = mysqli_query($connect, $sql);  
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">
           <thead class="thead-dark">
                <tr>  
                     <!-- <th >Id</th>-->
                     <!--<th >№ месторождения</th>-->
                     <th scope="col">Название полезного ископаемого</thsc>
                     <th scope="col">Цвет отображения</th>
                     <th scope="col">Добавить</th>

                </tr>
                 </thead>
                 <tbody>';
 $rows = mysqli_num_rows($result);
 if($rows > 0)  
 {  
//	  if($rows > 10)
//	  {
//		  $delete_records = $rows - 10;
//		  $delete_sql = "DELETE FROM field LIMIT $delete_records";
//		  mysqli_query($connect, $delete_sql);
//	  }<input type="color" value="'.$row["clr"].'">
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '

    <a>  
         <!--<td data-label="ID">'.$row["id"].'</td>-->
         <!--<td class="nfield" data-id1="'.$row["id"].'"data-label="№ месторождения" data-label="ID" contenteditable>'.$row["nfield"].'</td>-->

         <td class="name" data-id1="'.$row["idmine"].'" data-label="Название полезного ископаемого" contenteditable>'.$row["name"].'</td>
         <td class="clr" data-id2="'.$row["idmine"].'" data-label="Цвет отображения" ><input type="color" value="'.$row["clr"].'"></td>
         <td data-label="Удалить"><button type="button" name="delete_btn" data-id3="'.$row["idmine"].'" class="btn btn-xs btn-danger btn_delete_mine">x</button></td>
    </tr>

           ';  
      }  
      $output .= '  
           <tr>  
                <td id="name" contenteditable></td>
                <td id="clr" contenteditable></td>
                <td data-label="Добавить"><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>
           </tr>  
      ';  
 }  
 else  
 {  
      $output .= '
				<tr>  
                <td id="name" contenteditable></td>
                <td id="clr" contenteditable></td>
                <td data-label="Добавить"><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>
           </tr>  
			   ';
 }  
 $output .= '</tbody></table>
      </div>';  
 echo $output;  
 ?>