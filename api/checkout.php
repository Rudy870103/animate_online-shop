<?php include_once "db.php";

$_POST['no']=date("Ymd").rand(100000,999999);

$_POST['acc']=$_SESSION['member'];

$_POST['product']=serialize($_SESSION['cart']);

$_POST['orderdate']=date('Y-m-d');

$Orders->save($_POST);

unset($_SESSION['cart']);

to("../index.php?do=order&no={$_POST['no']}");