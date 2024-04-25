<?php include_once "db.php";

$DB=${$_POST['table']};

$row=$DB->find($_POST['id']);
//$row['sh']=($row['sh']==1)?0:1;
  $row['sh']=($row['sh']+1)%2;
$DB->save($row);