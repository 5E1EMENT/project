<?php

if(isset($_FILES["filename"])) {
    $errors = array();
    $uploaddir = $_SERVER['ROOTDIR'].'../field_doc/';
    $file_name = $_FILES['filename']['name'];
    $uploadfile = $uploaddir . basename($file_name);
    $file_size = $_FILES['filename']['size'];
    $file_tmp = $_FILES['filename']['tmp_name'];
    $file_type = $_FILES['filename']['type'];
    $file_ext = strtolower(end(explode('.',$file_name )));

    $expention = array("pdf","png","jpg","jpeg");

    if($file_size > 10485760) {
        $errors[] ='Файл должен быть не более 10 мегабайт';

    }

    if(empty($errors)) {

        move_uploaded_file($file_tmp,$uploadfile);

        if(!move_uploaded_file($file_tmp,$uploadfile, $_SERVER['DOCUMENT_ROOT'].$uploaddir)) {
            ini_set('display_errors',1);
            error_reporting(E_ALL);
            echo "image: $file_name <br> <img src='$uploadfile'>";
        }


    } else {
        print_r($_FILES);
    }

}
?>