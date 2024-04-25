<?php include_once "db.php";

if(isset(${$_POST['table']}->find($_POST['id'])['img'])){
    $img=${$_POST['table']}->find($_POST['id'])['img'];
    unlink("../img/$img");
}

${$_POST['table']}->del($_POST['id']);
