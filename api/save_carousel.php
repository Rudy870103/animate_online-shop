<?php include_once "db.php";

if(!empty($_FILES['img']['tmp_name'])){
    move_uploaded_file($_FILES['img']['tmp_name'],"../img/{$_FILES['img']['name']}");
    $_POST['img']=$_FILES['img']['name'];
}

if(!isset($_POST['id'])){
    $_POST['sh']=1;
    $_POST['rank']=$Carousel->max('id')+1;
}

$Carousel->save($_POST);

to("../back.php?do=carousel");