<?php
include $path."class/db_connect.class.php";
include $path."class/sqlQuery.class.php";

if (isset($_POST['text'])) {

$ddd=trim (addslashes($_POST['text']));
	$query = "INSERT INTO message (message) VALUES ('$ddd')";
	
}

?>