<?php
$path='../';
include $path."class/db_connect.class.php";
include $path."class/sqlQuery.class.php";


if($_REQUEST)
{


		$user_id=$_REQUEST['id'];

		$results=$qry->queryExecute("update tsn_users set last_login='".date('Y-m-d H:i:s')."' where user_id='".$user_id."'");


}

?>