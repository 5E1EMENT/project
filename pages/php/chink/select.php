<?php  
 require_once '../connection.php'; // подключаем скрипт
 $connect = mysqli_connect($host, $user, $password, $database);
 $output = '';  
 $sql = "SELECT * FROM hole ORDER BY id DESC";
 $result = mysqli_query($connect, $sql);  
 $output .= '  
      <div class="table-responsive">  
           <table class="table table-bordered">
           <thead>
                <tr>  
                     <th >Id</th>
                     <th >№ скважины</th>
                     <th >№ месторождения</th>
                     <th >X координата</th>
                     <th >Y координата</th>
                     <th >Z координата</th>
                     <th >Угол Альфа</th>
                     <th >Угол Бета</th>
                     <th >Глубина</th>
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
		  $delete_sql = "DELETE FROM hole LIMIT $delete_records";
		  mysqli_query($connect, $delete_sql);
	  }
      while($row = mysqli_fetch_array($result))  
      {  
           $output .= '  
                <tr>  
                     <td data-label="ID">'.$row["id"].'</td>
                     <td class="nhole" data-id1="'.$row["id"].'" data-label="№ скважины" contenteditable>'.$row["nhole"].'</td>
                     <td class="nfield" data-id2="'.$row["id"].'" data-label="№ месторождения" contenteditable>'.$row["nfield"].'</td>
                     <td class="x" data-id3="'.$row["id"].'" data-label="X координата" contenteditable>'.$row["x"].'</td>
                     <td class="y" data-id4="'.$row["id"].'" data-label="Y координата" contenteditable>'.$row["y"].'</td>
                     <td class="z" data-id5="'.$row["id"].'" data-label="Z координата" contenteditable>'.$row["z"].'</td>
                     <td class="a" data-id6="'.$row["id"].'" data-label="Угол Альфа" contenteditable>'.$row["a"].'</td>
                     <td class="b" data-id7="'.$row["id"].'" data-label="Угол Бета" contenteditable>'.$row["b"].'</td>
                     <td class="d" data-id8="'.$row["id"].'" data-label="Глубина" contenteditable>'.$row["d"].'</td>
                     <td data-label="Удалить"><button type="button" name="delete_btn" data-id9="'.$row["id"].'" class="btn btn-xs btn-danger btn_delete">x</button></td>
                </tr>  
           ';  
      }  
      $output .= '  
           <tr>  
                <td></td>  
                <td id="nhole" contenteditable></td>
                <td id="nfield" contenteditable></td>
                <td id="x" contenteditable></td>
                <td id="y" contenteditable></td>
                <td id="z" contenteditable></td>
                <td id="a" contenteditable></td>
                <td id="b" contenteditable></td>
                <td id="d" contenteditable></td>
                <td data-label="Добавить"><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>
           </tr>  
      ';  
 }  
 else  
 {  
      $output .= '
				<tr>  
					<td></td>  
					<td id="nhole" contenteditable></td>
                                    <td id="nfield" contenteditable></td>
                                    <td id="x" contenteditable></td>
                                    <td id="y" contenteditable></td>
                                    <td id="z" contenteditable></td>
                                    <td id="a" contenteditable></td>
                                    <td id="b" contenteditable></td>
                                    <td id="d" contenteditable></td>
					<td data-label="Добавить"><button type="button" name="btn_add" id="btn_add" class="btn btn-xs btn-success">+</button></td>
			   </tr>';  
 }  
 $output .= '</tbody></table>
      </div>';  
 echo $output;  
 ?>