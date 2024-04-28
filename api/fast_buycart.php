<?php include_once "db.php";

if (isset($_POST['id']) && isset($_POST['total'])) {
    $_SESSION['cart'][$_POST['id']] = $_POST['total'];
}