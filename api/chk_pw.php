<?php include_once "db.php";

$res=$Member->count($_POST);

if($res){
    $_SESSION['member']=$_POST['acc'];
}

echo $res;