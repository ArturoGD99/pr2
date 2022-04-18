<?php
set_time_limit(0);
ini_set("memory_limit", "-1");
$img = $_GET['img'];

$path = 'fotos/';
if (!file_exists($path)) {
    mkdir($path, 0777, true);
}

foreach ($_FILES as $key){
    if($key['error'] == UPLOAD_ERR_OK ){
        $name = $key['name'];
        $temp = $key['tmp_name'];
        $size = ($key['size'] / 1000)."Kb";
        $ext = pathinfo( $name, PATHINFO_EXTENSION );
        if(($ext != 'jpg') and ($ext != 'jpeg')){
            echo("Incorrecto|".$ext);
        }else if($size > 1000 ) {
            echo "Excede|";
        }else{
            move_uploaded_file($temp,$path.$name);
            //rename("C:/wamp64/www/DisenoPammy/".$path."".$name,"C:/wamp64/www/DisenoPammy/".$path."".$img.".jpg");
            rename($path."".$name,$path."".$img.".jpg");
            echo "Exito|";
        }
    }else{
        echo "Excede|";
    }
}
?>