<?php include_once "db.php";

unset($_POST['pw2']);
$_POST['regdate']=date("Y-m-d");
$Member->save($_POST);