<?php
require_once("db.php");

$conn = db_connect ();
$id=$_GET['id'];
$item_row=db_get_item_row($conn,$id);


echo json_encode($item_row);
?>