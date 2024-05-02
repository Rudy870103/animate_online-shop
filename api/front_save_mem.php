<?php include_once "db.php";

$Member->save($_POST);

to("../index.php?do=member");