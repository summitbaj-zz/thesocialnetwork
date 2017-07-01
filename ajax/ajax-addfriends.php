<?php
$path='../';
include $path."class/db_connect.class.php";
include $path."class/sqlQuery.class.php";


if($_REQUEST)
{


		$rel_ID=$_REQUEST['id'];

		$results=$qry->queryExecute("update  tsn_rel set status='1' where rel_ID='".$rel_ID."'");

}

?>