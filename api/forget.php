<?php include_once "db.php";

$res=$Member->find(['email'=>$_POST['email']]);

if(empty($res)){
    echo "查無資料";
}else{
    echo "您的密碼為 : " . $res['pw'];
}