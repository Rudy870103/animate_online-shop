<?php include_once "db.php";

// print_r($_POST);

// echo "<br>";

// foreach($_POST['id'] as $id){
//     print_r($id);
//     echo "<br>";
// }

// echo "<br>";

// foreach($_SESSION['cart'] as $id => $total){
//     echo "id=";
//     print_r($id);
//     echo "<br>";
//     echo "total=";
//     print_r($total);
// }

// echo "<br>";

foreach($_POST['id'] as $id){
    foreach($_SESSION['cart'] as $id => $total){
        $_SESSION['cart'][$id]=$_POST['total'.$id];
    }        
}

to("../index.php?do=checkout");
