<?php
$path='../';
include $path."class/db_connect.class.php";
include $path."class/sqlQuery.class.php";


if($_REQUEST)
{


		$user_id=$_REQUEST['id'];

		$results=$qry->queryExecute("update  tsn_notification set status='1' where to_id='".$user_id."'");

}

?>