<?php session_start();

if(isset($_FILES["filename"])) {
    $errors = array();
    $uploaddir = $_SERVER['ROOTDIR'].'../field_doc/';
    $file_name = $_FILES['filename']['name'];
    $uploadfile = $uploaddir . basename($file_name);
    $file_size = $_FILES['filename']['size'];
    $file_tmp = $_FILES['filename']['tmp_name'];
    $file_type = $_FILES['filename']['type'];
//    $file_ext = strtolower(end(explode('.',$file_name )));
    //$_SESSION['filename'] = $file_name;
    $expention = array("pdf","png","jpg","jpeg","gif");

    if($file_size > 10485760) {
        $errors[] ='Файл должен быть не более 10 мегабайт';

    }

    if(empty($errors)) {

        if(move_uploaded_file($file_tmp,$uploadfile)){
            echo $file_name;
            $_SESSION['s']=$file_name;
        };

        //if(!move_uploaded_file($file_tmp,$_SERVER['DOCUMENT_ROOT'].$uploaddir)) {
            // ini_set('display_errors',1);
            // error_reporting(E_ALL);
            // echo "image: $file_name <br> <img src='$uploadfile'>";
        //}


    } else {
        //print_r($_FILES);
    }

}
?>