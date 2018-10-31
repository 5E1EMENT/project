<?php  
 require_once '../connection.php'; // подключаем скрипт
 $connect = mysqli_connect($host, $user, $password, $database);
 $output = '';  
 $sql = "SELECT * FROM field ORDER BY id DESC";
 $result = mysqli_query($connect, $sql);  
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">  
                <tr>  
                     <th width="10%">Id</th>  
                     <th width="10%">№ месторождения</th>
                     <th width="10%">Имя месторождения</th>
                     <th width="10%">X координата</th>
                     <th width="10%">Y координата</th>
                     <th width="10%">Z координата</th>
                     <th width="10%">Длина</th>
                     <th width="10%">Глубина</th>
                     <th width="10%">Ширина</th>
                     <th width="10%">Править</th>
                </tr>';
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
                     <td>'.$row["id"].'</td>  
                     <td class="nfield" data-id1="'.$row["id"].'" contenteditable>'.$row["nfield"].'</td>
                     <td class="namefield" data-id2="'.$row["id"].'" contenteditable>'.$row["namefield"].'</td>
                     <td class="x" data-id3="'.$row["id"].'" contenteditable>'.$row["x"].'</td>
                     <td class="y" data-id4="'.$row["id"].'" contenteditable>'.$row["y"].'</td>
                     <td class="z" data-id5="'.$row["id"].'" contenteditable>'.$row["z"].'</td>
                     <td class="l" data-id6="'.$row["id"].'" contenteditable>'.$row["l"].'</td>
                     <td class="d" data-id7="'.$row["id"].'" contenteditable>'.$row["d"].'</td>
                     <td class="w" data-id8="'.$row["id"].'" contenteditable>'.$row["w"].'</td>
                     <td><button type="button" name="delete_btn" data-id9="'.$row["id"].'" class="btn btn-xs btn-danger btn_delete">x</button></td>
                </tr>  
           ';  
      }  
      $output .= '  
           <tr>  
                <td></td>  
                <td id="nfield" contenteditable></td>
                <td id="namefield" contenteditable></td>
                <td id="x" contenteditable></td>
                <td id="y" contenteditable></td>
                <td id="z" contenteditable></td>
                <td id="l" contenteditable></td>
                <td id="d" contenteditable></td>
                <td id="w" contenteditable></td>
                <td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>
           </tr>  
      ';  
 }  
 else  
 {  
      $output .= '
				<tr>  
					<td></td>  
					<td id="nfield" contenteditable></td>
                                    <td id="namefield" contenteditable></td>
                                    <td id="x" contenteditable></td>
                                    <td id="y" contenteditable></td>
                                    <td id="z" contenteditable></td>
                                    <td id="l" contenteditable></td>
                                    <td id="d" contenteditable></td>
                                    <td id="w" contenteditable></td>
					<td><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>  
			   </tr>';  
 }  
 $output .= '</table>  
      </div>';  
 echo $output;  
 ?>