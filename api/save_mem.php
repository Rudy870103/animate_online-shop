<?php include_once "db.php";

$Member->save($_POST);

to("../back.php?do=member");